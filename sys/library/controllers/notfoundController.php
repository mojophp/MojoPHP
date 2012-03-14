<?php

if ( ! defined('BASE_PATH')) exit('Acesso negado!');

class notfoundController extends MJ_Controller {
    
    public function index(){
        
        $data['error_message'] = 'A classe solicitada não foi encontrada. Entre em contato com o administrador.';
        
        $this->loadView('error',$data);
        
    }
    
}