<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Este arquivo contém as classes com as funcionalidades mais básicas do Mojo*PHP
 * que são App() e Config(). Elas são usadas em vários momentos durante o
 * funcionamento do Mojo*PHP.
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 */

/**
 * A classe App() possui funcionalidades importantes no funcionamento do Mojo*PHP
 * confirmando caminhos e importando os arquivos da aplicação.
 */
class App {

    /**
     * Este método importa um arquivo para ficar disponível para o sistema.
     * 
     * @access public
     * @param string $type
     * @param string $file
     * @param string $ext
     * @param string $module
     * @return mixed 
     */
    public static function import($type = "core", $file = "", $ext = "php", $module = "main") {
        if (is_array($file)):
            foreach ($file as $file):
                $include = self::import($type, $file, $ext, $module);
            endforeach;
            return $include;
        else:
            if ($file_path = self::path($type, $file, $ext, $module)):
                return require_once $file_path;
            else:
                die('Erro na importaçao do arquivo ' . $file);
                trigger_error("File {$file}.{$ext} doesn't exists in {$type}", E_USER_WARNING);
            endif;
        endif;
        return false;
    }

    /**
     * Este método retorna o caminho completo de um arquivo solicitado durante 
     * a o import() ou confirmando sua existencia quando necessário.
     * 
     * @access public
     * @param string $type
     * @param string $file
     * @param string $ext
     * @param string $module
     * @return string 
     */
    public static function path($type = "core", $file = "", $ext = "php", $module = 'main') {
        $paths = array(
            "core" => array(CORE),
            "modules" => array(APP . DS . 'modules', SYS . DS . 'library'),
            "controller" => array(APP . DS . 'modules' . DS . $module . DS . 'controllers', SYS . DS . 'library/controllers'),
            "model" => array(APP . DS . 'models'),
            "views" => array(APP . DS . 'modules' . DS . $module . DS . 'views', SYS . DS . 'library/views'),
            "helper" => array(APP . DS . 'helpers', SYS . DS . 'helpers'),
            "lib" => array(APP . DS . 'library', SYS . DS . 'library'),
            "config" => array(APP . DS . 'config', SYS . DS . 'config'),
            "drivers" => array(SYS . DS . 'library' . DS . 'drivers')
        );
        foreach ($paths[$type] as $path):
            $file_path = $path . DS . "{$file}.{$ext}";
            if (file_exists($file_path)):
                return $file_path;
            endif;
        endforeach;
        return false;
    }
}

/**
 * A classe Config trata do gerenciamento das configurações do sistema.
 * 
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 * @since 26/12/2012
 */
class Config {

    /**
     * Definições de configurações.
     *
     * @var array
     */
    private $config = array();

    /**
     *  Retorna uma única instância (padrão Singleton) da classe solicitada.
     *
     * @access public
     * @staticvar object $instance Objeto a ser verificado
     * @return object Objeto da classe utilizada
     */
    public static function &getInstance() {
        static $instance = array();
        if (!isset($instance[0]) || !$instance[0]):
            $instance[0] = new Config();
        endif;
        return $instance[0];
    }

    /**
     *  Retorna o valor de uma determinada chave de configuração.
     *
     * @access public
     * @param string $key Nome da chave da configuração
     * @return mixed Valor de configuração da respectiva chave
     */
    public static function read($key = "") {
        $self = self::getInstance();
        return $self->config[$key];
    }

    /**
     *  Grava o valor de uma configuração da aplicação para determinada chave.
     *
     * @access public
     * @param string $key Nome da chave da configuração
     * @param string $value Valor da chave da configuração
     * @return boolean true
     */
    public static function write($key = "", $value = "") {
        $self = self::getInstance();
        $self->config[$key] = $value;
        return true;
    }

}