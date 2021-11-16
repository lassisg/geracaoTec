<?php
	// Montando o Título da página ------------------------------------------------------------------------------- <-------
	function montaTitulo($endereco, $temGet=""){
		$paginaAtual = substr($endereco,strrpos($endereco,"/")+1);
		$paginaAtual = substr($paginaAtual,0,strpos($paginaAtual,"."));
		
		if ($paginaAtual == 'index' || $paginaAtual == 'teste'){
			$paginaAtual = (strpos($endereco,"admin")) ? "ADMIN" : "HOME";
		}elseif ($paginaAtual == 'busca'){
			$paginaAtual =  ($temGet) ? "BUSCA" : "LIVROS";
		}elseif ($paginaAtual == 'autor'){
			$paginaAtual = ($temGet) ? "AUTOR" : "AUTORES";
		}elseif ($paginaAtual == 'contato'){
			$paginaAtual =  "CONTATO";
		}elseif ($paginaAtual == 'cadastro_autor'){
			$paginaAtual =  "CADASTRO DE AUTOR";
		}elseif ($paginaAtual == 'cadastro_livro'){
			$paginaAtual =  "CADASTRO DE LIVRO";
		}elseif ($paginaAtual == 'cadastro_editora'){
			$paginaAtual =  "CADASTRO DE EDITORA";
		}elseif ($paginaAtual == 'contatos'){
			$paginaAtual =  "CONTATOS";
		}else{
			$paginaAtual =  strtoupper($paginaAtual);
		}
		return $paginaAtual;
	}
	
	// Conectando no Banco de Dados ------------------------------------------------------------------------------ <-------
	function conectarDB(){
		/**
		 * 1 - Cria o link com o Banco de dados
		 * 2 - Informa qual banco de dados será utilizado
		 */
		
		// Cria o link com o Banco de dados
		$link = mysql_connect('localhost', 'leandro','123');
		
		// Informa qual banco de dados será utilizado
		$db_selected = mysql_select_db('biblioteca',$link);
		if(!$db_selected){
			die('Não foi possível selecionar o banco biblioteca: ' . mysql_error());
			mysql_close(); // Fechar a conexão
		}
	}
	
	// Verificando o Login --------------------------------------------------------------------------------------- <-------
	function verificaLogin($login = "test",$senha = "test"){
		$valido = false;
		
		if($login != "test" and $senha != "test"){
			conectarDB();
			
			$usuario = mysql_query("SELECT login, senha FROM usuarios WHERE login = '" . $login . "' AND senha = '" . sha1($senha) . "'");
			
			if (mysql_num_rows($usuario) > 0) {
				$valido = true;
				$_SESSION['logado'] = $valido;
			}
			
			mysql_close(); // Fechar a conexão
			
		}else{
			if($_SESSION['logado']) $valido = true;
		}
		return $valido;
	}
	
	// Função de busca -------------------------------------------------------------------------------------------- <-------
	function contaPaginas($dado, $tipo, $tabela){
		
		//
		$regitros = mysql_num_rows(localiza($dado, $tipo, $tabela));
		
		$paginas = ceil($regitros / 10);
		
		return $paginas;
	}
	
	function localiza($dado, $tipo, $tabela, $pagina = 1){
		/* ----------------------------------------------
		 * Monta consulta SQL conforme tabela selecionada
		 * ----------------------------------------------
		 * $dado 		=> Dado que queremos localizar. Pode ser: id ou nome de livro, id ou nome de autor
		 * $tipo 		=> Condição de busca. Pode ser: "id", "id_livro", "id_autor", ""
		 * $tabela 	=> Tabela onde buscaremos o dado. Pode ser: "autor", "livro", "contato"
		 * $pagina 	=> Determina a página a ser localizada (cada página tem até 10 itens)
		 *
		 */
		
		// Calcula primeiro item da página
		$item = 10 * ($pagina - 1);
		 
		conectarDB();
		
		switch ($tabela) {
    case "autor":
        $consulta = "SELECT * FROM autor";
				if($tipo == "id"){
					$condicao = " WHERE id = " . $dado;
				}elseif($tipo == "id_livro"){
					$condicao = " WHERE id IN (SELECT id_autor FROM livro_autor WHERE id_livro = " . $dado . ")";
				}else{
					$condicao = " WHERE l_name LIKE '%" . $dado . "%' OR f_name LIKE '%" . $dado . "%'";
				}
				$order = " ORDER BY l_name";
				
				if ($tipo == 'paginas'){
					$consulta = mysql_query($consulta . $condicao . $order);
				}else{
					$consulta = mysql_query($consulta . $condicao . $order . " LIMIT " . $item . ", 10");
				}
				break;
				
    case "livro":
				$consulta = "SELECT l.id, l.nome, l.resenha, l.edicao, DATE_FORMAT(l.data_publicacao,'%d/%m/%Y') as data_publicacao, l.isbn, l.n_exemplares, l.localizacao, l.id_editora, l.imgext, e.nome as editora FROM livro l INNER JOIN editora e ON l.id_editora = e.id";
        if($tipo == "id"){
					if($dado) $condicao = " WHERE l.id = " . $dado;
				}elseif($tipo == "id_autor"){
					$condicao = " WHERE l.id IN (SELECT id_livro FROM livro_autor la WHERE la.id_autor = " . $dado . ")";
				}else{
					if($dado){
						$condicao = " WHERE l.nome LIKE '%" . $dado . "%'";
					}
				}
				$order = ($tipo == "id" && !$dado) ? " ORDER BY RAND()" : " ORDER BY l.nome";
				
				if ($tipo == 'paginas'){
					$consulta = mysql_query($consulta . $condicao . $order);
				}else{
					$consulta = mysql_query($consulta . $condicao . $order . " LIMIT " . $item . ", 10");
				}
        break;
				
    case "editora":
				$consulta = "SELECT * FROM editora ORDER BY nome";
        
				$consulta = mysql_query($consulta);
        break;
		}
		
		mysql_close(); // Fechar a conexão
		
		return $consulta;
	}
	
	// Inserindo Editoras ----------------------------------------------------------------------------------------- <-------
	function insereEditora($nome){
		if(!validaNome($nome)) $resposta['erro'][] = "Erro no nome da editora!";
		
		if (!$resposta['erro']){
			conectarDB();
			$insereDados = mysql_query("INSERT INTO editora (nome) VALUES ('".addslashes($nome)."')");
			
			if (mysql_insert_id()){
				$resposta['sucesso'][] = "Dados gravados com sucesso!";
			}else{
				$resposta['erro'][] = "Erro na inserção de dados :" . mysql_error();
			}
			
			mysql_close(); // Fechar a conexão
		}
		
		return $resposta;
	}
	
	// Inserindo Livros ------------------------------------------------------------------------------------------- <--------
	function insereLivro($nome, $id_editora, $data_publicacao, $localizacao, $resenha, $edicao, $isbn, $n_exemplares, $idAutor, $imgext){
		// Validar dados
		if(!validaNome($nome)) $resposta['erro'][] = "Erro no nome do livro!";
		if(!validaEdicao($edicao)) $resposta['erro'][] = "Erro no valor da edição!";
		if(!validaData($data_publicacao)) $resposta['erro'][] = "Erro na data de publicação!";
		if(!validaISBN($isbn)) $resposta['erro'][] = "Erro no número de ISBN!";
		if(!validaEdicao($n_exemplares)) $resposta['erro'][] = "Número de exemplares inválido!";
		if(!validaLocalizacao($localizacao)) $resposta['erro'][] = "Localização inválida!";
		if(!validaOBS($resenha)) $resposta['erro'][] = "Erro na validação da resenha!";
		
		// Validando autores
		$idAutor = array_unique($idAutor);
		for($i=0;$i<count($idAutor);$i++){
			if($idAutor[$i] > 0) $autoresValidos[] = $idAutor[$i];
		}		
		if(!$autoresValidos) $resposta['erro'][] = "Nenhum autor selecionado!";
		
		$editora = mysql_query("SELECT nome FROM editora WHERE id = " . $id_editora);
		if(!mysql_num_rows($editora)) $resposta['erro'][] = "Nenhuma editora selecionada!";
		
		if (!$resposta['erro']){
			conectarDB();
			$data_publicacao = corrigeData($data_publicacao);
			$insereDados = mysql_query("INSERT INTO livro (nome, resenha, id_editora, edicao, data_publicacao, isbn, n_exemplares, localizacao, imgext) 
																VALUES 
																('".addslashes($nome)."','".addslashes($resenha)."',".($id_editora).",
																'".addslashes($edicao)."','".addslashes($data_publicacao)."','".addslashes($isbn)."',
																'".addslashes($n_exemplares)."','".addslashes($localizacao)."', '".$imgext."')");
			
			if (mysql_insert_id()){
				// Insere dados na tabela livro_autor, fazendo a associação
				
				// Fazer loop para vários autores
				$insertLivro = mysql_insert_id();
				for($i=0;$i<count($autoresValidos);$i++){		
					$insereLivroAutor = mysql_query("INSERT INTO livro_autor (id_livro, id_autor) VALUES (" . $insertLivro . ", " . $autoresValidos[$i] . ")");
				}
				
				if (!mysql_error()){
					$resposta['sucesso'][] = "Dados gravados com sucesso!";
					$resposta['sucesso'][] = $insertLivro;
				}else{
					$resposta['erro'][] = "Erro na inserção de dados associativos de Livro com Autor:" . mysql_error();
					mysql_query("DELETE FROM livro WHERE id = " . $idLivro);
				}
			}else{
				$resposta['erro'][] = "\nErro na inserção de dados :" . mysql_error();
			}
			
			mysql_close(); // Fechar a conexão
		}
		
		return $resposta;
	}
	
	// Editando Livros ------------------------------------------------------------------------------------------- <--------
	function editaLivro($id, $nome, $editora, $data_publicacao, $localizacao, $resenha, $edicao, $isbn, $n_exemplares, $idAutor, $imgext){
		// Validar dados
		if(!validaNome($nome)) $resposta['erro'][] = "Erro no nome do livro!";
		if(!validaEdicao($edicao)) $resposta['erro'][] = "Erro no valor da edição!";
		if(!validaData($data_publicacao)) $resposta['erro'][] = "Erro na data de publicação!";
		if(!validaISBN($isbn)) $resposta['erro'][] = "Erro no número de ISBN!";
		if(!validaEdicao($n_exemplares)) $resposta['erro'][] = "Número de exemplares inválido!";
		if(!validaLocalizacao($localizacao)) $resposta['erro'][] = "Localização inválida!";
		if(!validaOBS($resenha)) $resposta['erro'][] = "Erro na validação da resenha!";
		
		// Validando autores
		$idAutor = array_unique($idAutor);
		for($i=0;$i<count($idAutor);$i++){
			if($idAutor[$i] > 0) $autoresValidos[] = $idAutor[$i];
		}
		if(!$autoresValidos) $resposta['erro'][] = "Nenhum autor selecionado!";
		
		if (!$resposta['erro']){
			$data_publicacao = corrigeData($data_publicacao);
			conectarDB();
			if($imgext){
				mysql_query("UPDATE livro SET nome = '".addslashes($nome)."', resenha = '".addslashes($resenha)."', id_editora = '".addslashes($editora)."', edicao = '".addslashes($edicao)."', data_publicacao = '".addslashes($data_publicacao)."', isbn = '".addslashes($isbn)."', n_exemplares = '".addslashes($n_exemplares)."', localizacao = '".addslashes($localizacao)."', imgext = '".$imgext."' WHERE id=".$id);
			}else{
				mysql_query("UPDATE livro SET nome = '".addslashes($nome)."', resenha = '".addslashes($resenha)."', id_editora = '".addslashes($editora)."', edicao = '".addslashes($edicao)."', data_publicacao = '".addslashes($data_publicacao)."', isbn = '".addslashes($isbn)."', n_exemplares = '".addslashes($n_exemplares)."', localizacao = '".addslashes($localizacao)."' WHERE id=".$id);
			}
			if (mysql_affected_rows()){
				// Apaga relação anterior na tabela livro_autor e depois a refaz com os novos dados
				mysql_query("DELETE FROM livro_autor WHERE id_livro = " . $id);
				
				// Fazer loop para vários autores
				for($i=0;$i<count($autoresValidos);$i++){		
					$insereLivroAutor = mysql_query("INSERT INTO livro_autor (id_livro, id_autor) VALUES (" . $id . ", " . $autoresValidos[$i] . ")");
				}
				
				if (!mysql_error()){
					$resposta['sucesso'][] = "Dados atualizados com sucesso!";
					$resposta['sucesso'][] = $id;
				}else{
					$resposta['erro'][] = "Erro na atualização de dados associativos de Livro com Autor:" . mysql_error();
					mysql_query("DELETE FROM livro WHERE id = " . $id);
				}
			}else{
				$resposta['erro'][] = "\nErro na atualização de dados :" . mysql_error();
			}
			
			mysql_close(); // Fechar a conexão
		}
		
		return $resposta;
	}
	
	// Apagando Livro -------------------------------------------------------------------------------------------- <--------
	function apagaLivro($id, $imgext = ""){
		
		$foto = "l".$id.".".$imgext;				// Monta nome da foto para excluir após exclusão do registro do livro
		
		conectarDB();
		
		mysql_query("DELETE FROM livro_autor WHERE id_livro = " . $id );	// Apaga relação dos autores deste livro
		mysql_query("DELETE FROM livro WHERE id = " . $id );							// Apaga o Livro
		
		if (mysql_affected_rows()){
			if(file_exists(UPLOAD_DIR.$foto)) apagaImagem($foto);					// Apaga a imagem do Livro, caso exista
			$resposta['sucesso'][] = "Dados apagados com sucesso!";
		}else{
			$resposta['erro'][] = "Erro na deleção de dados :" . mysql_error();
		}
	
		mysql_close(); // Fecha a conexão
		
	}
	
	// Apagando Imagem ------------------------------------------------------------------------------------------- <--------
	function apagaImagem($imagem){
		if(unlink(UPLOAD_DIR.$imagem)){
			conectarDB();
			$atualizaBanco = mysql_query("UPDATE livro set imgext = ''");
			return mysql_affected_rows;
		}
		return false;
	}
	
	
	// Inserindo Autor -------------------------------------------------------------------------------------------- <--------
	function insereAutor($nome, $sobrenome, $observacoes){
		// Validar dados
		if ($nome && $sobrenome){
			if(!validaAutor($nome, $sobrenome)) $resposta['erro'][] = "Erro no nome do autor!";
			if(!validaOBS($observacoes)) $resposta['erro'][] = "Erro no conteúdo das observações!";
		}else{
			$resposta['erro'][] = "O nome e o sobrenome do autor são obrigatórios!";
		}
		
		if (!$resposta['erro']){
			conectarDB();
			$insereDados = mysql_query("INSERT INTO autor (f_name, l_name, observacoes) VALUES 
																('".addslashes($nome)."','".addslashes($sobrenome)."','".addslashes($observacoes)."')");
			
			if (mysql_insert_id()){
				$resposta['sucesso'][] = "Dados gravados com sucesso!";
			}else{
				$resposta['erro'][] = "Erro na inserção de dados :" . mysql_error();
			}
		
			mysql_close(); // Fechar a conexão
		}
		
		return $resposta;
	}
	
	// Editando Autor -------------------------------------------------------------------------------------------- <--------
	function editaAutor($id, $nome, $sobrenome, $observacoes){
		// Validar dados
		if ($nome && $sobrenome){
			if(!validaAutor($nome, $sobrenome)) $resposta['erro'][] = "Erro no nome do autor!";
			if(!validaOBS($observacoes)) $resposta['erro'][] = "Erro no conteúdo das observações!";
		}else{
			$resposta['erro'][] = "O nome e o sobrenome do autor são obrigatórios!";
		}
		
		if (!$resposta['erro']){
			conectarDB();
			mysql_query("UPDATE autor SET f_name = '".addslashes($nome)."', l_name = '".addslashes($sobrenome)."', observacoes = '".addslashes($observacoes)."' WHERE id = " . $id );
			
			if (mysql_affected_rows()){
				$resposta['sucesso'][] = "Dados atualizados com sucesso!";
			}else{
				$resposta['erro'][] = "Erro na atualização de dados :" . mysql_error();
			}
		
			mysql_close(); // Fechar a conexão
		}
		
		return $resposta;
	}
	
	// Apagando Autor -------------------------------------------------------------------------------------------- <--------
	function apagaAutor($id){
		
		conectarDB();
		// Apaga relação dos livros deste autor
		mysql_query("DELETE FROM livro_autor WHERE id_autor = " . $id );
		mysql_query("DELETE FROM autor WHERE id = " . $id );
		
		if (mysql_affected_rows()){
			$resposta['sucesso'][] = "Dados apagados com sucesso!";
		}else{
			$resposta['erro'][] = "Erro na deleção de dados :" . mysql_error();
		}
	
		mysql_close(); // Fechar a conexão
		
	}
	
	// Apaga contato ---------------------------------------------------------------------------------------------- <--------
	function apagaContato($id){
	
		conectarDB();
		// Apaga relação dos livros deste autor
		mysql_query("DELETE FROM contato WHERE id = " . $id );
		
		if (mysql_affected_rows()){
			$resposta['sucesso'][] = "Dados apagados com sucesso!";
		}else{
			$resposta['erro'][] = "Erro na deleção de dados :" . mysql_error();
		}
	
		mysql_close(); // Fechar a conexão
	}
	
	// Validações de contato -------------------------------------------------------------------------------------- <--------
	function validaNome($nome){
		/**
		 * 1 - Verifica se possui ao menos 4 caracteres necessários para um nome (José)
		 */
		if(strlen($nome) < 4){
			return false;
		}else{
			return true;
		}
	}
	
	function validaEmail($email){
		/**
		 * 1 - Verifica se possui ao menos 1 caractere '.' e 1 caractere '@'
		 * 2 - Verifica se tem ao menos 6 caracteres ('a@a.br')
		 * 3 - Verifica se não tem espaço em branco " "
		 */
		if(strrpos($email," ") || strlen($email) < 6 || !strpos($email,".") || !strpos($email,"@")){
			return false;
		}else{
			return true;
		}
	}
	
	function validaTelefone($telefone){
		/**
		 * 1 - Verifica se possui ao menos 8 caracteres necessários para um número de telefone (12345678)
		 * 2 - Verifica se é numérico
		 */
		if(!is_numeric($telefone) || strlen($telefone) < 8){
			return false;
		}else{
			return true;
		}
	}
	
	function validaMensagem($mensagem){
		/**
		 * 1 - Verifica se possui ao menos 20 caracteres necessários para uma mensagem razoável
		 * 2 - Verifica se possui mais de 255 caracteres, limite importo pelo BD
		 */
		if(strlen($mensagem) < 20 || strlen($mensagem) > 255){
			return false;
		}else{
			return true;
		}
	}
	
	// Validações de autor ---------------------------------------------------------------------------------------- <--------
	function validaAutor($nome, $sobrenome){
		/**
		 * 1 - Verifica se o nome e sobrenome possuem ao menos 4 caracteres necessários para um nome
		 * 2 - Verifica se o nome possui no máximo 30 caracteres, limite imposto pelo BD
		 * 3 - Verifica se o nome possui no máximo 20 caracteres, limite imposto pelo BD
		 */
		if(strlen($nome) < 3 || strlen($sobrenome) < 3 || strlen($nome) > 30 || strlen($sobrenome) > 20){
			return false;
		}else{
			return true;
		}
	}
	
	function validaOBS($mensagem){
		/**
		 * 1 - Verifica se possui mais de 255 caracteres, limite imposto pelo BD
		 */
		if(strlen($mensagem) > 255){
			return false;
		}else{
			return true;
		}
	}
	
	// Validações de livro ---------------------------------------------------------------------------------------- <--------
	function validaEdicao($valor){
		/**
		 * 1 - Verifica se possui mais de 2 caracteres, limite imposto pelo BD
		 * 2 - Verifica se é numérico
		 */
		if(!is_numeric($valor) || strlen($valor) > 2){
			return false;
		}else{
			return true;
		}
	}
	
	function validaData($data,$acao = 1){
		// 1 - Verifica se é uma data válida
		
		// Inicia as variáveis de controle
		$dia = $acao;
		$mes = $acao;
		$ano = -1;
					
		if(strpos($data,"/")){
			$tmpData = explode("/",$data);
			
			if (count($tmpData) == 2){							// Foram preenchidos mês e ano
				if(strlen($tmpData[1]) == 4){
					$mes = $tmpData[0];
					$ano = $tmpData[1];
				}
			}elseif (count($tmpData) == 3){					// Foram preenchidos dia, mês e ano
				if(strlen($tmpData[2]) == 4){
					$dia = $tmpData[0];
					$mes = $tmpData[1];
					$ano = $tmpData[2];
				}
			}
		}elseif(strlen($data) >= 4){
			$ano = $data;
		}
		
		if ($acao == 1){
			if (checkdate($mes,$dia,$ano)){
				return true;
			} else {
				return false;
			}
		}else{
			return ($ano."-".$mes."-".$dia);
		}
	}
	
	function corrigeData($valor){
		// A data poderia ser: 2010, 10/2010, 01/10/2010
		// Como o banco está configurado para aceitar a data completa, dia e mês forma preenchidos com o valor 1
		
		$dataCorrigida = validaData($valor,0);
		
		return $dataCorrigida;
	}
	
	function translateData($valor){
		/* 
		 * Esta função pretende ajustar o formato da data para visualização na tela
		 * Por isso considera-se que a data está vindo do Banco e está no formato correto (dd/mm/yyyy)
		 */
		
		$data = explode("/",$valor);
		$dia = intval($data[0]);
		$mes = intval($data[1]);
		$ano = intval($data[2]);
		
		// Considero que a data foi cadastrada com dia e mês iguais a 1 no momento de inserção ou edição
		if($dia == 0 && $mes == 0){
			$dataAjustada = $ano;
		}elseif($dia == 0){
			$dataAjustada = $mes."/".$ano;
		}else{
			$dataAjustada = $valor;
		}
		
		return $dataAjustada;
	}
	
	function validaISBN($isbn){
		/**
		 * 1 - Verifica se possui mais de 13 caracteres, limite imposto pelo BD
		 */
		if(!is_numeric($isbn + 0) || strlen($valor) > 13){
			return false;
		}else{
			return true;
		}
	}
	function validaLocalizacao($valor){
		/**
		 * 1 - Verifica se possui mais de 6 caracteres, limite imposto pelo BD
		 * 2 - Verifica se está no formato correto: E99P02
		 */
		if(!is_numeric($valor + 0) || strlen($valor) > 13){
			return false;
		}else{
			return true;
		}
	}
	
	/*
	function gravarContato($nome,$email,$telefone,$mensagem){
		/**
		 * 1 - Cria um arquivo caso ele não exista
		 * 2 - Abre o arquivo caso ele já exista
		 * 3 - Escreve valores no arquivo
		 * 4 - Salva arquivo
		 *//*
		
		$caminho = $_SERVER{'DOCUMENT_ROOT'} . "/Dev/GeracaoTec/biblioteca/";
		$arquivo = "contatos.txt";
		
		if (!file_exists($caminho . $arquivo)){
			// Cria um arquivo caso ele não exista
			$contatos = fopen($arquivo, 'w') or die("Não foi possível criar o arquivo. :(");
		}else{
			// Abre o arquivo caso ele já exista
			$contatos = fopen($caminho . $arquivo, 'a') or die("Não foi possível abrir o arquivo. :(");
		}
		
		// Escreve valores no arquivo
		$dataAtual = date('d/m/Y H:i:s',$_SERVER['REQUEST_TIME']);
		fwrite($contatos, "<contato='" .  $dataAtual . "'>\n");
		fwrite($contatos, "Nome: " . $nome . "\n");
		fwrite($contatos, "E-mail: " . $email . "\n");
		fwrite($contatos, "Telefone: " . $telefone . "\n");
		fwrite($contatos, "Mensagem: " . $mensagem . "\n</contato>\n");
	
		// Salva arquivo
		fclose($contatos);
	}*/
?>