<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Esta é a classe de registro do Mojo*PHP, ela é responsavel por
 * registrar todas as classes do sistema.
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 * @since 29/02/2012
 */
class MJ_Registry {

    /**
     * Esta é a variável de registro, contém um array com todos os objetos
     * instanciados pela classe.
     * 
     * @var array 
     */
    private static $_register = array();

    /**
     * Este método adiciona um objeto ao registro.
     * 
     * @access public
     * @param string $item
     * @param string $name 
     * @return void
     */
    public static function reg_add(&$item, $name = null) {
        if (!self::reg_exists($name)):
            if (is_object($item) && is_null($name)) {
                $name = get_class($item);
            } elseif (is_null($name)) {
                $msg = "Você deve informar um nome para não-objetos";
                throw new Exception($msg);
            }
        endif;
        $name = strtolower($name);
        self::$_register[$name] = $item;
    }

    /**
     * Este método retorna um objeto adicionado ao registro previamente.
     * 
     * @access public
     * @param string $name
     * @return mixed 
     */
    public static function &reg_get($name) {
        if (self::reg_exists($name)):
            return self::$_register[$name];
        else:
            return false;
            exit($name . ' não foi encontrado no registro.');
        endif;
    }

    /**
     * Este método verifica se o objeto já existe no registro.
     * 
     * @access public
     * @param string $name
     * @return bool 
     */
    public static function reg_exists($name) {
        $name = strtolower($name);
        if (array_key_exists($name, self::$_register)) {
            return true;
        } else {
            return false;
        }
    }

}