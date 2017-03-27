<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EmployeesChangesController extends Controller
{
    /**
     * @Route("/employeeChanges/{id}")
     */
    public function employeeChangeAction(Request $request, $id)
    {
    	$message;
    	$session;
    	$session = $request->getSession();
    	if ($session->get('user') && $session->get('permisson') == 3) {
    		$em = $this->getDoctrine()->getManager();
            $getCompanyEmployee = $em->getRepository('AppBundle:Companysemployees')->findOneBycompanyEmployeeId($id);
            if (! $getCompanyEmployee) {
            	$message = "No se encontro al emplado";
            	return $this->redirect('/getEmployees');            	
            }
            else {
            	$form = $this->createFormBuilder($getCompanyEmployee)
		               ->add('companyEmployeeName', TextType::class)
		               ->add('companyEmployeeLastname', TextType::class)
		               ->add('companyEmployeeDni',NumberType::class)
		               ->add('company', 'entity', array('class' => 'AppBundle:Companys', 'choice_label' => 'getCompanyName') )		               
		               ->add('companyEmployyeStatus', 'entity', array('class' => 'AppBundle:Companysemployeesstatus', 'choice_label' => 'getCompanyEmployeeStatusName') )
		               ->add('save', SubmitType::class, array('label' => 'Modificar'))
		               ->getForm();

		        $form->handleRequest($request);

            	if ($form->isSubmitted() && $form->isValid()) {
            		$givenName = $form['companyEmployeeName']->getData();
                	$givenLastname = $form['companyEmployeeLastname']->getData();
                	$givenDni = $form['companyEmployeeDni']->getData();
                	$givenCompany = $form['company']->getData();
                	$givenEmployeeStatus = $form['companyEmployyeStatus']->getData();

                	$getCompanyEmployee->setCompanyEmployeeName($givenName);
                    $getCompanyEmployee->setCompanyEmployeeLastname($givenLastname);
                    $getCompanyEmployee->setCompanyEmployeeDni($givenDni);
                    $getCompanyEmployee->setCompany($givenCompany);
                    $getCompanyEmployee->setCompanyEmployyeStatus($givenEmployeeStatus);
                    $em->persist($getCompanyEmployee);
                    $em->flush();
                    $message = "Los cambios se efectuaron satisfactoriamente.";
		            return $this->render('AppBundle:EmployeesChanges:employee_change.html.twig', array('form' => $form->createView(),'messageTrue' => $message));
		        }
            }
            return $this->render('AppBundle:EmployeesChanges:employee_change.html.twig', array('form' => $form->createView()));
    	}
    	else{
    		$session->remove('user');
    		$session->remove('permisson');
    		$session->remove('rol');
            return $this->redirect('/');
    	}
        return $this->render('AppBundle:EmployeesChanges:employee_change.html.twig', array(
            // ...
        ));
    }

}
