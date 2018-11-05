<?php
/**
 * Created by PhpStorm.
 * User: Cleiton
 * Date: 14/09/2018
 * Time: 16:35
 */

namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * @Route("/admin")
 */
class UndoController extends Controller
{

    /**
     * @Route("/do_undo", methods={"POST"})
     */
    public function do_undo(){

    }
}