<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 26/03/2018
 * Time: 10:37
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils){

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        dump($this);
        
        return $this->render('admin/admin_login.html.twig', [
            'last_username'  => $lastUsername,
            'error'          => $error,
        ]);
    }
}