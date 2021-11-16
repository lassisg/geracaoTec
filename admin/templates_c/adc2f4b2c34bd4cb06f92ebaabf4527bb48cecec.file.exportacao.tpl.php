<?php /* Smarty version Smarty-3.1.8, created on 2012-04-16 01:33:15
         compiled from "../templates/admin\exportacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:135344f8b1a64681714-45695320%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'adc2f4b2c34bd4cb06f92ebaabf4527bb48cecec' => 
    array (
      0 => '../templates/admin\\exportacao.tpl',
      1 => 1334532268,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '135344f8b1a64681714-45695320',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f8b1a64769d20_65475156',
  'variables' => 
  array (
    'nav' => 0,
    'autorizado' => 0,
    'livros' => 0,
    'livro' => 0,
    'autor' => 0,
    'autoresEdicao' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f8b1a64769d20_65475156')) {function content_4f8b1a64769d20_65475156($_smarty_tpl) {?><div id="busca">
	<form method="GET">
		<p>
			Digite o nome do autor: <input type="text" name="nome" size="15" value="<?php echo $_GET['nome'];?>
">
			<input type="submit" value="Buscar">
		</p>
		
	</form>
</div>
<?php if (!$_GET['id']){?>
<div id="pageNav">
	<?php echo $_smarty_tpl->tpl_vars['nav']->value;?>

</div>
<?php }?>
<div id="conteudo">
<table>
	<tr>
		<th>Nome do Livro</th>
		<th>Autor</th>
		<th>Editora</th>
		<th>Data Publicação</th>
		<?php if ($_smarty_tpl->tpl_vars['autorizado']->value){?>
		<th width="7%"> </th>
		<?php }?>
	</tr>
	<?php  $_smarty_tpl->tpl_vars['livro'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['livro']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['livros']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['livro']->key => $_smarty_tpl->tpl_vars['livro']->value){
$_smarty_tpl->tpl_vars['livro']->_loop = true;
?>
	<tr>
		<td><a href="livro.php?id=<?php echo $_smarty_tpl->tpl_vars['livro']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['livro']->value['nome'];?>
</a></td>
		<td>
		<?php  $_smarty_tpl->tpl_vars['autor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['autor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['livro']->value['autores']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['autor']->key => $_smarty_tpl->tpl_vars['autor']->value){
$_smarty_tpl->tpl_vars['autor']->_loop = true;
?>
			<a href="autor.php?id=<?php echo $_smarty_tpl->tpl_vars['autor']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['autor']->value['f_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['autor']->value['l_name'];?>
</a><br>
		<?php } ?>
		</td>
		<td><?php echo $_smarty_tpl->tpl_vars['livro']->value['editora'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['livro']->value['data_publicacao'];?>
</td>
		<?php if ($_smarty_tpl->tpl_vars['autorizado']->value){?>
		<td>
		<a href="admin/cadastro_livro.php?id=<?php echo $_smarty_tpl->tpl_vars['livro']->value['id'];?>
&nome=<?php echo $_smarty_tpl->tpl_vars['livro']->value['nome'];?>
&editora=<?php echo $_smarty_tpl->tpl_vars['livro']->value['editora'];?>
&edicao=<?php echo $_smarty_tpl->tpl_vars['livro']->value['edicao'];?>
&data_publicacao=<?php echo $_smarty_tpl->tpl_vars['livro']->value['data_publicacao'];?>
&isbn=<?php echo $_smarty_tpl->tpl_vars['livro']->value['isbn'];?>
&n_exemplares=<?php echo $_smarty_tpl->tpl_vars['livro']->value['n_exemplares'];?>
&localizacao=<?php echo $_smarty_tpl->tpl_vars['livro']->value['localizacao'];?>
&resenha=<?php echo $_smarty_tpl->tpl_vars['livro']->value['resenha'];?>
<?php echo $_smarty_tpl->tpl_vars['autoresEdicao']->value;?>
"><img height="18px" src="images/edit.png" border="0"></a> 
		<a href="javascript:confirmDelete('busca.php?delete=<?php echo $_smarty_tpl->tpl_vars['livro']->value['id'];?>
')"><img height="18px" src="images/delete.png" border="0"></a>
		</td>
		<?php }?>
	</tr>
	<?php } ?>
</table>
</div>
<?php if (!$_GET['id']){?>
<div id="pageNav">
	<?php echo $_smarty_tpl->tpl_vars['nav']->value;?>

</div>
<?php }?>
</body>
</html><?php }} ?>