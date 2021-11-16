<?php
include("../includes/funcoes.php");
include("../includes/configuracao.php");
require_once('../smarty/libs/Smarty.class.php');
require_once('../includes/Contato.class.php');

$smarty = new Smarty();
$smarty->template_dir = "../templates/admin/";
//$smarty->compile_dir = "templates_c/";

// Recupera contatos recebidos
$autorizado = verificaLogin();
if($autorizado){
	if($_GET['delete']){
		apagaContato($_GET['delete']);
	}
	$listaContatos = new Contato();
	$contatos = $listaContatos->listarContatos();
}

$tituloBanner = montaTitulo($_SERVER["SCRIPT_NAME"]);
$tituloSite = "GeracaoTec | " . $tituloBanner;

$smarty->assign('tituloSite',$tituloSite);
$smarty->assign('tituloBanner',$tituloBanner);
$smarty->assign('contatos',$contatos);
$smarty->assign('autorizado',$autorizado);
$smarty->display('contatos.tpl');
?>