<html>
	<head>
		<title>{$tituloSite}</title>
	</head>
<body>
<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}reset.css" />
<link rel="stylesheet" type="text/css" href="{$smarty.const.CSS_DIR}estilos.css" />

<script type="text/javascript">
	function confirmDelete(delUrl) {
		if (confirm("Deseja mesmo apagar este registro?")) {
			document.location = delUrl;
		}
	}
	function confirmImgRemoval(delUrl) {
		if (confirm("Deseja mesmo remover esta imagem?")) {
			document.location = delUrl;
		}
	}
</script>

<div id="banner">
	<div><h1>{$tituloBanner}</h1></div>
</div>

<div id="menu">
	<ul>
		<li><a href="{$smarty.const.SITE_ROOT}index.php">HOME</a></li> 						<!-- mostrar a lista de autores -->
		<li><a href="{$smarty.const.SITE_ROOT}busca.php">LIVROS</a></li> 					<!-- mostrar a lista de livros -->
		<li><a href="{$smarty.const.SITE_ROOT}autor.php">AUTORES</a></li> 				<!-- mostrar a lista de autores -->
		<li><a href="{$smarty.const.SITE_ROOT}contato.php">CONTATO</a></li> 			<!-- informações para contato -->
		{if $autorizado}
		<li><a href="{$smarty.const.SITE_ROOT}admin/login.php">Logout</a></li>		<!-- área de administração -->
		{else}
		<li><a href="{$smarty.const.SITE_ROOT}admin/">Login</a></li>							<!-- área de administração -->
		{/if}
	</ul>
</div>

{if $autorizado}
<div id="menuAdmin">
	<ul>
		<li><a href="{$smarty.const.SITE_ROOT}admin/cadastro_autor.php">Cadastrar autor</a></li> 			<!-- cadastra novo autor -->
		<li><a href="{$smarty.const.SITE_ROOT}admin/cadastro_livro.php">Cadastrar livro</a></li> 			<!-- cadastra novo livro -->
		<li><a href="{$smarty.const.SITE_ROOT}admin/cadastro_editora.php">Cadastrar editora</a></li>	<!-- cadastra nova editora -->
		<li><a href="{$smarty.const.SITE_ROOT}admin/contatos.php">Contatos</a></li> 									<!-- visulaisa contatos dos usuários -->
	</ul>
</div>
{/if}