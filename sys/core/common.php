<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Este arquivo � uma biblioteca de fun��es comuns do Mojo*PHP que podem ser
 * usadas em qualquer parte da aplica��o.
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 */

/**
 * Converte um array em objeto.
 * 
 * @param array $array
 * @return stdClass 
 */
function array_to_object($array) {
    $object = new stdClass();
    if (is_array($array) && count($array) > 0) {
        foreach ($array as $name => $value) {
            $name = strtolower(trim($name));
            if (!empty($name)) {
                $object->$name = $value;
            }
        }
    }
    return $object;
}

/**
 * Converte um objeto em um array.
 * 
 * @param mixed $object
 * @return array 
 */
function object_to_array($object) {
    $array = array();
    if (is_object($object)) {
        $array = get_object_vars($object);
    }
    return $array;
}

/**
 * Esta fun��o calcula o tempo de execuss�o da p�gina.
 * 
 * @return string
 */
function get_time_generator(){
    $t_start = array_sum(explode(' ', microtime()));
    $exec_time = array_sum(explode(' ', microtime())) - $t_start;
    $exec_time1 = (ceil($exec_time * 10000))/10000;
    return $exec_time1;
    
}