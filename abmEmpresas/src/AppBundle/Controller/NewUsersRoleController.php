<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Usersroles;
/**
 * Ricardo Burczynski: Este controller gestiona el alta de nuevos roles para los usuarios
 */
class NewUsersRoleController extends Controller
{
    /**
     * @Route("/newUsersRole")
     */
    public function newUsersRoleAction(Request $request)
    {
        $message;
    	$session;
        $session = $request->getSession();
        /**
         * Ricardo Burczynski: Si la session tiene un usuario y su rol se lo permite podra agregar roles
         */        
        if ($session->get('user')) {
            /**
             * Ricardo Burczynski: Se crea el objeto userRole y la estructura de el formulario
             */
            $usersRole = new Usersroles();
            $form = $this->createFormBuilder($usersRole)
                ->add('userRoleName', TextType::class)
                ->add('save', SubmitType::class, array('label' => 'Agregar'))
                ->getForm();

            $form->handleRequest($request);
            /**
             * Ricardo: Si el submit del formulario fue correcto se verifica la informacion, se realiza la conexion con 
             * la base de datos, se busca que la informacion a agregar no sea repetida y de ser asi se agrega en la base
             */
            if ($form->isSubmitted() && $form->isValid()) {
                /**
                 * Ricardo Burczynski: Obtengo la informacion, conecto a la base, busco que no este ya agregada
                 */
                $givenUserRoleName = $form['userRoleName']->getData();
                $em = $this->getDoctrine()->getManager();
                $role = $em->getRepository('AppBundle:Usersroles')->findByuserRoleName($givenUserRoleName);
                /**
                 * Ricardo Burczynski: Si no encuentro el role en la base, se setea el objeto usersRole y se guarda
                 * un nuevo registro.
                 */
                if (!$role) {
                    $usersRole->setUserRoleName($givenUserRoleName);
                    $em->persist($usersRole);
                    $em->flush();
                    $message = "Se agrego un nuevo rol ".$givenUserRoleName." en la base.";
                    return $this->render('AppBundle:NewUsersRole:new_users_role.html.twig', array('form' => $form->createView(), 'messageTrue' => $message));
                }
                else {
                    /**
                     * Ricardo Burczynski: En caso de que el rol ya exista se dara notificacion
                     */
                    $message = "El rol ".$givenUserRoleName." ya existe en la base, verifiquelo.";
                    return $this->render('AppBundle:NewUsersRole:new_users_role.html.twig', array('form' => $form->createView(), 'messageFalse' => $message));
                }                
            }

        }
        else {
                   return $this->redirect('/');
        }
        return $this->render('AppBundle:NewUsersRole:new_users_role.html.twig', array('form' => $form->createView()));
    }

}
