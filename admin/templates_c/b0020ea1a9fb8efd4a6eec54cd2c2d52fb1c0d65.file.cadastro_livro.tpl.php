<?php /* Smarty version Smarty-3.1.8, created on 2012-04-18 22:52:45
         compiled from "../templates/admin\cadastro_livro.tpl" */ ?>
<?php /*%%SmartyHeaderCode:320604f8b1f7ac35fb6-75280546%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b0020ea1a9fb8efd4a6eec54cd2c2d52fb1c0d65' => 
    array (
      0 => '../templates/admin\\cadastro_livro.tpl',
      1 => 1334782335,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '320604f8b1f7ac35fb6-75280546',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4f8b1f7ad77925_68464318',
  'variables' => 
  array (
    'aviso' => 0,
    'autorizado' => 0,
    'imagem' => 0,
    'livro' => 0,
    'selectionAutor' => 0,
    'selection' => 0,
    'autores' => 0,
    'autor' => 0,
    'editoras' => 0,
    'editora' => 0,
    'action' => 0,
    'caption' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f8b1f7ad77925_68464318')) {function content_4f8b1f7ad77925_68464318($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("../cabecalho.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php if ($_smarty_tpl->tpl_vars['aviso']->value){?>
<div id="resposta">
	<p><?php echo $_smarty_tpl->tpl_vars['aviso']->value;?>
</p>
</div>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['autorizado']->value){?>
<div id="conteudo">
	<?php if ($_GET['id']||$_POST['id']){?>
	<h2>Editando livro</h2>
	<?php }else{ ?>
	<h2>Cadastrando novo livro</h2>
	<?php }?>
	<div style="float:right; margin-right: 50px;"><img width="150px" src="<?php echo $_smarty_tpl->tpl_vars['imagem']->value;?>
" border="0"></div>
	<form class="contato" enctype="multipart/form-data" method="POST" action="cadastro_livro.php">
		<p><label for="nome">Nome:</label><input type="text" name="nome" maxlength="80" value="<?php echo $_POST['nome'];?>
<?php echo $_smarty_tpl->tpl_vars['livro']->value['nome'];?>
"></p>
		<p><label for="idAutor">Autor:</label>
		<?php  $_smarty_tpl->tpl_vars['selection'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['selection']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['selectionAutor']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['selection']->key => $_smarty_tpl->tpl_vars['selection']->value){
$_smarty_tpl->tpl_vars['selection']->_loop = true;
?>
			<select style="margin-left: <?php echo $_smarty_tpl->tpl_vars['selection']->value['margem'];?>
" size="1" name="idAutor[]">
				<option>Selecione autor</option>
				<?php  $_smarty_tpl->tpl_vars['autor'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['autor']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['autores']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['autor']->key => $_smarty_tpl->tpl_vars['autor']->value){
$_smarty_tpl->tpl_vars['autor']->_loop = true;
?>
				<option <?php if ($_smarty_tpl->tpl_vars['selection']->value['idAutor']==$_smarty_tpl->tpl_vars['autor']->value['id']){?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['autor']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['autor']->value['f_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['autor']->value['l_name'];?>
</option>
				<?php } ?>
			</select><br>
		<?php } ?>
		</p>
		<p><label for="editora">Editora:</label>
			<select style="margin-left: 0;" size="1" name="editora">
				<option selected="selected" value="-1">Selecione editora</option>
				<?php  $_smarty_tpl->tpl_vars['editora'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['editora']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['editoras']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['editora']->key => $_smarty_tpl->tpl_vars['editora']->value){
$_smarty_tpl->tpl_vars['editora']->_loop = true;
?>
				<option <?php echo $_smarty_tpl->tpl_vars['editora']->value['selected'];?>
 value="<?php echo $_smarty_tpl->tpl_vars['editora']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['editora']->value['nome'];?>
</option>
				<?php } ?>
			</select></p>
		<p><label for="edicao">Edição:</label><input type="text" name="edicao" value="<?php echo $_POST['edicao'];?>
<?php echo $_smarty_tpl->tpl_vars['livro']->value['edicao'];?>
"></p>
		<p><label for="data_publicacao">Publicado em:</label><input type="text" name="data_publicacao" value="<?php echo $_POST['data_publicacao'];?>
<?php echo $_smarty_tpl->tpl_vars['livro']->value['data_publicacao'];?>
"></p>
		<p><label for="isbn">ISBN:</label><input type="text" name="isbn" maxlength="13" value="<?php echo $_POST['isbn'];?>
<?php echo $_smarty_tpl->tpl_vars['livro']->value['isbn'];?>
"></p>
		<p><label for="imagem">Imagem:</label><input type="file" name="imagem"></p>
		<p><label for="n_exemplares">Exemplares:</label><input type="text" name="n_exemplares" value="<?php echo $_POST['n_exemplares'];?>
<?php echo $_smarty_tpl->tpl_vars['livro']->value['n_exemplares'];?>
"></p>
		<p><label for="localizacao">Localização:</label><input type="text" name="localizacao" maxlength="6" value="<?php echo $_POST['localizacao'];?>
<?php echo $_smarty_tpl->tpl_vars['livro']->value['localizacao'];?>
"></p>
		<p><label for="resenha">Resenha:</label><textarea name="resenha"><?php echo $_POST['resenha'];?>
<?php echo $_smarty_tpl->tpl_vars['livro']->value['resenha'];?>
</textarea></p>
		<input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
		<input type="hidden" name="id" value="<?php echo $_GET['id'];?>
">
		<p><input class="limpar" type="reset" value="Limpar"><input class="enviar" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['caption']->value;?>
"></p>
	</form>
</div>
<?php }?>
</body>
</html><?php }} ?>