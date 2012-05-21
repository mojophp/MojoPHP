<?php

if (!defined('BASE_PATH'))exit('Acesso negado!');

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
    private static $registro = array();
    
    /**
     * Este m�todo adiciona um objeto ao registro.
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
                $msg = "Voc� deve informar um nome para n�o-objetos";
                throw new Exception($msg);
            endif;
        endif;
    }

    /**
     * Este m�todo retorna um objeto adicionado ao registro previamente.
     * 
     * @access public
     * @param string $alias Apelido ou nome registrado
     * @return mixed 
     */
    public static function &reg_get($alias) {
        if(self::reg_exists($alias)):
            return self::$registro[$alias];
        else:
            exit('ERRO 3 - Objeto '.$alias . ' n�o foi encontrado no registro.');
        endif;
    }

    /**
     * Este m�todo verifica se o objeto j� existe no registro.
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