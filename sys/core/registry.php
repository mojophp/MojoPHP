<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Esta � a classe de registro do Mojo*PHP, ela � responsavel por
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
     * Esta � a vari�vel de registro, cont�m um array com todos os objetos
     * instanciados pela classe.
     * 
     * @var array 
     */
    private static $_register = array();

    /**
     * Este m�todo adiciona um objeto ao registro.
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
                $msg = "Voc� deve informar um nome para n�o-objetos";
                throw new Exception($msg);
            }
        endif;
        $name = strtolower($name);
        self::$_register[$name] = $item;
    }

    /**
     * Este m�todo retorna um objeto adicionado ao registro previamente.
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
            exit($name . ' n�o foi encontrado no registro.');
        endif;
    }

    /**
     * Este m�todo verifica se o objeto j� existe no registro.
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