<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 07/02/2018
 * Time: 22:54
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(){
        // categorias
        $categories_template = array(
            "futuro",
            "filmes",
            "jogos"
        );

        // artigos
        $articles_template = array(
            "title" => "eu voltarei",
            "link" => "eu-voltarei",
            "text" => "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born."
        );

        for($i=0; $i < 20; $i++){
            $articles_template["categories"] = $categories_template;
            $articles[$i] = $articles_template;
        }

        return $this->render('index.html.twig',[
            'articles' => $articles
        ]);
    }
}