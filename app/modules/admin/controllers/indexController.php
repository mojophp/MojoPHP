<?php

if ( ! defined('BASE_PATH')) exit('Acesso negado!');

/**
 * Este é o controller inicial preparado para dar a saudação para o 
 * desenvolvedor e também para fazer alguns testes.
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
     * Este é o método index(), ele é obrigatório no controlador inicial.
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