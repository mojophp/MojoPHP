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
    public $module;
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
        // Cria a localizacao do arquivo do controlador
        $controllerClassPath = APP . DS . 'modules' . DS . $this->module . DS . 'controllers' . DS . $this->file . '.php';
        // Se o controlador nao estiver disponível retorna o erro.
        if (!is_readable($controllerClassPath)) {
            $this->file = $this->path . 'notfoundController';
            $this->controller = 'notfound';
            $this->module = '';
        }
        // Importa o arquivo do controlador.
        App::import('controller', $this->file, 'php', $this->module);
        // Inicia uma nova instancia do controlador.
        $class = $this->controller . 'Controller';
        // Verifica se a classe existe e é instanciável.
        if (!class_exists($class, FALSE)) {
            die('nao existe');
            trigger_error($class . ' not exists.', E_USER_ERROR);
        }
        // Instancia a classe do controlador.
        $controller = new $class();
        // Defini a ação padrão caso não receba nenhuma ação leoa URL.
        if ($this->action == '') {
            $this->action = 'index';
        }
        // Verifica se a açao é executável.
        if (is_callable(array($controller, $this->action)) == false) {
            throw new Exception('A classe <i>' . $this->action . '</i> não existe no controller ' . $class);
            //  trigger_error('A classe <i>'.$this->action.'</i> não existe no controller '.$class, E_USER_ERROR);
        }
        // Recebe a ação.
        $action = $this->action;
        // Executa a ação.
        $controller->$action($this->param);
        //print('Controler: '); var_dump($controller); print('<br/> Action:'); var_dump($action); print('<br/>Params: '); var_dump($this->param); die();
    }

    /**
     * Este método recupera o controller do parãmetros enviados pela URL.
     *
     * @access private
     * @return void
     */
    private function getController() {
        //Recupera a rota pela URL.
        $route = (empty($_GET['rt'])) ? '' : $_GET['rt'];
        if (empty($route)):
            $route = 'index';
            //TODO Criar uma forma do desenvolvedor configurar o modulo padrao no arquivo de configuracao.
            $this->module = 'main';
        else:
            // Pega a rota em partes.
            $parts = explode('/', $route);
            $this->controller = $parts[0];
            // Recupera o array de módulos.
            $modules = self::getModulesArray();
            if (in_array($this->controller, $modules)):
                $this->module = $parts[0];
                unset($parts[0]);
                $parts = array_values($parts);
                if (isset($parts[0])) {
                    $this->controller = $parts[0];
                } else {
                    $this->controller = 'index';
                }
            else:
                //TODO Criar uma forma do desenvolvedor configurar o modulo padrao ano arquivo de configuracao.
                $this->module = 'main';
            endif;
            // Define a ação
            if (isset($parts[1])):
                $this->action = $parts[1];
            endif;
            // Define o parâmetro
            if (isset($parts[2])):
                $this->param = $parts[2];
            endif;
        endif;
        // Define o controlador padrão caso não seja indicado nenhum na URL.
        if (empty($this->controller)):
            $this->controller = 'index';
        endif;
        // Define a ação padrão caso não seja indicada nenhuma na URL.
        if (empty($this->action)):
            $this->action = 'index';
        endif;
        // Configura o caminho para o arquivo do controlador.
        $this->file = $this->controller . 'Controller';
    }

    /**
     * Recupera a lista de módulos.
     *
     * @access public
     * @return Array
     */
    public static function getModulesArray() {
        $modules_dir = APP . DS . 'modules';
        $modules_array = array();
        // Verifica se o diretório de módulos está acessível.
        if (!is_readable($modules_dir)) {
            throw new Exception('Verifique se o diretorio ' . $modules_dir . ' esta acessivel ou se o mesmo existe.');
        }
        // Testa o diretório de módulos.
        if (!is_dir($modules_dir)) {
            throw new Exception('O diretório de módulos ' . $modules_dir . ' é inválido.');
        }
        // Abre o diretório.
        $handle = opendir($modules_dir);
        if ($handle) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $modules_array[] = $entry;
                }
            }
            // Fecha o diretório.
            closedir($handle);
        }
        return $modules_array;
    }

    /**
     * Recupera o nome do módulo.
     *
     * @access public
     * @return String
     */
    public static function getModuleName() {
        // Recupera a rota pela URL.
        $route = (empty($_GET['rt'])) ? '' : $_GET['rt'];
        $module = 'main';
        if (!empty($route)) {
            // Pega a rota em partes.
            $parts = explode('/', $route);
            // Recupera a lista de módulos em array.
            $modules = self::getModulesArray();
            if (in_array($parts[0], $modules)) {
                $module = $parts[0];
            } else {
                //TODO Criar uma forma do desenvolvedor configurar o modulo padrao no arquivo de configuracao.
                $module = 'main';
            }
        }
        return $module;
    }

}