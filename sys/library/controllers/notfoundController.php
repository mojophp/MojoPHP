<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Esta classe é o controller padrão para casos em que o router não
 * encontra a classe requisitada.
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 */
class notfoundController extends MJ_Controller {

    public function index() {
        $data['error_message'] = 'A classe solicitada não foi encontrada. 
            Entre em contato com o administrador.';
        $this->loadView('error', $data);
    }

}