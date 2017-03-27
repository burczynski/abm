<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Ricardo Burczynski: Le agrego la entidad users para el formulario de login
*/
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Companysemployees;


class NewCompanysemployeeController extends Controller
{
    /**
     * @Route("/newCompanysemployee")
     */
    public function newCompanysemployeeAction(Request $request)
    {
        $message;
    	$session;
        $session = $request->getSession();
        /**
         * Ricardo Burczynski: Si la session no tiene un usuario se debera autenticar
         */        
        if ($session->get('user') && $session->get('permisson') == 3) {
            $em = $this->getDoctrine()->getManager();
            $companys = $em->getRepository('AppBundle:Companys')->findAll();
            if (! $companys) {
                /*rectificar ya que puede no andar asi*/
                $message = "No puede agregar empleados si no hay empresas.";
                return $this->redirect('/newCompany', array('messageFalse' => $message));
            }
            $employee = new Companysemployees();
            $form = $this->createFormBuilder($employee)
                ->add('companyEmployeeName', TextType::class)
                ->add('companyEmployeeLastname', TextType::class)
                ->add('companyEmployeeDni',NumberType::class)
                ->add('company', 'entity', array('class' => 'AppBundle:Companys', 'choice_label' => 'getCompanyName') )
                ->add('save', SubmitType::class, array('label' => 'Registrar'))
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $givenName = $form['companyEmployeeName']->getData();
                $givenLastname = $form['companyEmployeeLastname']->getData();
                $givenDni = $form['companyEmployeeDni']->getData();
                $givenCompany = $form['company']->getData();

                
                $getCompanysemployee = $em->getRepository('AppBundle:Companysemployees')->findOneBycompanyEmployeeDni($givenDni);

                if($getCompanysemployee) {
                    if ($getCompanysemployee->getCompanyEmployyeStatus()->getCompanyEmployeeStatusId() == 1) {
                        $actualCompany = $getCompanysemployee->getCompany()->getCompanyName();
                        $message = "Esta persona se encuentra trabajando para la empresa ".$actualCompany;
                        return $this->render('AppBundle:NewCompanysemployee:new_companysemployee.html.twig', array('form' => $form->createView(), 'messageFalse' => $message));
                    }
                }
                else {
                    $employeeStatus = $em->getRepository('AppBundle:Companysemployeesstatus')->findOneBycompanyEmployeeStatusId(1);

                    $employee->setCompanyEmployeeName($givenName);
                    $employee->setCompanyEmployeeLastname($givenLastname);
                    $employee->setCompanyEmployeeDni($givenDni);
                    $employee->setCompany($givenCompany);
                    $employee->setCompanyEmployyeStatus($employeeStatus);
                    $em->persist($employee);
                    $em->flush();
                    $message = "Se agrego el empleado ".$givenName." en la base.";
                    return $this->render('AppBundle:NewCompanysemployee:new_companysemployee.html.twig', array('form' => $form->createView(), "messageTrue" => $message));
                }
            }

        }
        else {
            $session->remove('user');
            $session->remove('permisson');
            $session->remove('rol');
            return $this->redirect('/');
        }
        return $this->render('AppBundle:NewCompanysemployee:new_companysemployee.html.twig', array('form' => $form->createView()));
    }

}
