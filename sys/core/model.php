<?php

if (!defined('BASE_PATH'))
    exit('Acesso negado!');

/**
 * Esta � a superclasse herdada por todos os models da aplica��o, ela herda
 * todas as funcionalidades da classe MJ_Datasource, trazendo o suporte ao
 * banco de dados configurado na aplica��o.
 *
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 * @since 26/12/2012
 */
class MJ_Model extends MJ_Datasource {

    function __construct() {
        parent::__construct();
    }

    /**
     * Nome ta tabela.
     * 
     * @access public
     * @var string 
     */
    public $table = '';
    /**
     * Chave prim�ria da tabela.
     * 
     * @access public
     * @var integer
     */
    public $key_field = '';
    /**
     * Este m�todo efetua a inclus�o de dados da tabela do banco de dados.
     * 
     * @access public 
     * @param array $dados Array com os dados na sequ�ncia da tabela.
     * @return bool
     */
    public function insert($dados){
        return $this->db->add($this->table, $dados);
    }
    /**
     * Este m�todo efetua a altera��o de algum registro na tabela do banco de dados.
     * 
     * @param array $dados - Array com os novos dados para a tabela.
     * @param integer $key - C�digo de refer�ncia do registro na tabela.
     * @return bool 
     */
    public function update($dados, $key){
        $this->db->where($this->key_field, $key);
        return $this->db->alt($this->table, $dados);
    }
    /**
     * Este m�todo efetua a exclus�o de um registro na tabela do banco de dados.
     * 
     * @access public
     * @param integer $key - C�digo de refer�ncia do registro na tabela.
     * @return bool 
     */
    public function delete($key){
        $this->db->where($this->key_field,$codAgenda);
        return $this->db->del($this->table);
    }
    /**
     * Este m�todo retorna um array com o resultado de uma busca na 
     * tabela do banco de dados.
     * 
     * @access public
     * @param string $fields - Campos a serem retornados, o padr�o � '*'
     * @param array $where - Array com as condi��es.
     * @param array $orderby - Array com as op��es de ordena��o.
     * @param array $limit - Array com as defini��es de limita��o.
     * @return array 
     */
    public function select($fields = '*', $where = '', $orderby = '', $limit = ''){
        // Trata os campos a serem retornados.
        if($fields == NULL):
            $fields = '*';
        endif;
        // Trata a cl�usula WHERE
        if($where):
            foreach($where as $key => $item):
                $this->db->where($key, $item);
            endforeach;
        endif;
        // Trata a cl�usula ORDERBY
        if($orderby):
            foreach($orderby as $key => $item):
                $this->db->orderby($key, $item);
            endforeach;
        endif;
        // Trata a cl�usula LIMIT
        if($limit):
            foreach($limit as $key => $item):
                $this->db->limit($key, $item);
            endforeach;
        endif;
        // Executa a busca
        $this->db->get($this->table, $fields);
        return $this->db;
    }
}