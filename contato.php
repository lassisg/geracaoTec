<?php
include("includes/funcoes.php");
include("includes/configuracao.php");
require_once('smarty/libs/Smarty.class.php');
require_once('includes/Contato.class.php');

$smarty = new Smarty();
//$smarty->template_dir = "templates/"
//$smarty->compile_dir = "templates_c/"

if($_GET){
	$contato = new Contato();
	/*
	if (validaNome($_GET['nome'])) $contato->set("nome", $_GET['nome']);
	if (validaEmail($_GET['email'])) $contato->set("email", $_GET['email']);
	if (validaTelefone($_GET['telefone'])) $contato->set("telefone", $_GET['telefone']);
	if (validaMensagem($_GET['mensagem'])) $contato->set("mensagem", $_GET['mensagem']);
	*/
	
	$contato->set("nome", $_GET['nome']);
	$contato->set("email", $_GET['email']);
	$contato->set("telefone", $_GET['telefone']);
	$contato->set("mensagem", $_GET['mensagem']);
	$resposta = $contato->inserirContato();
	
	// Criando loop com mensagens de erro
	if ($resposta['erro']){
		$aviso .= "Dados inválidos! Por favor reveja sua informações...<br>\n";
		foreach($resposta['erro'] as $erro){
			$aviso .= $erro . "<br>\n";
		}
	}else{
		$aviso = $resposta['sucesso'];
		$_GET = "";
	}
}

$autorizado = verificaLogin();

$tituloBanner = montaTitulo($_SERVER["SCRIPT_NAME"]);
$tituloSite = "GeracaoTec | " . $tituloBanner;

$smarty->assign('tituloSite',$tituloSite);
$smarty->assign('tituloBanner',$tituloBanner);
$smarty->assign('autorizado',$autorizado);
$smarty->assign('aviso',$aviso);
$smarty->display('contato.tpl');
?>