<?php /* Smarty version Smarty-3.1.8, created on 2012-04-18 05:49:04
         compiled from "../templates/admin\cadastro_autor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13894f8b255cd84a93-29117418%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '996c6afad52778a94c36693a2d7e28e369daddb3' => 
    array (
      0 => '../templates/admin\\cadastro_autor.tpl',
      1 => 1334685078,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13894f8b255cd84a93-29117418',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f8b255ce30ed0_15474149',
  'variables' => 
  array (
    'aviso' => 0,
    'autorizado' => 0,
    'action' => 0,
    'caption' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f8b255ce30ed0_15474149')) {function content_4f8b255ce30ed0_15474149($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("../cabecalho.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php if ($_smarty_tpl->tpl_vars['aviso']->value){?>
<div id="resposta">
	<p><?php echo $_smarty_tpl->tpl_vars['aviso']->value;?>
</p>
</div>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['autorizado']->value){?>
<div id="conteudo">
	<?php if ($_POST['id']){?>
	<h2>Editando autor</h2>
	<?php }else{ ?>
	<h2>Cadastrando novo autor</h2>
	<?php }?>
	<form class="contato" method="POST">
		<p><label for="nome">Nome:</label><input type="text" name="nome" maxlength="30" value="<?php echo $_POST['nome'];?>
"></p>
		<p><label for="sobrenome">Sobrenome:</label><input type="text" name="sobrenome" maxlength="20" value="<?php echo $_POST['sobrenome'];?>
"></p>
		<p><label for="observacoes">Observações:</label><textarea name="observacoes"><?php echo $_POST['observacoes'];?>
</textarea></p>
		<input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
		<input type="hidden" name="id" value="<?php echo $_POST['id'];?>
">
		<p><input class="limpar" type="reset" value="Limpar"><input class="enviar" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['caption']->value;?>
"></p>
	</form>
</div>
<?php }?>
</body>
</html><?php }} ?>