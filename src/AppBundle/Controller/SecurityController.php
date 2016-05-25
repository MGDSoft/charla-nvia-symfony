<?php


namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        if ($error) {
            $this->addFlash('danger', 'Incorrect login');
        }

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {
        return $this->redirectToRoute('home');
    }
}