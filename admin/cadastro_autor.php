<?php
include("../includes/funcoes.php");
include("../includes/configuracao.php");
require_once('../smarty/libs/Smarty.class.php');

$smarty = new Smarty();
$smarty->template_dir = "../templates/admin/";
//$smarty->compile_dir = "templates_c/";

if(verificaLogin()){
	if ($_GET['action'] == "insert" or $_GET['action'] == "edit"){
		if (!$_GET['id']){
			$resposta = insereAutor($_GET['nome'], $_GET['sobrenome'], $_GET['observacoes']);
		 }else{
			$resposta = editaAutor($_GET['id'], $_GET['nome'], $_GET['sobrenome'], $_GET['observacoes']);
		}
		
		// Criando loop com mensagens de erro
		if ($resposta['erro']){
			$aviso .= "Dados inválidos! Por favor reveja sua informações...<br>\n";
			foreach($resposta['erro'] as $erro){
				$aviso .= $erro . "<br>\n";
			}
		}else{
			if ($_GET['action'] == "edit") header("Location: ../autor.php?id=" . $_GET['id']);
			$aviso = $resposta['sucesso'][0];
			$_GET = "";
		}
	}
}else{
	header("Location: index.php");
}

$autorizado = verificaLogin();
$action = ($_GET['id']) ? "edit": "insert";
$caption = ($_GET['id']) ? "Atualizar": "Gravar";

$tituloBanner = montaTitulo($_SERVER["SCRIPT_NAME"]);
$tituloSite = "GeracaoTec | " . $tituloBanner;

$smarty->assign('tituloSite',$tituloSite);
$smarty->assign('tituloBanner',$tituloBanner);
$smarty->assign('action',$action);
$smarty->assign('caption',$caption);
$smarty->assign('autorizado',$autorizado);
$smarty->assign('aviso',$aviso);
$smarty->display('cadastro_autor.tpl');
?>