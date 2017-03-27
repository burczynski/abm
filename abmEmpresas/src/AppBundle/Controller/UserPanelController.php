<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UserPanelController extends Controller
{
	/**
     * @Route("/userPanel")
     */
    public function userPanelAction(Request $request)
    {
    	$message;
        $session;
        $session = $request->getSession();
        $count=0;
        /**
         * Ricardo Burczynski: Si la session tiene un usuario podra ingresar
         */        
        if ($session->get('user')) {
        	$em = $this->getDoctrine()->getManager();
            $companys = $em->getRepository('AppBundle:Companys')->findAll();
            foreach ($companys as $companysAux) {
                $employees = $em->getRepository('AppBundle:Companysemployees')->findAll($companysAux->getCompanyId());
                foreach ($employees as $employeesAux) {
                    if ($employeesAux->getCompanyEmployyeStatus()->getCompanyEmployeeStatusId() == 1) {
                        $count = $count + 1;
                    }                    
                }
                $companysAux->setCompanyTotalEmployees($count);
                $em->flush();
                $count = 0;
            }
        }
        else {
        	return $this->redirect('/');
        }
        return $this->render('AppBundle:UsersPanel:user_panel.html.twig', array("companys" => $companys));
    }
}
