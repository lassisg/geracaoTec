<?php
include("includes/funcoes.php");
include("includes/configuracao.php");
require_once('smarty/libs/Smarty.class.php');

$smarty = new Smarty();
//$smarty->template_dir = "templates/";

if (strlen($_POST['data_publicacao']) >= 8){
	$aviso .= "MAIOR QUE 8<br>";
	$data = explode("/",$_POST['data_publicacao']);
	$dia = intval($data[0]);
	$mes = intval($data[1]);
	$ano = intval($data[2]);
}else{
	$dia = 1;
	$mes = 1;
	$ano = intval($valor);
}
$aviso .= "DIA: ".$dia."<br>MES: ".$mes."<br>ANO: ".$ano."<br>".checkdate($mes,$dia,$ano);

//$aviso .= checkdate($mes,$dia,$ano);
/*
$data = ajustaData($_POST['data_publicacao']);
$data = explode("-",$data);
$dia = intval($data[0]);
$mes = intval($data[1]);
$ano = intval($data[2]);

$aviso .= checkdate($mes,$dia,$ano);
if(validaData($_POST['data_publicacao'])){
	$aviso = "VÁLIDO";
}else{
	$aviso = "INVÁLIDO";
}
*/
$autorizado = verificaLogin();

$tituloBanner = montaTitulo($_SERVER["SCRIPT_NAME"]);
$tituloSite = "GeracaoTec | " . $tituloBanner;

$smarty->assign('tituloSite',$tituloSite);
$smarty->assign('tituloBanner',$tituloBanner);
$smarty->assign('autorizado',$autorizado);
$smarty->assign('aviso',$aviso);
$smarty->display('teste.tpl');
?>