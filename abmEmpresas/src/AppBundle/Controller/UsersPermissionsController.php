<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Userspermissions;
class UsersPermissionsController extends Controller
{
    /**
     * @Route("/newUsersPermissions")
     */
    public function newUsersPermissionsAction(Request $request)
    {
    	$message;
        $session;
        $session = $request->getSession();
        /**
         * Ricardo Burczynski: Si la session tiene un usuario y su rol se lo permite podra agregar permisos
         */ 
        if (!$session->get('user')) {
            /**
             * Ricardo Burczynski: Se crea el objeto usersPermission y la estructura de el formulario
             */
            $usersPermission = new Userspermissions();
            $form = $this->createFormBuilder($usersPermission)
                ->add('userPermissionName', TextType::class)
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
                $givenUserPermissionName = $form['userPermissionName']->getData();
                $em = $this->getDoctrine()->getManager();
                $permission = $em->getRepository('AppBundle:Userspermissions')->findByuserPermissionName($givenUserPermissionName);
                /**
                 * Ricardo Burczynski: Si no encuentro el permiso en la base, se setea el objeto usersPermission y se guarda
                 * un nuevo registro.
                 */
                if (!$permission) {
                    $usersPermission->setuserPermissionName($givenUserPermissionName);
                    $em->persist($usersPermission);
                    $em->flush();
                    $message = "Se agrego el permiso ".$givenUserPermissionName." en la base.";
                    return $this->render('AppBundle:UsersPermissions:new_users_permissions.html.twig', array('form' => $form->createView(), 'messageTrue' => $message));
                }
                else {
                    /**
                     * Ricardo Burczynski: En caso de que el permiso ya exista se dara notificacion
                     */
                    $message = "El permiso ".$givenUserPermissionName." ya existe en la base, verifiquelo.";
                    return $this->render('AppBundle:UsersPermissions:new_users_permissions.html.twig', array('form' => $form->createView(), 'messageFalse' => $message));
                }
            }

        }
        else {
                    $this->redirect('/');
        }
        return $this->render('AppBundle:UsersPermissions:new_users_permissions.html.twig', array('form' => $form->createView()));
    }

}
