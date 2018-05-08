<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 01/05/2018
 * Time: 16:21
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TODOController extends Controller
{
    /**
     * @Route("admin/TODO/", name="TODO_show")
     */
    public function show(){
        return $this->render("admin/admin_TODO.html.twig");
    }
}