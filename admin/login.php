<?php
	include("../includes/funcoes.php");
	require_once('../smarty/libs/Smarty.class.php');
	session_start();
	
	//Validando login
	if ($_GET['login'] && $_GET['senha']){
		$_SESSION['logado'] = verificaLogin($_GET['login'],$_GET['senha']);
	}else{
		session_destroy();
	}
	
	header('location:../index.php');
?>