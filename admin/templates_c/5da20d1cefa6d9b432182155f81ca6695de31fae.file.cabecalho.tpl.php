<?php /* Smarty version Smarty-3.1.8, created on 2012-04-18 22:46:33
         compiled from "C:\xampp\htdocs\GeracaoTec\biblioteca\templates\cabecalho.tpl" */ ?>
<?php /*%%SmartyHeaderCode:219214f8d753538c814-24527933%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5da20d1cefa6d9b432182155f81ca6695de31fae' => 
    array (
      0 => 'C:\\xampp\\htdocs\\GeracaoTec\\biblioteca\\templates\\cabecalho.tpl',
      1 => 1334780870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '219214f8d753538c814-24527933',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f8d7535434019_54944362',
  'variables' => 
  array (
    'tituloSite' => 0,
    'tituloBanner' => 0,
    'autorizado' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f8d7535434019_54944362')) {function content_4f8d7535434019_54944362($_smarty_tpl) {?><html>
	<head>
		<title><?php echo $_smarty_tpl->tpl_vars['tituloSite']->value;?>
</title>
	</head>
<body>
<link rel="stylesheet" type="text/css" href="<?php echo @CSS_DIR;?>
reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo @CSS_DIR;?>
estilos.css" />

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
	<div><h1><?php echo $_smarty_tpl->tpl_vars['tituloBanner']->value;?>
</h1></div>
</div>

<div id="menu">
	<ul>
		<li><a href="<?php echo @SITE_ROOT;?>
index.php">HOME</a></li> 						<!-- mostrar a lista de autores -->
		<li><a href="<?php echo @SITE_ROOT;?>
busca.php">LIVROS</a></li> 					<!-- mostrar a lista de livros -->
		<li><a href="<?php echo @SITE_ROOT;?>
autor.php">AUTORES</a></li> 				<!-- mostrar a lista de autores -->
		<li><a href="<?php echo @SITE_ROOT;?>
contato.php">CONTATO</a></li> 			<!-- informações para contato -->
		<?php if ($_smarty_tpl->tpl_vars['autorizado']->value){?>
		<li><a href="<?php echo @SITE_ROOT;?>
admin/login.php">Logout</a></li>		<!-- área de administração -->
		<?php }else{ ?>
		<li><a href="<?php echo @SITE_ROOT;?>
admin/">Login</a></li>							<!-- área de administração -->
		<?php }?>
	</ul>
</div>

<?php if ($_smarty_tpl->tpl_vars['autorizado']->value){?>
<div id="menuAdmin">
	<ul>
		<li><a href="<?php echo @SITE_ROOT;?>
admin/cadastro_autor.php">Cadastrar autor</a></li> 			<!-- cadastra novo autor -->
		<li><a href="<?php echo @SITE_ROOT;?>
admin/cadastro_livro.php">Cadastrar livro</a></li> 			<!-- cadastra novo livro -->
		<li><a href="<?php echo @SITE_ROOT;?>
admin/cadastro_editora.php">Cadastrar editora</a></li>	<!-- cadastra nova editora -->
		<li><a href="<?php echo @SITE_ROOT;?>
admin/contatos.php">Contatos</a></li> 									<!-- visulaisa contatos dos usuários -->
	</ul>
</div>
<?php }?><?php }} ?>