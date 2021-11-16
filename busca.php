<?php
include("includes/funcoes.php");
include("includes/configuracao.php");
require_once('smarty/libs/Smarty.class.php');

$smarty = new Smarty();
//$smarty->template_dir = "templates/";
//$smarty->compile_dir = "templates_c/";

if($_GET['delete'] and verificaLogin()){
	apagaLivro($_GET['delete']);
}

// Realiza a consulta
if (!$_GET['pg']) $_GET['pg'] = 1;
$consultaLivro = localiza($_GET['nome_livro'], "", "livro", $_GET['pg']);

// Monta navegação por páginas
$paginas = contaPaginas($_GET['nome_livro'], "paginas", "livro");
if ($paginas>1 && $_GET['pg'] != 1) $nav .= "<a href='busca.php?pg=".($_GET['pg']-1)."&nome_livro=".$_GET['nome_livro']."'><span style='padding-left: 7px; padding-right: 7px;'><</span></a>|";
for ($i=1; $i<=$paginas; $i++){
	$nav .= "<a href='busca.php?pg=".$i."&nome_livro=".$_GET['nome_livro']."'><span style='padding-left: 7px; padding-right: 7px;'>".$i."</span></a>";
	if ($i<$paginas) $nav.= "|";
}
if ($paginas>1 && $_GET['pg'] != $paginas) $nav .= "|<a href='busca.php?pg=".($_GET['pg']+1)."&nome_livro=".$_GET['nome_livro']."'><span style='padding-left: 7px; padding-right: 7px;'>></span></a>";

// Monta lista de autores
while ($linha = mysql_fetch_assoc($consultaLivro)){
	$autoresLivro="";
	$autoresEdicao="";
	$consultaAutor = localiza($linha['id'], "id_livro", "autor");
	while ($autores = mysql_fetch_assoc($consultaAutor)){
		$autoresLivro[] = array('id'=>$autores['id'], 'l_name'=>$autores['l_name'], 'f_name'=>$autores['f_name']);
		$autoresEdicao .= "&idAutor[]=".$autores['id'];
	}
	$data_publicacao = translateData($linha['data_publicacao']);
	$livros[] = array('id'=>$linha['id'], 'nome'=>$linha['nome'], 'autores'=>$autoresLivro, 'id_editora'=>$linha['id_editora'], 'editora'=>$linha['editora'],'edicao'=>$linha['edicao'], 'data_publicacao'=>$data_publicacao, 'isbn'=>$linha['isbn'], 'n_exemplares'=>$linha['n_exemplares'], 'localizacao'=>$linha['localizacao'], 'resenha'=>$linha['resenha'],'autoresEdicao'=>$autoresEdicao);
}

$autorizado = verificaLogin();

$tituloBanner = montaTitulo($_SERVER["SCRIPT_NAME"],$_GET['nome_livro']);
$tituloSite = "GeracaoTec | " . $tituloBanner;

$smarty->assign('tituloSite',$tituloSite);
$smarty->assign('tituloBanner',$tituloBanner);
$smarty->assign('tituloSite',$tituloSite);
$smarty->assign('nav',$nav);
$smarty->assign('livros',$livros);
$smarty->assign('autorizado',$autorizado);
$smarty->display('busca.tpl');
?>