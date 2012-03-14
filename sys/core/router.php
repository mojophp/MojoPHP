<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * A classe MJ_Router trata do roteamento das requisi��es feitas no navegador
 * para os respectivos controllers da aplica��o.
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
     * Este m�todo retorna a inst�ncia do m�todo em padr�o Singleton.
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
     * Este m�todo carrega um controlador.
     *
     * @access public
     * @return void
     */
    public function loader() {

        // Verifica a rota.
        $this->getController();

        // Se o controlador nao estiver dispon�vel retorna o erro.
        if (is_readable(APP . DS . 'controllers' . DS . $this->file . '.php') == false):
            $this->file = $this->path . 'notfoundController';
            $this->controller = 'notfound';
        endif;

        // Importa o controlador.
        App::import('controller', $this->file);

        // Inicia uma nova instancia do controlador.
        $class = $this->controller . 'Controller';
        $controller = new $class();

        // Verifica se a a��o � v�lida.
        if (is_callable(array($controller, $this->action)) == false):
            $action = 'index';
        else:
            $action = $this->action;
        endif;
        
        // Exeuta a a��o.
        $controller->$action($this->param);
    }

    /**
     * Este m�todo recupera o controller do par�metros enviados pela URL.
     *
     * @access private
     * @return void
     */
    private function getController() {

        // Recupera a rota pela URL.
        $route = (empty($_GET['rt'])) ? '' : $_GET['rt'];

        // Defini a rota padr�o para o m�todo index do controller.
        if (empty($route)):
            $route = 'index';
        else:

            // Transforma a rota em um array.
            $parts = explode('/', $route);
            $this->controller = $parts[0];

            // Defini o elemento 1 do array como a a��o do controller.
            if (isset($parts[1])):
                $this->action = $parts[1];
            endif;

            // Defini o elemento 2 do array como o par�metro a ser passado.
            if (isset($parts[2])):
                $this->param = $parts[2];
            endif;

        endif;

        // Defini o controller padr�o da aplica��o caso a rota esteja vazia.
        if (empty($this->controller)):
            $this->controller = 'index';
        endif;

        // Configura a a��o padr�o caso venha vazio pela rota.
        if (empty($this->action)):
            $this->action = 'index';
        endif;

        // Defini o nome completo do controlador.
        $this->file = $this->controller . 'Controller';
    }

}