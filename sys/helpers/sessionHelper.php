<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Este arquivo � o helper que cont�m as fun��es para gerenciamento 
 * e manipula��o de sess�es do Mojo*PHP.
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 * @since 26/02/2012
 */

/**
 * Cria uma vari�vel de sess�o com o valor criptografado.
 * 
 * @param string $name Nome da sess�o.
 * @param mixed $value valor da sess�o.
 */
function set_sessao($name, $value = null) {
    @$_SESSION[$name] = base64_encode($value);
}

/**
 * Recupera o valor de uma sess�o.
 * 
 * @param string $name Nome da sess�o.
 * @return mixed 
 */
function get_sessao($name) {
    return base64_decode(@$_SESSION[$name]);
}

/**
 * Esvazia uma se��o ou mata dodas as sess�es existentes 
 * caso $name esteja em branco.
 * 
 * @param mixed $name Nome da sess�o, pode ser uma �nica sess�o ou um array de sess�es..
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