<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserchangesController extends Controller
{
    /**
     * @Route("/userChange/{id}")
     */
    public function userChangeAction(Request $request, $id)
    {
    	$message;
    	$session;
    	$session = $request->getSession();
    	if ($session->get('user') && $session->get('permisson') == 3) {
    		$em = $this->getDoctrine()->getManager();
            $getUser = $em->getRepository('AppBundle:Users')->findOneByuserId($id);
            if (! $getUser) {
            	$message = "No se encontro informacion.";
            	return $this->redirect('/getUsers');
            }
            else {            	 
                $baseUser = $getUser->getUserPass();
		         $form = $this->createFormBuilder($getUser)
		               ->add('userUser', TextType::class)
		               ->add('userPass', TextType::class)
		               ->add('userRole', 'entity', array('class' => 'AppBundle:Usersroles', 'choice_label' => 'userRoleName') )
		               ->add('userPermission','entity', array('class' => 'AppBundle:Userspermissions', 'choice_label' => 'UserPermissionName'))
		               ->add('userStatus','entity', array('class' => 'AppBundle:Usersstatus', 'choice_label' => 'getUserStatusName'))
		               ->add('save', SubmitType::class, array('label' => 'Modificar'))
		               ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                
            	$givenUserUser = $form['userUser']->getData();
                $givenUserPass = $form['userPass']->getData();
                $givenUserRole = $form['userRole']->getData();
                $giveUserPermission = $form['userPermission']->getData();
                $givenUserStatus = $form['userStatus']->getData();
                if ($givenUserPass == $baseUser ) {
                	$getUser->setUserPass($baseUser);
                }
                else {
                	$newPass = md5($givenUserPass);
                	$getUser->setUserPass($newPass);
                }
                $getUser->setUserUser($givenUserUser);
                $getUser->setUserRole($givenUserRole);
                $getUser->setUserPermission($giveUserPermission);
                $getUser->setUserStatus($givenUserStatus);
                $em->flush();



                $message = "Los cambios se efectuaron satisfactoriamente.";
                return $this->render('AppBundle:Userchanges:user_change.html.twig', array("form" =>$form->createView(), 'messageTrue' => $message));
            }
            return $this->render('AppBundle:Userchanges:user_change.html.twig', array("form" =>$form->createView()));
            }
    	}
    	else {
    		$session->remove('user');
    		$session->remove('permisson');
    		$session->remove('rol');
            return $this->redirect('/');
    	}
        return $this->render('AppBundle:Userchanges:user_change.html.twig', array(
            // ...
        ));
    }

}
