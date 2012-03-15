<?php

/**
 * Este arquivo não é essencial para o funcionamento do Mojo*PHP, foi inserido
 * apenas para consulta com exemplos de utilização do driver do MySql.
 * 
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License.
 * @copyright Copyright 2012, Mojo*PHP (http://mojophp.net/).
 * @package Mojo*PHP
 * @author Eliel de Paula <elieldepaula@gmail.com>
 */

//DELETE EXAMPLE
$this->db->table('page');
$this->db->where('pid=28');
$this->db->delete(); // <-- run() foi substituï¿½do pelos nomes das classes.

$this->db->status(); //function to display sql feedback (the var $sql->status is also set to TRUE/FALSE)

//INSERT EXAMPLE
$this->db->table('page');
$this->db->values("NULL,'string','string','string','string',1,'string','string','string'");
$this->db->insert();

echo $this->db->insertid;
$this->db->status(); //function to display sql feedback (the var $sql->status is also set to TRUE/FALSE)

//SELECT EXAMPLE 1 - as mysql_num_rows equals 1 all db vars are returned automatically - no need for foreach() loop
$this->db->table('page');
$this->db->where("pname='index'");
$this->db->set('pname=name');
$this->db->select();

echo $this->db->pid; //$sql->VARNAME is column name in db
echo $this->db->name; //$sql->VARNAME is variable specified in $sql->set();


//SELECT EXAMPLE 2 - as we are selecting multi rows the foreach() loop is needed along with get() to cycle through all data
$this->db->fields('pid=id,pname=name'); //sets pid column to var id | pname column to var name
$this->db->fields('pdesc'); //as no variable specified var will remain as column name
$this->db->table('page');
$this->db->where("pid>0");
$this->db->where("pid<1000 AND pid!=999");
$this->db->order("pid ASC");
$this->db->limit("0,10");
$this->db->select();
$this->db->debug(0); 

$this->db->numrows; //returns total rows

foreach($this->db->result as $row){

	$this->db->get($row);

	echo $this->db->name;
	echo "<br/>";
}

//STRING EXAMPLE - query is set by a string so more complex queries can be executed (left joins). Other properties as the same as "select".
$this->db->query('select * from page');
$this->db->set('pname=name');
$this->db->string();

echo $this->db->numrows; //returns total rows

foreach($this->db->result as $row){

	$this->db->get($row);

	echo $this->db->name;
	echo "<br/>";
}


//UPDATE EXAMPLE
$this->db->table('page');
$this->db->values("pname='aaaaa',pdesc='bbbbb'");
$this->db->where('pid=27');
$this->db->update();

$this->db->status(); //function to display sql feedback (the var $sql->status is also set to TRUE/FALSE)