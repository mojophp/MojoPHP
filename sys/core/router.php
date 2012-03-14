<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * A classe MJ_Router trata do roteamento das requisições feitas no navegador
 * para os respectivos controllers da aplicação.
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 * @since 26/12/2012
 */
class MJ_Router {

    private $path;
    public $file;
    public $controller;
    public $action;
    public $param;

    private function __construct() {
        $this->loader();
    }

    /**
     * Este método retorna a instãncia do método em padrão Singleton.
     * 
     * @access public
     * @staticvar array $instance
     * @return MJ_Router 
     */
    public static function &getInstance() {
        static $instance = array();
        if (!isset($instance[0]) || !$instance[0]):
            $instance[0] = new MJ_Router();
        endif;
        return $instance[0];
    }

    /**
     * Este método carrega um controlador.
     *
     * @access public
     * @return void
     */
    public function loader() {

        // Verifica a rota.
        $this->getController();

        // Se o controlador nao estiver disponível retorna o erro.
        if (is_readable(APP . DS . 'controllers' . DS . $this->file . '.php') == false):
            $this->file = $this->path . 'notfoundController';
            $this->controller = 'notfound';
        endif;

        // Importa o controlador.
        App::import('controller', $this->file);

        // Inicia uma nova instancia do controlador.
        $class = $this->controller . 'Controller';
        $controller = new $class();

        // Verifica se a ação é válida.
        if (is_callable(array($controller, $this->action)) == false):
            $action = 'index';
        else:
            $action = $this->action;
        endif;
        
        // Exeuta a ação.
        $controller->$action($this->param);
    }

    /**
     * Este método recupera o controller do parãmetros enviados pela URL.
     *
     * @access private
     * @return void
     */
    private function getController() {

        // Recupera a rota pela URL.
        $route = (empty($_GET['rt'])) ? '' : $_GET['rt'];

        // Defini a rota padrão para o método index do controller.
        if (empty($route)):
            $route = 'index';
        else:

            // Transforma a rota em um array.
            $parts = explode('/', $route);
            $this->controller = $parts[0];

            // Defini o elemento 1 do array como a ação do controller.
            if (isset($parts[1])):
                $this->action = $parts[1];
            endif;

            // Defini o elemento 2 do array como o parâmetro a ser passado.
            if (isset($parts[2])):
                $this->param = $parts[2];
            endif;

        endif;

        // Defini o controller padrão da aplicação caso a rota esteja vazia.
        if (empty($this->controller)):
            $this->controller = 'index';
        endif;

        // Configura a ação padrão caso venha vazio pela rota.
        if (empty($this->action)):
            $this->action = 'index';
        endif;

        // Defini o nome completo do controlador.
        $this->file = $this->controller . 'Controller';
    }

}