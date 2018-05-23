<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 14/03/2018
 * Time: 11:22
 */

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Services\Filtros;
use App\Utils\Slugger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/post")
 * @Security("has_role('ROLE_ADMIN')")
 */
class PostController extends Controller
{

    /**
     * Lists all Post entities.
     *
     * This controller responds to two different routes with the same URL:
     *   * 'admin_post_index' is the route with a name that follows the same
     *     structure as the rest of the controllers of this class.
     *   * 'admin_index' is a nice shortcut to the backend homepage. This allows
     *     to create simpler links in the templates. Moreover, in the future we
     *     could move this annotation to any other controller while maintaining
     *     the route name and therefore, without breaking any existing link.
     *
     * @Route("/", methods={"GET"}, name="admin_index")
     * @Route("/", methods={"GET"}, name="admin_post_index")
     */
    public function index(): Response
    {
        $form = new Filtros(Post::class, $this);
        $form->trataObjetos();

        return $this->render('admin/admin_cadastro_padrao.html.twig', [
            'itens' => $form->getDados(),
            'title' => 'Posts',
            'edit' => 'admin_post_single',
        ]);
    }

    /**
     * Creates a new Post entity.
     *
     * @Route("/{id}", methods={"GET", "POST"}, name="admin_post_single", defaults={"id": "null"})
     *
     * NOTE: the Method annotation is optional, but it's a recommended practice
     * to constraint the HTTP methods each controller responds to (by default
     * it responds to all methods).
     */
    public function edita(Request $request, $id): Response
    {
        // 1) build the form
        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->find($id);

        if(empty($post)){
            $post = new Post();
        }

        $post->setAuthor($this->getUser());
        $form = $this->createForm( PostType::class, $post)
            ->add('saveAndCreateNew', SubmitType::class);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        // the isSubmitted() method is completely optional because the other
        // isValid() method already checks whether the form is submitted.
        // However, we explicitly add it to improve code readability.
        // See https://symfony.com/doc/current/best_practices/forms.html#handling-form-submits
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setSlug(Slugger::slugify($post->getTitle()));

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $post = $em->merge($post);    // atualiza o objeto original

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();

            // Flash messages are used to notify the user about the result of the
            // actions. They are deleted automatically from the session as soon
            // as they are accessed.
            // See https://symfony.com/doc/current/book/controller.html#flash-messages
            $this->addFlash('success', 'post.created_successfully');

            return $this->redirectToRoute('admin_post_single', ['id' => $post->getId()]);
        }

        return $this->render('admin/admin_post_edit.html.twig', [
            'itens' => $post,
            'title' => 'Post',
            'retorno' => 'admin_post_index',
            'form' => $form->createView(),
        ]);
    }
}