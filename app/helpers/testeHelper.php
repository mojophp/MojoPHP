<?php

if ( ! defined('BASE_PATH')) exit('Acesso negado!');

/**
 * Este é um arquivo de exemplo de helper. Os helpers são bibliotecas de
 * funções, nunca classes. Não podem ser classes pois o MJ_Loader não
 * instancia nenhum objeto quando a carrega, somente inclui.
 * 
 * Este sistema de helpers foi inspirado no CodeIgniter, desta forma fica
 * muito fácil de usar algum helper que você já tenha em uso.
 * 
 * Exemplo:
 * 
 * Esperimente carregar este helper em um controller usando:
 * 
 * $this->load->helper('teste');
 * 
 * Em seguida é só chamar a função no código:
 * 
 * echo ola_mundo();
 * 
 * Agora é só escreve seus helpers!
 * 
 */

function ola_mundo(){
    
    return '<p>Olá mundo!</p>';
    
}

function jeronimo(){
    
    $Instancia = getInstance('usuarios');
    
}