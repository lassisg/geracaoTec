<?php
	// Definido constantes de ambiente para o Projeto
	define("DOC_ROOT", getenv("DOCUMENT_ROOT"));
	define("SITE_ROOT", "/biblioteca/");
	define("INCLUDE_DIR", SITE_ROOT."includes/");
	define("CSS_DIR", SITE_ROOT."css/");
	define("IMG_DIR", SITE_ROOT."images/");
	define("FOTOS_DIR", SITE_ROOT."images/fotos/");
	define("UPLOAD_DIR", DOC_ROOT.SITE_ROOT."images/fotos/");
	
	// Inicia Sessão
	session_start();
?>