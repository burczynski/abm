<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\CheckSessionController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Ricardo Burczynski: Le agrego la entidad users para el formulario de login
*/
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use AppBundle\Entity\Users;

/**
 * Ricardo Burczynski: Este controller va a ser para gestionar el login de cada usuario
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $message;
        $session;
        $session = $request->getSession();
        if ($session->get('user')) {
            return $this->redirect('/userPanel');
        }
        /**
         * Ricardo Burczynski: Si la session no tiene un usuario se debera autenticar
         */        
            $user = new Users();
            $form = $this->createFormBuilder($user)
                ->add('userUser', TextType::class)
                ->add('userPass', PasswordType::class)
                ->add('save', SubmitType::class, array('label' => 'Ingersar'))
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $givenUser = $form['userUser']->getData();
                $givenPass = $form['userPass']->getData();

                $em = $this->getDoctrine()->getManager();
                $getUser = $em->getRepository('AppBundle:Users')->findOneByuserUser($givenUser);                
                /*Ricardo:esta parte compara con el usuario en la base*/
                if ($getUser) {
                    /**
                     * Ricardo Burczynski: Si encuentra al usuario guarda el password
                     */
                    $getUserPassWord = $getUser->getUserPass();
                    /**
                     * Ricardo Burczynski: Ya que el usuario existe en la base, se compara que el password sea igual al dado
                     * por el usurio y de ser asi setea en el objeto session la informacion user, permissoion y rol
                     */
                    if ($getUserPassWord == $givenPass) {
                        $userRol = $getUser->getUserRole()->getUserRoleId();
                        $userPermission = $getUser->getUserPermission()->getUserPermissionId();
                        $session->set('user', $givenUser);
                        $session->set('permisson', $userPermission);
                        $session->set('rol', $userRol);
                        return $this->redirect('/userPanel');
                    }
                    else {
                        $message = "La informacion suministrada es incorrecta, reintente.";
                        return $this->render('default/index.html.twig', array('form' => $form->createView(), 'messageFalse' => $message));
                    }
                }
                else {
                    $message = "La informacion suministrada es incorrecta, reintente.";
                    return $this->render('default/index.html.twig', array('form' => $form->createView(), 'messageFalse' => $message));
                }
            }
        return $this->render('default/index.html.twig', array('form' => $form->createView()));
    }
}
