<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class CompanyChangesController extends Controller
{
    /**
     * @Route("/companyChanges/{id}")
     */
    public function companyChangeAction(Request $request, $id)
    {
    	$message;
    	$session;
    	$session = $request->getSession();
    	if ($session->get('user') && $session->get('permisson') == 3) {
    		$em = $this->getDoctrine()->getManager();
            $getCompany = $em->getRepository('AppBundle:Companys')->findOneBycompanyId($id);
            if (! $getCompany) {
            	$message = "No se encontro informacion.";
            	return $this->render('AppBundle:CompanyChanges:company_change.html.twig', array("message" =>$message));
            }
            else {            	 
		         $form = $this->createFormBuilder($getCompany)
		               ->add('companyName', TextType::class)
		               ->add('companyCuitNumber', TextType::class)
		               ->add('companyStatus', 'entity', array('class' => 'AppBundle:Companysstatus', 'choice_label' => 'getCompanyStatusName') )
		               ->add('save', SubmitType::class, array('label' => 'Modificar'))
		               ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
            	$givenCompanyName = $form['companyName']->getData();
                $givenCompanyCuitNumber = $form['companyCuitNumber']->getData();
                $givenCompanyStatus = $form['companyStatus']->getData();

                $getCompany->setCompanyName($givenCompanyName);		
                $getCompany->setCompanyCuitNumber($givenCompanyCuitNumber);
                $getCompany->setCompanyStatus($givenCompanyStatus);
                $em->flush();                

                $message = "Los cambios se efectuaron satisfactoriamente.";
                return $this->render('AppBundle:CompanyChanges:company_change.html.twig', array("form" =>$form->createView(), 'messageTrue' => $message));
            }
            return $this->render('AppBundle:CompanyChanges:company_change.html.twig', array("form" =>$form->createView()));
            }
    	}
    	else {
    		$session->remove('user');
    		$session->remove('permisson');
    		$session->remove('rol');
            return $this->redirect('/');
    	}
        return $this->render('AppBundle:CompanyChanges:company_change.html.twig', array(
            // ...
        ));
    }

}
