<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 14/03/2018
 * Time: 08:08
 */

namespace App\Controller;

use App\Entity\Usuarios;
use App\Form\Search\UsuariosSearch;
use App\Form\UsuariosType;
use App\Services\Filtros;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/usuarios")
 */

class UsuariosController extends Controller
{
    /**
     * @Route("/", name="admin_usuarios", methods={"GET"})
     */
    public function show(Request $request)
    {
        $form = new Filtros(Usuarios::class, $this);
        $form->geraForm($request, UsuariosSearch::class);

        // passa dados recuperados para a view
        return $this->render('admin/admin_cadastro_padrao.html.twig', [
            'itens' => $form->getDados(),
            'form'  => $form->getForm()->createView(),
            'title' => 'Usuarios',
            'edit' => 'admin_usuarios_single',
        ]);
    }

    /**
     * @Route("/{id}", name="admin_usuarios_single", defaults={"id": "null"})
     */
    public function edita(UserPasswordEncoderInterface $encoder, Request $request, $id){
        // 1) build the form
        $usuario = $this->getDoctrine()
            ->getRepository(Usuarios::class)
            ->find($id);

        if(empty($usuario)){
            $usuario = new Usuarios();
        }

        $form = $this->createForm( UsuariosType::class, $usuario);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // faz o encode da senha
            $encoded = $encoder->encodePassword($usuario, $form["password"]->getData());
            $usuario->setPassword($encoded);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $usuario = $em->merge($usuario);    // atualiza o objeto original

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();

            return $this->redirectToRoute('admin_usuarios_single', ['id' => $usuario->getId()]);
        }

        return $this->render( 'admin/admin_edit_padrao.html.twig', [
               'form' => $form->createView(),
                'title' => 'Usuario',
                'retorno' => 'admin_usuarios'
            ]
        );
    }
}