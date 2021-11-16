<?php /* Smarty version Smarty-3.1.8, created on 2012-04-17 15:52:43
         compiled from "../templates/admin\contatos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15634f8c0c1cd81871-95123160%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8018c1ba3b670af70c47f8fca8f15fe825a5f8b4' => 
    array (
      0 => '../templates/admin\\contatos.tpl',
      1 => 1334670677,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15634f8c0c1cd81871-95123160',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f8c0c1cdc6209_18983533',
  'variables' => 
  array (
    'autorizado' => 0,
    'contatos' => 0,
    'contato' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f8c0c1cdc6209_18983533')) {function content_4f8c0c1cdc6209_18983533($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("../cabecalho.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php if ($_smarty_tpl->tpl_vars['autorizado']->value){?>
<div id="conteudo">
	<h2>Contatos</h2>
	<table>
	<tr>
		<th width="50">Nome</th>
		<th width="50">Email</th>
		<th width="20">Telefone</th>
		<th>Mensagem</th>
		<th width="7%"> </th>
	</tr>
	<?php  $_smarty_tpl->tpl_vars['contato'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['contato']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['contatos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['contato']->key => $_smarty_tpl->tpl_vars['contato']->value){
$_smarty_tpl->tpl_vars['contato']->_loop = true;
?>
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['contato']->value['nome'];?>
</td>
		<td><a href="mailto:<?php echo $_smarty_tpl->tpl_vars['contato']->value['email'];?>
?Subject=Re:Contato"><?php echo $_smarty_tpl->tpl_vars['contato']->value['email'];?>
</a></td>
		<td><?php echo $_smarty_tpl->tpl_vars['contato']->value['telefone'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['contato']->value['mensagem'];?>
</td>
		<td style="padding-left: 15px;"><a href="javascript:confirmDelete('contatos.php?delete=<?php echo $_smarty_tpl->tpl_vars['contato']->value['id'];?>
')"><img height="18px" src="../images/delete.png" border="0"></a></td>
	</tr>
	<?php } ?>
</table>
</div>
<?php }?>
</body>
</html><?php }} ?>