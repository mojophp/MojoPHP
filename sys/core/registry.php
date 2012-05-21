<?php

if (!defined('BASE_PATH'))exit('Acesso negado!');

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
    private static $registro = array();
    
    /**
     * Este método adiciona um objeto ao registro.
     * 
     * @access public
     * @param string $objeto Objeto a ser registrado (Classe instanciada)
     * @param string $alias Apelido para o objeto (Opcional)
     * @return void
     */
    public static function reg_add(&$objeto, $alias = null) {
        if (!self::reg_exists($alias)):
            if (is_object($objeto) && !is_null($alias)):
                self::$registro[$alias] = $objeto;
            elseif (is_null($alias)):
                $msg = "Você deve informar um nome para não-objetos";
                throw new Exception($msg);
            endif;
        endif;
    }

    /**
     * Este método retorna um objeto adicionado ao registro previamente.
     * 
     * @access public
     * @param string $alias Apelido ou nome registrado
     * @return mixed 
     */
    public static function &reg_get($alias) {
        if(self::reg_exists($alias)):
            return self::$registro[$alias];
        else:
            exit('ERRO 3 - Objeto '.$alias . ' não foi encontrado no registro.');
        endif;
    }

    /**
     * Este método verifica se o objeto já existe no registro.
     * 
     * @access public
     * @param string $alias Apelido ou nome registrado.
     * @return bool 
     */
    public static function reg_exists($alias) {
        $alias = strtolower($alias);
        if(array_key_exists($alias, self::$registro)):
            return true;
        else:
            return false;
        endif;
    }

}