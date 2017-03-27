<?php

namespace apiEmpresasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends FOSRestController
{
    /**
	* @Route("/companys")
	* @Method({"GET"})
	*/
    public function indexAction()
    {	
    	$em = $this->getDoctrine()->getManager();
            $companys = $em->getRepository('AppBundle:Companys')->findAll();         


        $view = View::create();
		$view->setData(array("companys"=>$companys));
		return $this->handleView($view);
    }
}
