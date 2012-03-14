<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Este arquivo é o helper que contém as funções para gerenciamento 
 * e manipulação de sessões do Mojo*PHP.
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 * @since 26/02/2012
 */

/**
 * Cria uma variável de sessão com o valor criptografado.
 * 
 * @param string $name Nome da sessão.
 * @param mixed $value valor da sessão.
 */
function set_sessao($name, $value = null) {
    @$_SESSION[$name] = base64_encode($value);
}

/**
 * Recupera o valor de uma sessão.
 * 
 * @param string $name Nome da sessão.
 * @return mixed 
 */
function get_sessao($name) {
    return base64_decode(@$_SESSION[$name]);
}

/**
 * Esvazia uma seção ou mata dodas as sessões existentes 
 * caso $name esteja em branco.
 * 
 * @param mixed $name Nome da sessão, pode ser uma única sessão ou um array de sessões..
 */
function clear_sessao($name = '') {
    if ($name):
        if (is_array($name)):
            foreach ($name as $row) {
                clear_sessao($row);
            }
        else:
            set_sessao($name, NULL);
        endif;
    else:
        session_destroy();
    endif;
}