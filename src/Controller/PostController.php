<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 14/03/2018
 * Time: 11:22
 */

namespace App\Controller;


use App\Controller\Forms\PostForms;
use App\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{

    /**
     * @Route("/admin/post/{id}", name="admin_post_single", defaults={"id": "null"})
     */
    public function edit(Request $request, $id){
        // 1) build the form
        $post = $this->getDoctrine()
                ->getRepository(Post::class)
                ->find($id);

        if(empty($post)){
            $post = new Post();
        }

        $form = $this->createForm(PostForms::class, $post);

        // 2) handle the submit
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // 4) Save the Post
            $em = $this->getDoctrine()->getManager();
            $post = $em->merge($post);
            $em->flush();

            return $this->redirectToRoute('admin_post_single', ['id' => $post->getId()]);
        }


        return $this->render( 'admin/admin_edit_padrao.html.twig', [
                'form' => $form->createView(),
                'title' => 'Usuario',
                'retorno' => 'admin_usuarios'
            ]
        );





    }
}