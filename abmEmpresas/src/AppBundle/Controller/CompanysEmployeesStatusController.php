<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Companysemployeesstatus;

class CompanysEmployeesStatusController extends Controller
{
    /**
     * @Route("/newCompanysEmployeesStatus")
     */
    public function newCompanysEmployeesStatusAction(Request $request)
    {
    	$session;
        $session = $request->getSession();
        /**
         * Ricardo Burczynski: Si la session no tiene un usuario se debera autenticar
         */        
        if (!$session->get('user')) {
            $Companysemployeesstatus = new Companysemployeesstatus();
            $form = $this->createFormBuilder($Companysemployeesstatus)
                ->add('companyEmployeeStatusName', TextType::class)
                ->add('save', SubmitType::class, array('label' => 'Agregar'))
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $givencompanyEmployeeStatusName = $form['companyEmployeeStatusName']->getData();

                /*Ricardo:esta parte compararia con el usuario en la base*/
                if ($givenUser == 'ricardo' && $givenPass = 'rica601burc') {
                    print_r("login correcto, trasfieirnedo");
                }
                else {
                    $this->redirect('/');
                }
            }

        }
        return $this->render('AppBundle:CompanysEmployeesStatus:new_companys_employees_status.html.twig', array('form' => $form->createView()));
    }

}
