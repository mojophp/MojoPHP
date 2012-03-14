<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Este arquivo é o helper que trata da criptografia de dados dentro do Mojo*PHP.
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 */

/**
 * Codifica uma string com base64 5 vezes e retorna a string invertida.
 * 
 * @param string $str
 * @return string 
 */
function encode5($str) {
    for ($i = 0; $i < 5; $i++) {
        $str = strrev(base64_encode($str));
    }
    return $str;
}

/**
 * Descriptografa uma string codificada com encode5()
 * 
 * @param string $str
 * @return string 
 */
function decode5($str) {
    for ($i = 0; $i < 5; $i++) {
        $str = base64_decode(strrev($str));
    }
    return $str;
}

/**
 * Esta função criptografa uma string em vários algoritmos diferentes.
 * 
 * @param string $str
 * @param string $hash - sha1, sha512, md5, whirlpool ou salsa20.
 * @param mixed $salt
 * @return string 
 */
function set_crypt($str, $hash = 'sha1', $salt = '') {

    if (!$str):
        return false;
    endif;

    if ($salt):
        $str = $str . $salt;
    endif;

    switch ($hash):
        case 'sha1' :
            $str = hash('sha1', $str);
            break;
        case 'sha512' :
            $str = hash('sha512', $str);
            break;
        case 'md5' :
            $str = hash('md5', $str);
            break;
        case 'whirlpool' :
            $str = hash('whirlpool', $str);
            break;
        case 'salsa20' :
            $str = hash('salsa20', $str);
            break;
    endswitch;

    return $str;
}