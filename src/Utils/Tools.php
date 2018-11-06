<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Utils;

/**
 * @author Cleiton Terassi
 */
class Tools
{
    // padrão de bd
    public static function DateDB($date = 'now'){
        $data = new \DateTime($date, new \DateTimeZone('America/Sao_Paulo'));
        $data->format('Y-m-d H:i:s');
        return $data;
    }

    // padrão de usuario
    public static function DateUser($data = 'now'){
        if(method_exists($data, 'format')){
            $data->setTimezone(new \DateTimeZone('America/Sao_Paulo'));
        }
        else{
            $data = new \DateTime($data, new \DateTimeZone('America/Sao_Paulo'));
        }
        return $data->format('d-m-Y H:i');
    }

    // converte dinheiro para salvar no bd
    public static function moneyDB($val){

        return str_replace(",", ".", str_replace(".", "", $val));
    }

    // conver dinheiro para mostrar ao usuario
    public static function moneyUser($val){
        return number_format($val, 2, ',', '.');
    }
}