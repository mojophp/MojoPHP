<?php

if ( ! defined('BASE_PATH')) exit('Acesso negado!');

/**
 * Este � um arquivo de exemplo de helper. Os helpers s�o bibliotecas de
 * fun��es, nunca classes. N�o podem ser classes pois o MJ_Loader n�o
 * instancia nenhum objeto quando a carrega, somente inclui.
 * 
 * Este sistema de helpers foi inspirado no CodeIgniter, desta forma fica
 * muito f�cil de usar algum helper que voc� j� tenha em uso.
 * 
 * Exemplo:
 * 
 * Esperimente carregar este helper em um controller usando:
 * 
 * $this->load->helper('teste');
 * 
 * Em seguida � s� chamar a fun��o no c�digo:
 * 
 * echo ola_mundo();
 * 
 * Agora � s� escreve seus helpers!
 * 
 */

function ola_mundo(){
    
    return '<p>Ol� mundo!</p>';
    
}

function jeronimo(){
    
    $Instancia = getInstance('usuarios');
    
}