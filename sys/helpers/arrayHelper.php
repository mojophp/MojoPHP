<?php

if (!defined('BASE_PATH'))
	exit('Acesso negado!');

/**
 * Este arquivo � o helper que re�ne as fun��es para manipula��o
 * de arrays no Mojo*PHP.
 * 
 * - Inspirado/Derivado do CodeIgniter� (http://www.codeigniter.com)
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 */


/**
 * Permite determinar se um �ndice do array est� definido e se tem um valor.
 * Se o elemento � vazio ele retorna FALSE (ou o que voc� especificar como o valor padr�o.)
 * @access	public
 * @param	string
 * @param	array
 * @param	mixed
 * @return	mixed	depende do que cont�m no array.
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
 * @return	mixed	depende do que cont�m no array.
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
 * Retorna somente os �tens especificados do array. Ir� retornar um valor 
 * padr�o se ele n�o est� definido.
 *
 * @access	public
 * @param	array
 * @param	array
 * @param	mixed
 * @return	mixed	depende do que cont�m no array.
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