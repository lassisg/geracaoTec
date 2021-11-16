<?php
include("../includes/funcoes.php");
include("../includes/configuracao.php");
require_once('../smarty/libs/Smarty.class.php');

$smarty = new Smarty();
$smarty->template_dir = "../templates/admin/";
//$smarty->compile_dir = "templates_c/";

$autorizado = verificaLogin();

$tituloBanner = montaTitulo($_SERVER["SCRIPT_NAME"]);
$tituloSite = "GeracaoTec | " . $tituloBanner;

$smarty->assign('tituloSite',$tituloSite);
$smarty->assign('tituloBanner',$tituloBanner);
$smarty->assign('autorizado',$autorizado);
$smarty->display('index.tpl');
?>