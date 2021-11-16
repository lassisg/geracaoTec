<?php
include("includes/funcoes.php");
include("includes/configuracao.php");
require_once('smarty/libs/Smarty.class.php');

$smarty = new Smarty();
//$smarty->template_dir = "templates/";
//$smarty->compile_dir = "templates_c/";

if($_GET['delete'] and verificaLogin()) apagaLivro($_GET['delete']);
if($_GET['noimg'] and verificaLogin()) {
	apagaImagem($_GET['noimg']);
	header('Location: livro.php?id='.$_GET['id']);
}

// Realiza a consulta
if($_GET['id']) $consultaLivro = localiza($_GET['id'], "id", "livro");
	else $consultaLivro = localiza("", "id", "livro");

$livro = mysql_fetch_assoc($consultaLivro);
$livro['data_publicacao'] = translateData($livro['data_publicacao']);			// Traduz a data para um formato mais adequado à publicação

$consultaAutor = localiza($livro['id'], "id_livro", "autor");
while ($autor = mysql_fetch_assoc($consultaAutor)){
	$autores[] = array('id'=>$autor['id'],'l_name'=>$autor['l_name'],'f_name'=>$autor['f_name']);
}

$autorizado = verificaLogin();
$foto = "l" . $livro['id'] . "." . $livro['imgext'];
$imagem = (!$livro['imgext']) ? IMG_DIR."book.png" : FOTOS_DIR . $foto;

$tituloBanner = montaTitulo($_SERVER["SCRIPT_NAME"]);
$tituloSite = "GeracaoTec | " . $tituloBanner;

$smarty->assign('tituloSite',$tituloSite);
$smarty->assign('tituloBanner',$tituloBanner);
$smarty->assign('autorizado',$autorizado);
$smarty->assign('livro',$livro);
$smarty->assign('foto',$foto);
$smarty->assign('imagem',$imagem);
$smarty->assign('autores',$autores);
$smarty->display('livro.tpl');
?>