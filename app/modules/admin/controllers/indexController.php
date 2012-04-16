<?php

if ( ! defined('BASE_PATH')) exit('Acesso negado!');

/**
 * Este � o controller inicial preparado para dar a sauda��o para o 
 * desenvolvedor e tamb�m para fazer alguns testes.
 * 
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 * @since 26/02/2012
 */

class indexController extends MJ_Controller {
    
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Este � o m�todo index(), ele � obrigat�rio no controlador inicial.
     */
    public function index(){
        $this->loadHelper('url');
        $this->loadView('welcome',null);
    }

    public function autor($var = null){
		$this->loadModel('usuarios');
		echo $this->load('usuarios')->get_autor($var);
	}
    
    public function teste(){
        die('eh soh um teste');
        
    }
}