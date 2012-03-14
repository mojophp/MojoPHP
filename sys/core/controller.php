<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Esta � classe base para os controllers da aplica��o, ela herda a classe
 * MJ_Loader que traz as op��es de de registro de objetos e recupera��o
 * das inst�ncias dos mesmos.
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 * @since 26/02/2012
 * 
 */
class MJ_Controller extends MJ_Loader {

    function __construct() {
        
    }

}