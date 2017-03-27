<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Companys;

class NewCompanyController extends Controller
{
    /**
     * @Route("/newCompany")
     */
    public function newCompanyAction(Request $request)
    {
    	$message;
        $session;
        $session = $request->getSession();
        /**
         * Ricardo Burczynski: Si la session no tiene un usuario se debera autenticar
         */        
        if ($session->get('user')) {
            $company = new Companys();
            $form = $this->createFormBuilder($company)
                ->add('companyName', TextType::class)
                ->add('companyCuitNumber',TextType::class)
                ->add('save', SubmitType::class, array('label' => 'Crear'))
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $givenompanyName = $form['companyName']->getData();
                $givencompanyCuitNumber = $form['companyCuitNumber']->getData();
                $em = $this->getDoctrine()->getManager();
                $getCompany = $em->getRepository('AppBundle:Companys')->findBycompanyName($givenompanyName);
                $getCompanyCuit = $em->getRepository('AppBundle:Companys')->findBycompanyCuitNumber($givencompanyCuitNumber);
                $getCompanystatus = $em->getRepository('AppBundle:Companysstatus')->findOneBycompanyStatusId(1);

                if (!$getCompany && !$getCompanyCuit) {
                    $company->setCompanyName($givenompanyName);
                    $company->setCompanyCuitNumber($givencompanyCuitNumber);
                    $company->setCompanyStatus($getCompanystatus);
                    $em->persist($company);
                    $em->flush();
                    $message = "Se agrego la empresa ".$givenompanyName." en la base.";
                    return $this->render('AppBundle:NewCompany:new_company.html.twig', array('form' => $form->createView(), "messageTrue" => $message));
                }
                else {
                    $message = "La empresa ".$givenompanyName." o el cuit ".$givencompanyCuitNumber." ya estan en la base.";
                    return $this->render('AppBundle:NewCompany:new_company.html.twig', array('form' => $form->createView(), "messageFalse" => $message));
                }
            }

        }
        else {
            $session->remove('user');
            return $this->redirect('/');
        }
        return $this->render('AppBundle:NewCompany:new_company.html.twig', array('form' => $form->createView()));
    }

}
