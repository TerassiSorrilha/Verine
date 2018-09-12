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
    // tentar padronizar este formato em tudo
    public static function getNow(){
        return \DateTime::createFromFormat('Y-m-d H:i:s', 'now');
    }
}