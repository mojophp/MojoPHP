<?php

if (!defined('BASE_PATH'))
	exit('Acesso negado!');

/**
 * Este arquivo é o helper que reúne as funções para manipulação
 * de arrays no Mojo*PHP.
 * 
 * - Inspirado/Derivado do CodeIgniter® (http://www.codeigniter.com)
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 */


/**
 * Permite determinar se um índice do array está definido e se tem um valor.
 * Se o elemento é vazio ele retorna FALSE (ou o que você especificar como o valor padrão.)
 * @access	public
 * @param	string
 * @param	array
 * @param	mixed
 * @return	mixed	depende do que contém no array.
 */
function element($item, $array, $default = FALSE) {
    if (!isset($array[$item]) OR $array[$item] == "") {
        return $default;
    }

    return $array[$item];
}

// ------------------------------------------------------------------------

/**
 * Retorna um elemento rotativo tendo um array como base.
 *
 * @access	public
 * @param	array
 * @return	mixed	depende do que contém no array.
 */
function random_element($array) {
    if (!is_array($array)) {
        return $array;
    }

    return $array[array_rand($array)];
}

// --------------------------------------------------------------------

/**
 * Elements
 *
 * Returns only the array items specified.  Will return a default value if
 * it is not set.
 * Retorna somente os ítens especificados do array. Irá retornar um valor 
 * padrão se ele não está definido.
 *
 * @access	public
 * @param	array
 * @param	array
 * @param	mixed
 * @return	mixed	depende do que contém no array.
 */
function elements($items, $array, $default = FALSE) {
    $return = array();

    if (!is_array($items)) {
        $items = array($items);
    }

    foreach ($items as $item) {
        if (isset($array[$item])) {
            $return[$item] = $array[$item];
        } else {
            $return[$item] = $default;
        }
    }

    return $return;
}