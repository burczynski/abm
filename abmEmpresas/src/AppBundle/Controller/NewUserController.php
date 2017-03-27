<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Users;

class NewUserController extends Controller
{
    /**
     * @Route("/newUser")
     */
    public function newUserAction(Request $request)
    {
    	$message;
        $session;
        $session = $request->getSession();
        /**
         * Ricardo Burczynski: Si la session tiene un usuario y su rol se lo permite podra agregar permisos
         */        
        if ($session->get('user')) {
            /**
             * Ricardo Burczynski: Se crea el objeto user y la estructura de el formulario
             */
            $newUser = new Users();
            $form = $this->createFormBuilder($newUser)
                ->add('userUser', TextType::class)
                ->add('userPass', PasswordType::class)
                ->add('userRole', 'entity', array('class' => 'AppBundle:Usersroles', 'choice_label' => 'userRoleName') )
                ->add('userPermission','entity', array('class' => 'AppBundle:Userspermissions', 'choice_label' => 'UserPermissionName'))
                ->add('save', SubmitType::class, array('label' => 'Registrar'))
                ->getForm();

            $form->handleRequest($request);
            /**
             * Ricardo Burczynski: Si el submit del formulario fue correcto se verifica la informacion, se realiza la conexion con 
             * la base de datos, se busca que la informacion a agregar no sea repetida y de ser asi se agrega en la base
             */
            if ($form->isSubmitted() && $form->isValid()) {
                /**
                 * Ricardo Burczynski: Obtengo la informacion, conecto a la base, busco que no este ya agregada
                 */
                $givenUserUser = $form['userUser']->getData();
                $givenUserPass = $form['userPass']->getData();
                $giveUserPermission = $form['userPermission']->getData();
                $givenUserRole = $form['userRole']->getData();
                $em = $this->getDoctrine()->getManager();
                $user = $em->getRepository('AppBundle:Users')->findByuserUser($givenUserUser);
                /**
                 * Ricardo Burczynski: Si no encuentro el usuario en la base, se setea el objeto newUser y se guarda
                 * un nuevo registro.
                 */
                if (!$user) {
                    /**
                     * Ricardo Burczysnki: Si no es un usuario de tipo admin no puede tener permiso de lectura escritura y modificacion
                     */
                    if ($givenUserRole->getUserRoleId() != 1 && $giveUserPermission->getUserPermissionId() == 3) {
                        $message = "Solamente los administradores pueden tener ese permiso.";
                        return $this->render('AppBundle:NewUser:new_user.html.twig', array('form' => $form->createView(), 'messageTrue' => $message));
                    }                    
                    else {
                            $userStatus = $em->getRepository('AppBundle:Usersstatus')->findOneByuserStatusId(1);
                            $newUser->setUserUser($givenUserUser);
                            $newUser->setUserPass($givenUserPass);
                            $newUser->setUserPermission($giveUserPermission);
                            $newUser->setUserRole($givenUserRole);
                            $newUser->setUserStatus($userStatus);
                            $em->persist($newUser);
                            $em->flush();
                            $message = "Se agrego el usuario ".$givenUserUser." en la base.";                            
                            return $this->render('AppBundle:NewUser:new_user.html.twig', array('form' => $form->createView(), 'messageTrue' => $message));
                    }
                }
                else {
                    /**
                     * Ricardo Burczynski: En caso de que el usuario ya exista se dara notificacion
                     */
                    $message = "El usuario ".$givenUserUser." ya existe en la base, verifiquelo.";
                    return $this->render('AppBundle:NewUser:new_user.html.twig', array('form' => $form->createView(), 'messageFalse' => $message));
                }                
            }
        }
        else {
               return $this->redirect('/');
            }
        return $this->render('AppBundle:NewUser:new_user.html.twig', array('form' => $form->createView()));
    }

}
