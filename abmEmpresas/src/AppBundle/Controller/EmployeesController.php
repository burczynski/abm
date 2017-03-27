<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class EmployeesController extends Controller
{
    /**
     * @Route("/getEmployees")
     */
    public function getEmployeesAction(Request $request)
    {
    	$message;
        $session;
        $session = $request->getSession();
        /**
         * Ricardo Burczynski: Si la session tiene un usuario podra ingresar
         */        
        if ($session->get('user')) {
        	$em = $this->getDoctrine()->getManager();
            $companysEmployees = $em->getRepository('AppBundle:Companysemployees')->findAll();
        }
        else {
        	return $this->redirect('/');
        }
        return $this->render('AppBundle:Employees:get_employees.html.twig', array("companysEmployees" => $companysEmployees));
    }

}
