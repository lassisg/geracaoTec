<?php
include("includes/funcoes.php");
include("includes/configuracao.php");
require('smarty/libs/Smarty.class.php');

$smarty = new Smarty();
//$smarty->template_dir = "templates/"
//$smarty->compile_dir = "templates_c/"

// Conecta com o DB
conectarDB();

// Primeira consulta = úlitmos lançamentos
$consultaLivro = mysql_query("SELECT id, nome FROM livro ORDER BY data_publicacao DESC LIMIT 5");

// Terceira consulta = Principais autores
$consultaAutor = mysql_query("SELECT DISTINCT a.id, a.l_name, a.f_name FROM autor a
														INNER JOIN livro_autor la ON la.id_autor = a.id
														INNER JOIN livro l ON la.id_livro = l.id
														ORDER BY n_exemplares DESC LIMIT 5");

while ($linha = mysql_fetch_assoc($consultaLivro)){ 
	$livros[] = $linha;
}

while ($linha = mysql_fetch_assoc($consultaAutor)){ 
	$autores[] = $linha;
}

$autorizado = verificaLogin();

$tituloBanner = montaTitulo($_SERVER["SCRIPT_NAME"]);
$tituloSite = "GeracaoTec | " . $tituloBanner;

$smarty->assign('tituloSite',$tituloSite);
$smarty->assign('tituloBanner',$tituloBanner);
$smarty->assign('autorizado',$autorizado);
$smarty->assign('livros',$livros);
$smarty->assign('autores',$autores);
$smarty->display('index.tpl');
?>