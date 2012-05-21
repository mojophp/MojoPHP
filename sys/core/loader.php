<?php

if (!defined('BASE_PATH'))exit('Acesso negado!');

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
     * @param string $model 
     * @param string $alias
     * @return bool 
     */
    public static function loadModel($model = '', $alias = NULL) {
        if($model=='')exit('ERRO - Model indefinido.');
        if(!$alias)$alias = strtolower($model);
        if(!MJ_Registry::reg_exists($alias)):
            if(file_exists(App::path('model', $model.'Model'))):
                App::import('model', $model.'Model');
                $objeto = new $class();
                parent::reg_add($objeto, $alias);
            else:
                exit('ERRO - Model não encontrado: '.$model);
            endif;
        endif;
    }

    /**
     * Este método carrega uma biblioteca (classe) para o registro.
     * 
     * @access public
     * @param string $library
     * @param string $alias
     * @param mixed $param
     * @return mixed 
     */
    public static function loadLibrary($library = '', $alias = NULL, $param = NULL){
        if($library=='')exit('ERRO 1 - Biblioteca sem nome definido.');
        if(!$alias)$alias = strtolower($library);
        if(!MJ_Registry::reg_exists($alias)):
            if(file_exists(App::path('lib', $library))):
                App::import('lib', $library);
                $objeto = new $class($param);
                parent::reg_add($objeto, $alias);
            else:
                exit('ERRO 2 - Biblioteca não encontrada: '.$library);
            endif;
        endif;
    }

    /**
     * Este método carrega um arquivo de helper para ser usado no controller.
     * 
     * @access public
     * @param string $helper
     * @return bool 
     */
    public static function loadHelper($helper = '') {
        if($helper == '')return false;
        if(file_exists(App::path('helper', $helper . 'Helper'))):
            App::import('helper', $helper . 'Helper');
        else:
            return false;
        endif;
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
        $module = MJ_Router::getModuleName();
        $file = App::path('views', $view, 'php', $module );
        if (sizeof($data) > 0)extract($data, EXTR_SKIP);
        if (file_exists($file)):
            if ($string):
                ob_start();
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
    }

    /**
     * Este método carrega uma instancia de um objeto armazenado previamente
     * no registro para ser usado e está disponível para uso.
     * 
     * @access public
     * @param string $alias
     * @return mixed 
     */
    public static function load($alias) {
        return self::reg_get($alias);
    }

}