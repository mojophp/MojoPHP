<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Esta é a superclasse herdada por todos os models da aplicação, ela herda
 * todas as funcionalidades da classe MJ_Datasource, trazendo o suporte ao
 * banco de dados configurado na aplicação.
 *
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 * @since 26/12/2012
 */
class MJ_Model extends MJ_Datasource {

    function __construct() {
        parent::__construct();
    }

}