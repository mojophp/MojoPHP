<?php

if ( ! defined('BASE_PATH')) exit('Acesso negado!');

class notfoundController extends MJ_Controller {
    
    public function index(){
        
        $data['error_message'] = 'A classe solicitada n�o foi encontrada. Entre em contato com o administrador.';
        
        $this->loadView('error',$data);
        
    }
    
}