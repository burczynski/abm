<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends Controller
{
    /**
     * @Route("/getUsers")
     */
    public function getUsersAction(Request $request)
    {
    	$message;
        $session;
        $session = $request->getSession();
        /**
         * Ricardo Burczynski: Si la session tiene un usuario podra ingresar
         */        
        if ($session->get('user')) {
        	$em = $this->getDoctrine()->getManager();
            $users = $em->getRepository('AppBundle:Users')->findAll();
        }
        else {
        	return $this->redirect('/');
        }
        return $this->render('AppBundle:Users:get_users.html.twig', array('users' => $users));
    }

}
