<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 09/02/2018
 * Time: 12:13
 */

namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    // cadastra o filtro na lista de funções do twig
    public function getFilters(){
        return array(
            new TwigFilter('getObjNames', array($this, 'getObjNames')),
            new TwigFilter('unsanitize', array($this, 'unsanitize')),
            new TwigFilter('getCols', array($this, 'getCols'))
            //new TwigFilter.....
            //new TwigFilter.....
            //new TwigFilter.....
        );
    }

    // trata o objeto e retorna o nome deles
    public function getObjNames($obj){

        // cria array vazio para guardar os nomes
        $arr = array();

        $obj = dump($obj);

        // loop que insere o nome dos objetos no array
        foreach($obj as $key => $value){
            $arr[] = $key;
        }
        return $arr;
    }

    public function unsanitize($str){
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        $str = str_replace(' ', '-', $str);
        //$str = str_replace('-', '_', $str);
        return $str;
    }

    public function getCols($str){
        $arr = explode(' ', $str);
        foreach ($arr as $r){
            if(strpos($r, 'col-md-') !== false){
                $return = explode('-', $r);
                return $return[2];
            }
        }
    }
}