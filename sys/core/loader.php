<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * A classe MJ_Loader é responsável pelo carregamento das bibliotecas do Mojo*PHP
 * no registro evitando o instanciamento de objetos repetidos.
 *
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 * @since 26/12/2012
 */
class MJ_Loader extends MJ_Registry {

    /**
     * Este método carrega um model para o registro.
     * 
     * @access public
     * @param string $Class
     * @param string $name
     * @return bool 
     */
    public static function loadModel($Class = '', $name = NULL) {
        // Verifica se $Class está em branco.
        if ($Class == '')
            return false;
        // Defini $name caso venha vazio.
        if (!$name):
            $name = $Class;
        endif;
        // Verifica se $name já existe no registro.
        if (!MJ_Registry::reg_exists($name)):
            // Verifica se o arquivo existe.
            if (file_exists(App::path('model', $Class . 'Model'))):
                App::import('model', $Class . 'Model');
            else:
                exit('Não foi possível encontrar o model ' . App::path('model', $Class . 'Model'));
            endif;
            // Instancia o objeto para registrar.
            $objeto = new $Class();
            parent::reg_add($objeto, $name);
            return true;
        else:
            return false;
        endif;
    }

    /**
     * Este método carrega uma biblioteca (classe) para o registro.
     * 
     * @access public
     * @param string $Class
     * @param string $name
     * @return bool 
     */
    public static function loadLibrary($Class = '', $name = NULL, $param = NULL) {
        // Verifica se $Class está em branco.
        if ($Class == '')
            return false;
        // Defini $nome caso venha vazio.
        if (!$name):
            $name = $Class;
        endif;
        // Verifica se $name já existe no registro.
        if (!MJ_Registry::reg_exists($name)):
            // Verifica se o arquivo existe.
            if (file_exists(App::path('lib', $Class))):
                App::import('lib', $Class);
            else:
                exit('Não foi possível encontrar a biblioteca ' . App::path('lib', $Class));
            endif;
            // Instancia o objeto para registrar.
            $objeto = new $Class($param);
            parent::reg_add($objeto, $name);
            return true;
        else:
            return false;
        endif;
    }

    /**
     * Este método carrega um arquivo de helper para ser usado no controller.
     * 
     * @access public
     * @param string $file
     * @return bool 
     */
    public static function loadHelper($file = '') {
        if ($file == '')
            return false;
        if (file_exists(App::path('helper', $file . 'Helper'))) {
            App::import('helper', $file . 'Helper');
        } else {
            return false;
        }
    }

    /**
     * Este método carrega uma view para ser usada no controller.
     * 
     * @access public
     * @param string $view
     * @param array $data
     * @param string $string
     * @return mixed 
     */
    public function loadView($view, $data = NULL, $string = FALSE) {
        $file = App::path('views', $view);
        if (sizeof($data) > 0)
            extract($data, EXTR_SKIP);
        if (file_exists($file)):
            if ($string):
                // Retorna o arquivo como uma string.
                ob_start();
                // Inclui o arquivo da view.
                include($file);
                $content = ob_get_contents();
                ob_end_clean();
                return $content;
            else:
                include($file);
            endif;
        else:
            die("Não foi possível carregar o arquivo da view: " . $file);
            return false;
        endif;
        return true;
    }

    /**
     * Este método carrega uma instancia de um objeto armazenado previamente
     * no registro para ser usado e está disponível para uso.
     * 
     * @access public
     * @param string $name
     * @return mixed 
     */
    public static function load($name) {
        return self::reg_get($name);
    }

}