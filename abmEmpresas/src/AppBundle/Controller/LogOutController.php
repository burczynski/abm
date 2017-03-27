<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class LogOutController extends Controller
{
    /**
     * @Route("/logOut")
     */
    public function logOutAction(Request $request)
    {
    	if ($session = $request->getSession()) {
	    	$session->remove('user');
	        $session->remove('permisson');
	        $session->remove('rol');
	        return $this->redirect('/');
    	}
        return $this->render('AppBundle:LogOut:log_out.html.twig', array(
            // ...
        ));
    }

}
