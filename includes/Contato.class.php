<?php
class Contato{
	private $nome;
	private $email;
	private $telefone;
	private $mensagem;
	
	function set($prop, $val){
		
		switch ($prop) {
    	case 'nome':
			$valido = $this->validaNome($val);
			break;
    	case 'email':
			$valido = $this->validaEmail($val);
			break;
    	case 'telefone':
			$valido = $this->validaTelefone($val);
			break;
    	case 'mensagem':
			$valido = $this->validaMensagem($val);
			break;
		}
		if($valido) $this->$prop = $val;
	}
	
  function validaNome($nome){
		/**
		 * 1 - Verifica se possui ao menos 4 caracteres necess�rios para um nome (Jos�)
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
		 * 3 - Verifica se n�o tem espa�o em branco " "
		 */
		if(strrpos($email," ") || strlen($email) < 6 || !strpos($email,".") || !strpos($email,"@")){
			return false;
		}else{
			return true;
		}
	}
	
	function validaTelefone($telefone){
		/**
		 * 1 - Verifica se possui ao menos 8 caracteres necess�rios para um n�mero de telefone (12345678)
		 * 2 - Verifica se � num�rico
		 */
		if(!is_numeric($telefone) || strlen($telefone) < 8){
			return false;
		}else{
			return true;
		}
	}
	
	function validaMensagem($mensagem){
		/**
		 * 1 - Verifica se possui ao menos 20 caracteres necess�rios para uma mensagem razo�vel
		 * 2 - Verifica se possui mais de 255 caracteres, limite importo pelo BD
		 */
		if(strlen($mensagem) < 20 || strlen($mensagem) > 255){
			return false;
		}else{
			return true;
		}
	}
	
	function get($prop){
		return $this->$prop;
	}
	
	function inserirContato(){
		// Verifica se os dados foram validados
		if(!$this->telefone || !$this->email) $resposta['erro'][] = "Telefone e email s�o obrigat�rios!";
		if(!$this->telefone) $resposta['erro'][] = "Telefone inv�lido!";
		if(!$this->email) $resposta['erro'][] = "Email inv�lido!";
		if(!$this->nome) $resposta['erro'][] = "Nome inv�lido!";
		if(!$this->mensagem) $resposta['erro'][] = "Mensagem inv�lida!";
		
		if (!$resposta['erro']){
			// Trazer fun��o de banco para a classe
			conectarDB();
			$insereDados = mysql_query("INSERT INTO contato (nome, email, telefone, mensagem) VALUES 
																('".addslashes($this->nome) . "','" . $this->email . "','" . $this->telefone . "','" . addslashes($this->mensagem) . "')");
			
			if (mysql_insert_id()){
				$resposta['sucesso'] = "Dados gravados com sucesso!";
			}else{
				$resposta['erro'] = "Erro na inser��o de dados:" . mysql_error();
			}
			
			mysql_close(); // Fechar a conex�o
		}
		
		return $resposta;
	}
	
	function listarContatos(){
		// Trazer fun��o de banco para a classe
		conectarDB();
		$consulta = mysql_query("SELECT * FROM contato");
		while ($contato = mysql_fetch_assoc($consulta)){
			$contatos[] = array('id'=>$contato['id'],'nome'=>$contato['nome'],'email'=>$contato['email'],'telefone'=>$contato['telefone'],'mensagem'=>$contato['mensagem']);
		}
		
		return $contatos;
	}
}
?>