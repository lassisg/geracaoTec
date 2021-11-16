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
			$resposta = insereEditora($_GET['nome']);
		}else{
			$resposta = editaEditora($_GET['id'], $_GET['nome']);
		}
		
		// Criando loop com mensagens de erro
		if ($resposta['erro']){
			$aviso .= "Dados inválidos! Por favor reveja sua informações...<br>\n";
			foreach($resposta['erro'] as $erro){
				$aviso .= $erro . "<br>\n";
			}
		}elseif($_GET['action'] == "insert" or $_GET['action'] == "edit"){
			$aviso = $resposta['sucesso'][0];
			$_GET = "";
		}
	}
}else{
	header("Location: index.php");
}

$autorizado = verificaLogin();
$caption = ($_GET['id']) ? "Atualizar": "Gravar";

$tituloBanner = montaTitulo($_SERVER["SCRIPT_NAME"]);
$tituloSite = "GeracaoTec | " . $tituloBanner;

$smarty->assign('tituloSite',$tituloSite);
$smarty->assign('tituloBanner',$tituloBanner);
$smarty->assign('autorizado',$autorizado);
$smarty->assign('caption',$caption);
$smarty->assign('aviso',$aviso);
$smarty->display('cadastro_editora.tpl');
?>