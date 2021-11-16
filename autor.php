<?php
include("includes/funcoes.php");
include("includes/configuracao.php");
require_once('smarty/libs/Smarty.class.php');

$smarty = new Smarty();
//$smarty->template_dir = "templates/";
//$smarty->compile_dir = "templates_c/";

if($_GET['delete'] and verificaLogin()){
	apagaAutor($_GET['delete']);
}

// Realiza a consulta
if (!$_GET['pg']) $_GET['pg'] = 1;
if($_GET['id']){
	$consultaAutor = localiza($_GET['id'], "id", "autor", $_GET['pg']);
}elseif($_GET['nome']){
	$consultaAutor = localiza($_GET['nome'], "", "autor", $_GET['pg']);
}else{
	$consultaAutor = localiza("", "", "autor", $_GET['pg']);
}

// Monta navegação por páginas
$paginas = contaPaginas($_GET['nome'], "paginas", "autor");
if ($paginas>1 && $_GET['pg'] != 1) $nav .= "<a href='autor.php?pg=".($_GET['pg']-1)."&nome=".$_GET['nome']."'><span style='padding-left: 7px; padding-right: 7px;'><</span></a>|";
for ($i=1; $i<=$paginas; $i++){
	$nav .= "<a href='autor.php?pg=".$i."&nome=".$_GET['nome']."'><span style='padding-left: 7px; padding-right: 7px;'>".$i."</span></a>";
	if ($i<$paginas) $nav.= "|";
}
if ($paginas>1 && $_GET['pg'] != $paginas) $nav .= "|<a href='autor.php?pg=".($_GET['pg']+1)."&nome=".$_GET['nome']."'><span style='padding-left: 7px; padding-right: 7px;'>></span></a>";



// Monta lista de autores
while ($linha = mysql_fetch_assoc($consultaAutor)){
	$livrosAutor="";
	$consultaLivro = localiza($linha['id'], "id_autor", "livro");
	while ($livros = mysql_fetch_assoc($consultaLivro)){
		$livrosAutor[] = array('id'=>$livros['id'],'nome'=>$livros['nome']);
	}
	$autores[] = array('id'=>$linha['id'],'l_name'=>$linha['l_name'],'f_name'=>$linha['f_name'],'observacoes'=>$linha['observacoes'],'livros'=>$livrosAutor);
}

$autorizado = verificaLogin();

$tituloBanner = montaTitulo($_SERVER["SCRIPT_NAME"], $_GET['id']);
$tituloSite = "GeracaoTec | " . $tituloBanner;

$smarty->assign('tituloSite',$tituloSite);
$smarty->assign('tituloBanner',$tituloBanner);
$smarty->assign('nav',$nav);
$smarty->assign('autores',$autores);
$smarty->assign('autorizado',$autorizado);
$smarty->display('autor.tpl');
?>