<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 15/05/2018
 * Time: 15:24
 */

namespace App\Controller;


use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class appIndexController extends AbstractController
{
    /**
     * @Route("/", defaults={"page": "1", "_format"="html"}, methods={"GET"}, name="app_index")
     * @Route("/{page}", requirements={"page": "[1-9]\d*"}, methods={"GET"}, name="app_homepage")
     */
    public function index(int $page, PostRepository $posts): Response
    {
        $latestPosts = $posts->findLatest($page);

        // Every template name also has two extensions that specify the format and
        // engine for that template.
        // See https://symfony.com/doc/current/templating.html#template-suffix
        return $this->render('app/index.html.twig', [
            'itens' => $latestPosts
        ]);
    }

    /**
     * @Route("/posts/{slug}", methods={"GET"}, name="app_post")
     *
     * NOTE: The $post controller argument is automatically injected by Symfony
     * after performing a database query looking for a Post with the 'slug'
     * value given in the route.
     */
    public function postShow(Post $post): Response
    {
        // Symfony's 'dump()' function is an improved version of PHP's 'var_dump()' but
        // it's not available in the 'prod' environment to prevent leaking sensitive information.
        // It can be used both in PHP files and Twig templates, but it requires to
        // have enabled the DebugBundle. Uncomment the following line to see it in action:

        return $this->render('app/post_show.html.twig', [
            'itens' => $post
        ]);
    }
}