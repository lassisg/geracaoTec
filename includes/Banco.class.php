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
		// Cria a conexão com o Banco de dados
		$con = mysql_connect($this->server,$this->user,$this->pass);
		return $con;
		
		// Informa qual banco de dados será utilizado
		$db_selected = mysql_select_db('biblioteca',$link);
		if(!$db_selected){
			die('Não foi possível selecionar o banco biblioteca: ' . mysql_error());
			mysql_close(); // Fechar a conexão
		}
		
		return true;
		
	}
	 
	function query(){
		$qry = mysql_query($this->sql));
		return $qry;
	}
}
?>