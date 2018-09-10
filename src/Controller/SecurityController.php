<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 26/03/2018
 * Time: 10:37
 */

namespace App\Controller;


use App\Entity\Usuarios;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils, UserPasswordEncoderInterface $encoder){

        // 1) Procura todos os usuarios
        $usuario = $this->getDoctrine()
            ->getRepository(Usuarios::class)
            ->findAll();

        // 2) Senão tem nenhum, cadastra um novo
        if(empty($usuario)){
            $usuario = new Usuarios();

            // faz o encode da senha
            $encoded = $encoder->encodePassword($usuario, "admin");
            $usuario->setPassword($encoded);
            $usuario->setName("Administrador");
            $usuario->setUsername("admin");
            $usuario->setEmail("admin@admin.com");

            //$usuario->set
            // 3) salva o usuario
            $em = $this->getDoctrine()->getManager();

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $em->merge($usuario);    // atualiza o objeto original

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('admin/admin_login.html.twig', [
            'last_username'  => $lastUsername,
            'error'          => $error,
        ]);
    }
}