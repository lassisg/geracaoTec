<?php /* Smarty version Smarty-3.1.8, created on 2012-04-17 15:52:36
         compiled from "../templates/admin\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:200334f8b3141c15ec1-18848078%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '907559029aa53018156be85494c81d1184d7c0c7' => 
    array (
      0 => '../templates/admin\\index.tpl',
      1 => 1334670667,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '200334f8b3141c15ec1-18848078',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f8b3141c654c4_62873986',
  'variables' => 
  array (
    'autorizado' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f8b3141c654c4_62873986')) {function content_4f8b3141c654c4_62873986($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("../cabecalho.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id="conteudo">
	<?php if (!$_smarty_tpl->tpl_vars['autorizado']->value){?>
	<h2>Login</h2>
	<form class="login" method="GET" action="login.php?acao=login">
		<p><label for="login">Usuário:</label><input type="text" name="login" maxlength="30"></p>
		<p><label for="senha">Senha:</label><input type="password" name="senha" maxlength="32"></p>
		<p><input class="limpar" type="reset" value="Cancelar"><input class="enviar" type="submit" value="Enviar"></p>
	</form>
	<?php }?>
</div>
</body>
</html><?php }} ?>