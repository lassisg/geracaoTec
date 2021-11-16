<?php /* Smarty version Smarty-3.1.8, created on 2012-04-17 15:52:44
         compiled from "../templates/admin\cadastro_editora.tpl" */ ?>
<?php /*%%SmartyHeaderCode:229164f8b2559ed3e26-34804796%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '062b6b1165c565399b625eb5eb178ea23aa3b9df' => 
    array (
      0 => '../templates/admin\\cadastro_editora.tpl',
      1 => 1334670698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '229164f8b2559ed3e26-34804796',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f8b255a002729_29483545',
  'variables' => 
  array (
    'aviso' => 0,
    'autorizado' => 0,
    'caption' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f8b255a002729_29483545')) {function content_4f8b255a002729_29483545($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("../cabecalho.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php if ($_smarty_tpl->tpl_vars['aviso']->value){?>
<div id="resposta">
	<p><?php echo $_smarty_tpl->tpl_vars['aviso']->value;?>
</p>
</div>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['autorizado']->value){?>
<div id="conteudo">
	<?php if ($_GET['id']){?>
	<h2>Editando editora</h2>
	<?php }else{ ?>
	<h2>Cadastrando nova editora</h2>
	<?php }?>
	<form class="contato" method="GET">
		<p><label for="nome">Nome:</label><input type="text" name="nome" maxlength="50" value="<?php echo $_GET['nome'];?>
"></p>
		<input type="hidden" name="id" value="<?php echo $_GET['id'];?>
">
		<p><input class="limpar" type="reset" value="Limpar"><input class="enviar" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['caption']->value;?>
"></p>
	</form>
</div>
<?php }?>
</body>
</html><?php }} ?>