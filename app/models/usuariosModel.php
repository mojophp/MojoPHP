<?php

if (!defined('BASE_PATH')) exit('Acesso negado!');

/**
 * Este é um model de testes criado para testes durante o desenvolvimento das
 * bibliotecas da camada de dados.
 * 
 * @package Mojo*PHP
 */
class usuarios extends MJ_Model {

    function __construct() {

        parent::__construct();
    }

    public function get_lista_usuarios() {

        $saida = null;

        $q = $this->db;
        $q->table('tbUsuarios');
        $q->select();

        foreach ($q->rows as $row) {

            $q->get($row);

            $saida .= $q->usNome;
            $saida .= '<br/>';
        }

        $saida .= '<p><b>Total de usuários</b> ' . $q->numrows . '</p>';

        return $saida;
    }
    
    public function testando(){
        return 'Funcionou!';
    }

}
