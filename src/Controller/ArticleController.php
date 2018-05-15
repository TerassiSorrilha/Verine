<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 30/01/2018
 * Time: 20:04
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show($slug){
        // debug
        // dump($slug, $this);
        // usar sem parametros no arquivo de template para printar tudo
        $comments = [
            "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born.",
            "And expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.",
            "No one rejects, dislikes, or avoids pleasure itself, because it is pleasure"
        ];
        return $this->render('article/post_show.html.twig',[
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'slug' => $slug,
            'comments' => $comments
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug){
        //TODO - actually heart/unheart the article!

        return new JsonResponse(['hearts' => rand(5,100)]);
    }
}