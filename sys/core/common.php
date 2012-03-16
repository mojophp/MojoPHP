<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Este arquivo é uma biblioteca de funções comuns do Mojo*PHP que podem ser
 * usadas em qualquer parte da aplicação.
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
 * Esta função calcula o tempo de execussão da página.
 * 
 * @return string
 */
function get_time_generator(){
    $t_start = array_sum(explode(' ', microtime()));
    $exec_time = array_sum(explode(' ', microtime())) - $t_start;
    $exec_time1 = (ceil($exec_time * 10000))/10000;
    return $exec_time1;
    
}

/**
 * Esta função retorna uma instância de um objeto model ou 
 * library dentro do Mojo*PHP.
 * 
 * @param string $class     Classe desejada.
 * @param string $tipo      Tipo da classe, lib (Library) ou model (Models).
 * @param string $name      Nome da classe caso seja diferente do nome do arquivo.
 * @param string $param     Parâmetros não obrigatórios a serem passados para o objeto.
 * @return mixed 
 */
function get_instance($class, $tipo = 'lib', $name = NULL, $param = NULL){
    switch ($tipo):
        case 'lib':
            MJ_Loader::loadLibrary($class, $name, $param);
            break;
        case 'model':
            MJ_Loader::loadModel($class, $name, $param);
            break;
    endswitch;
    return MJ_Loader::load($class);
}