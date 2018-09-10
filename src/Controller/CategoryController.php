<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 07/02/2018
 * Time: 23:02
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories/{$slug}", name="category_show")
     */

    public function show($slug){
        return new Response("isto e uma categoria{$slug}");
    }
}