<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Esta classe cuida da conexão entre a camada de dados e os models no Mojo*PHP
 * selecionando o drive correto e padronizando alguns comandos para os models.
 *
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 * @since 26/12/2012
 */
class MJ_Datasource extends MJ_Registry {

    public $db = NULL;

    function __construct() {

        $config = Config::read('database');
        $driver = $config[ENVIROMENT]['driver'];

        App::import('drivers', $driver);
        $this->db = new $driver($config);
    }

}