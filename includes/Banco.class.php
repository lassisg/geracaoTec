<?php
class Banco{
	private $server;
	private $user;
	private $pass;
	private $dbName;
	private $sql;

	public function __construct() {
	$this->server = 'localhost';
	$this->user = 'root';
	$this->pass = '';
	$this->dbName = 'biblioteca';
	}
	
	function set($prop, $val){
		$this->$prop = $val;
	}
   
	function get($prop){
		return $this->$prop;
	}
	
	function conectarDB(){
		// Cria a conex�o com o Banco de dados
		$con = mysql_connect($this->server,$this->user,$this->pass);
		return $con;
		
		// Informa qual banco de dados ser� utilizado
		$db_selected = mysql_select_db('biblioteca',$link);
		if(!$db_selected){
			die('N�o foi poss�vel selecionar o banco biblioteca: ' . mysql_error());
			mysql_close(); // Fechar a conex�o
		}
		
		return true;
		
	}
	 
	function query(){
		$qry = mysql_query($this->sql));
		return $qry;
	}
}
?>