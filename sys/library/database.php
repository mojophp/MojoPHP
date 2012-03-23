<?php


/*
 * Database tem que ter as op��es de trabalho para serem usadas no Model de forma
 * parecida com o CI.
 * 
 * COMANDOS B�SICOS NECESS�RIOS
 * ----------------------------
 * query() -> executa uma query
 * get(tabela) -> executa um select * from tabela
 * insert(tabela,array) -> Executa um insert into tabela values(array)
 * update(tabela,array(campo=>valor)) -> Executa um update tabela set array(campo = valor)
 * delete(tabela,id) -> Executa um delete from tabela where id = x
 * 
 */

class database {
    /**
     * Inst�ncia da classe PDO.
     * @var mixed 
     */
    private $pdo;
    /**
     * Statement da execuss�o da classe PDO.
     * @var statement 
     */
    private $statement;
    /**
     * Par�metros para a cl�usula WHERE das consultas SQL.
     * @var array 
     */
    private $where;
    /**
     * Par�metros para a cl�usula ORDERBY das consultas SQL.
     * @var array 
     */
    private $orderby;
    /**
     * Par�metros para a cl�usula LIMIT das consultas SQL.
     * @var array 
     */
    private $limit;
    /**
     * Valores para serem usados nas instru��es SQL do tipo "insert"
     * @var array 
     */
    private $value_add;
    /**
     * Valores para serem usados nas instru��es SQL do tipo "update"
     * @var array 
     */
    private $value_alt;
    
    /**
     * Constr�i a classe e configura o DSN.
     */
    function __construct() {
        $this->connect();
    }
    /**
     * Efetua a conex�o com o banco de dados usando PDO.
     * 
     * @access private
     * @return void
     */
    private function connect(){
        
        $conf = Config::read('database');
        $conf = $conf[ENVIROMENT];
        
        $dsn = $conf['driver'].':host='.$conf['host'].';dbname='.$conf['database'];
        $this->pdo = new PDO($dsn, $conf['user'], $conf['password']);
        
    }
    /**
     * Este m�todo executa uma instru��o SQL com query() ou exec().
     * 
     * @access private
     * @param string $sql Instru��o SQL a ser executada.
     * @param bool $exec Executa com Exec() ou n�o, padr�o FALSE.
     * @param bool $debug Imprime a instru��o SQL para resolver problemas.
     * @return mixed 
     */
    private function executa($sql, $exec = false, $debug = false){
        if($debug)echo '<p>'.$sql.'</p>';
        if($exec):
            return $this->pdo->exec($sql);
        else:
            $this->statement = $this->pdo->query($sql);
        endif;
    }
    /**
     * Este m�todo monta uma instru��o SQL para ser executada.
     * 
     * @access private
     * @param string $tipo Tipo de instru��o (select, insert, update e delete).
     * @param string $tabela Tabela a ser consultada.
     * @param string $campos Lista de campos para a consulta do tipo "select".
     * @return string 
     */
    private function set_sql($tipo = 'select', $tabela, $campos = '*'){
        if(!$tabela)
            exit ("Voc� precisa informar a tabela para poder criar a instru��o SQL.");
        $out_sql = '';
        switch ($tipo):
            case 'select':
                $out_sql = 'SELECT ' . $campos . ' FROM ' . $tabela . $this->get_where() . $this->get_orderby() . $this->get_limit();
                break;
            case 'insert':
                $out_sql = 'INSERT INTO ' . $tabela . ' VALUES(' . $this->get_values_insert() . ')';
                break;
            case 'update':
                $out_sql = 'UPDATE ' . $tabela . ' SET ' . $this->get_values_update() . ' ' . $this->get_where();
                break;
            case 'delete':
                $out_sql = 'DELETE FROM ' . $tabela . $this->get_where();
                break;
        endswitch;
        return $out_sql;
    }
    /**
     * Este m�todo armazena os par�metros WHERE para ser usado na instru��o SQL.
     * 
     * @access public
     * @param string $campo
     * @param string $valor
     * @param string $operador 
     * @return void
     */
    public function where($campo, $valor, $operador = '='){
        if($this->where):
            $this->where .= ' AND ' . $campo . ' ' .$operador . ' \'' . $valor . '\'';
        else:
            $this->where =  $campo . ' ' . $operador . ' \'' . $valor . '\'';
        endif;
    }
    /**
     * Este m�todo armazena os par�metros WHERE para ser usado na instru��o SQL
     * usando o operador LIKE.
     * 
     * @access public
     * @param string $campo
     * @param string $valor 
     * @return void
     */
    public function like($campo, $valor){
        if($this->where):
            $this->where .= ' AND ' . $campo . ' LIKE \'%' . $valor . '%\'';
        else:
            $this->where =  $campo . ' LIKE \'%' . $valor . '%\'';
        endif;
    }
    /**
     * Este m�todo retorna a vari�vel where pronta para ser usada na instru��o SQL.
     * 
     * @access private
     * @return string 
     */
    private function get_where (){
        if($this->where)
            return ' WHERE ' . $this->where;
    }
    /**
     * Este m�todo armazena os par�metros orderby para ser usado na instru��o SQL.
     * 
     * @access public
     * @param string $campo
     * @param string $operador 
     * @return void
     */
    public function orderby($campo, $operador = 'ASC'){
        $this->orderby = $campo . ' ' . $operador;
    }
    /**
     * Este m�todo retorna a vari�vel oderby pronta para ser usada na instru��o SQL.
     * 
     * @access private
     * @return string 
     */
    private function get_orderby(){
        if($this->orderby)
            return ' ORDER BY ' . $this->orderby;
    }
    /**
     * Este m�todo armazena os par�metros de limit para ser usada na instru��o SQL.
     * 
     * @access public
     * @param integer $inicio
     * @param integer $fim 
     * @return void
     */
    public function limit($inicio, $fim){
        $this->limit = $inicio . ',' . $fim;
    }
    /**
     * Este m�todo retorna a vari�vel limit pronta para ser usada na instru��o SQL.
     * 
     * @access private
     * @return string 
     */
    private function get_limit(){
        if($this->limit)
            return ' LIMIT ' . $this->limit;
    }
    /**
     * Este m�todo retorna de forma concatenada os valores para serem usados
     * na instru��o SQL do tipo "insert".
     * 
     * @access private
     * @return string 
     */
    private function get_values_insert(){
        $saida = '';
        $total = count($this->value_add);
        $atual = 1;
        foreach($this->value_add as $item):
            if($atual >= $total):
                $saida .= '\''.$item.'\'';
            else:
                $saida .= '\''.$item . '\', ';
                $atual = $atual +1;
            endif;
        endforeach;
        return $saida;
    }
    /**
     * Este m�todo retorna de forma concatenada os valores para serem usados
     * na instru��o SQL do tipo "update".
     * 
     * @access private
     * @return string 
     */
    private function get_values_update(){
        $saida = '';
        $total = count($this->value_alt);
        $atual = 1;
        foreach($this->value_alt as $key =>$item):
            if($atual >= $total):
                $saida .= $key . ' = \'' . $item.'\'';
            else:
                $saida .= $key . ' = \'' . $item . '\', ';
                $atual = $atual +1;
            endif;
        endforeach;
        return $saida;
    }
    /**
     * Efetua uma consulta do tipo select ba tabela espec�ficada nos par�metros.
     * Este m�todo trabalha em conjunto com os outros m�todos where() orderby() e limit().
     * 
     * @access public
     * @param string $tabela Tabela a ser consultada.
     * @param string $campos Campos a serem retornados (campo1, campo2, campo3...).
     */
    public function get($tabela, $campos = '*'){
        $sql = $this->set_sql('select', $tabela, $campos);
        $this->executa($sql);
    }
    /**
     * Este m�todo efetua o cadastro de novos registro na tabela especificada do 
     * banco de dados.
     * 
     * @access public
     * @param string $tabela Nome da tabela que receber� os dados.
     * @param array $valores Array com os valores, array('valor1', 'valor2', 'valor3').
     * @return integer Total de linhas afetadas. 
     */
    public function add($tabela, $valores){
        $this->value_add = $valores;
        $sql = $this->set_sql('insert', $tabela);
        return $this->executa($sql, true);
    }
    /**
     * Este m�todo efetua a atualiza��o de um registro na tabela especificada.
     * O registro a ser alterado deve ser definido usando o m�todo where().
     * 
     * @access public
     * @param string $tabela Tabela que receber� a atualiza��o.
     * @param array $valores Array com os campos e valores: array('campo'=>'valor').
     * @return integer Total de linhas afetadas. 
     */
    public function alt($tabela, $valores){
        $this->value_alt = $valores;
        $sql = $this->set_sql('update', $tabela);
        return $this->executa($sql, true);
    }
    /**
     * Este m�todo efetua a exclus�o de um registro definido com o
     * m�todo where().
     * 
     * @access public
     * @param string $tabela
     * @return integer 
     */
    public function del($tabela){
        $sql = $this->set_sql('delete', $tabela);
        return $this->pdo->exec($sql);
    }
    /**
     * Este m�todo executa uma query diretamente.
     * 
     * @access public
     * @param string $sql Instru��o SQL desejada.
     */
    public function query($sql){
        $this->statement = $this->pdo->query($sql);
    }
    /**
     * Retorna um array com os resultados de uma consulta. Ideal
     * para ser usado em la�os com foreach().
     * 
     * @access public
     * @return mixed 
     */
    public function result(){
        return $this->statement->fetchAll( PDO::FETCH_OBJ );
    }
    /**
     * Retorna os resultados de uma �nica linha do registro.
     * 
     * @access public
     * @return mixed 
     */
    public function row(){
        return $this->statement->fetch( PDO::FETCH_OBJ );
    }
    /**
     * Este m�todo retorna o total de linhas afetadas com a execuss�o 
     * de uma instru��o SQL.
     * 
     * @access public
     * @return integer 
     */
    public function num_rows(){
        return $this->statement->rowCount();
    }
    
}