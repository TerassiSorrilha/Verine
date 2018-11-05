<?php
/**
 * Created by PhpStorm.
 * User: Cleiton
 * Date: 14/09/2018
 * Time: 11:03
 */

namespace App\Services;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// salva na session o objeto a fazer undo usando o nome da controller como index
class Undo
{
    private $em;  // entity managem
    private $ctr; // controladora a ser salva

    // salva as propriedades e esvazia a session
    public function __construct(Controller $ctr, ObjectManager $em)
    {
        // salva controladora
        $this->ctr = $ctr;
        $this->em = $em;

        // esvazia a session
        unset($_SESSION[$_SESSION["do_undo"]]);     // retira lixo da session

        $_SESSION[get_class($ctr)] = array();
        $_SESSION["do_undo"] = get_class($ctr);
    }

    // salva o objeto na session e efetua o merge
    public function merge($obj, $old){
        // salva na session
        $_SESSION[get_class($this->ctr)][] = $old;

        // faz o merge
        $mg = $this->em->merge($obj);    // atualiza o objeto original

        // actually executes the queries (i.e. the INSERT query)
        $this->em->flush();

        // retorna novo objeto
        return $mg;
    }
}