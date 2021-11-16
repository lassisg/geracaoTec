<?php
include("../includes/funcoes.php");
include("../includes/configuracao.php");
require_once('../smarty/libs/Smarty.class.php');

$smarty = new Smarty();
$smarty->template_dir = "../templates/admin/";
//$smarty->compile_dir = "templates_c/";

// Montando a lista de autores
conectarDB();																												// Conecta com o Banco de dados

if(verificaLogin()){
	if ($_POST['action'] == "insert" || $_POST['action'] == "edit"){
		if($_FILES['imagem']['name']){
			// Esta função só retorna valor quando realmente é imagem, garantindo que outros tipos de arquivos não sejam 'upados'
			if(getimagesize($_FILES['imagem']['tmp_name'])){
				$fileType = $_FILES['imagem']['type'];											// Exemplo: image/jpeg
				$fileType = explode("/",$fileType);
				$ext = $fileType[1];
			}else{
				$resposta['erro'][] = "Formato de arquivo inválido (" . $_FILES['imagem']['type'] . ")! Apenas arquivos de imagem são aceitos!";
			}
		}
		
		if ($_POST['action'] == "edit"){
			$resposta = editaLivro($_POST['id'], $_POST['nome'], $_POST['editora'], $_POST['data_publicacao'], $_POST['localizacao'],
															$_POST['resenha'], $_POST['edicao'], $_POST['isbn'], $_POST['n_exemplares'], $_POST['idAutor'], $ext);
			
		}else{
			$resposta = insereLivro($_POST['nome'], $_POST['editora'], $_POST['data_publicacao'], $_POST['localizacao'],
															$_POST['resenha'], $_POST['edicao'], $_POST['isbn'], $_POST['n_exemplares'], $_POST['idAutor'], $ext);
		}
				
		// Criando loop com mensagens de erro
		if ($resposta['erro']){
			$aviso .= "Dados inválidos! Por favor reveja sua informações...<br>\n";
			foreach($resposta['erro'] as $erro){
				$aviso .= $erro . "<br>\n";
			}
		}else{
			// header("Location: ../livro.php?id=" . $_POST['id']);
			$aviso = $resposta['sucesso'][0];
			//$_POST = "";
			//$_POST['idAutor']="";
		}
		
		if ($_FILES['imagem']['name'] && $resposta['sucesso']){
			$imagem = UPLOAD_DIR."l" . $resposta['sucesso'][1] . "." . $ext;
			if (!move_uploaded_file($_FILES['imagem']['tmp_name'],$imagem)){
				$aviso .= "A imagem não foi adicionada!";
			}
		}
	}
	
	// Daqui para baixo é independente de edit e insert -------------------------------------
	
	// Preenche formulário a partir do id recebido
	if($_GET['id']){
		$id = $_GET['id'];
	}elseif($_POST['id']){
		$id = $_POST['id'];
	}
	
	
	if($id){
		$consultaLivro = localiza($id, "id", "livro");
		$livro = mysql_fetch_assoc($consultaLivro);
		$livro['data_publicacao'] = translateData($livro['data_publicacao']);
		
		$listaAutorSelecionado = localiza($livro['id'], "id_livro", "autor");
		while ($autor = mysql_fetch_assoc($listaAutorSelecionado)){
			$autoresLivro[] = $autor['id'];
		}
	}elseif($_POST['idAutor']){
		foreach($_POST['idAutor'] as $autor){
			$autoresLivro[] = $autor;
		}
	}
	
	// Monta lista de editoras para popular Selection
	$listaEditora = localiza("", "", "editora");					// Lista editotras
	while ($editora = mysql_fetch_assoc($listaEditora)){
		if($_POST['editora'])	$selected = ($_POST['editora'] == $editora['id'])? "selected='selected'" : "";		// Marca a editora do livro para o 'select' sem id
			else $selected = ($livro['id_editora'] == $editora['id'])? "selected='selected'" : "";								// Marca a editora do livro para o 'select' com id
		$editoras[] = array('id'=>$editora['id'],'nome'=>$editora['nome'],'selected'=>$selected);
	}
	
	// Monta lista de autores para popular Selection
	$listaAutor = localiza("", "paginas", "autor");					// Lista autores
	while ($linha = mysql_fetch_assoc($listaAutor)){
		$autores[] = array('id'=>$linha['id'],'l_name'=>$linha['l_name'],'f_name'=>$linha['f_name']);
	}
	
	// Monta lista de Selects para até 5 autores, já marcando os autores do livro
	for ($i = 0; $i < 5; $i++){
		$margem = ($i>0) ? "100px;" : "0;";
		$selectionAutor[] = array('margem'=>$margem,'idAutor'=>$autoresLivro[$i]);
	}
	
	$imagem = (!($id && $livro['imgext'])) ? IMG_DIR."book.png" : FOTOS_DIR . "l" . $livro['id'] . "." . $livro['imgext'];
}else{
	header("Location: index.php");
}

$autorizado = verificaLogin();

$action = ($id) ? "edit" : "insert";
$caption = ($id) ? "Atualizar" : "Gravar";

$tituloBanner = montaTitulo($_SERVER["SCRIPT_NAME"]);
$tituloSite = "GeracaoTec | " . $tituloBanner;

$smarty->assign('tituloSite',$tituloSite);
$smarty->assign('tituloBanner',$tituloBanner);
$smarty->assign('action',$action);
$smarty->assign('caption',$caption);
$smarty->assign('imagem',$imagem);
$smarty->assign('livro',$livro);
$smarty->assign('autores',$autores);
$smarty->assign('editoras',$editoras);
$smarty->assign('selectionAutor',$selectionAutor);
$smarty->assign('autorizado',$autorizado);
$smarty->assign('aviso',$aviso);
$smarty->display('cadastro_livro.tpl');
?>