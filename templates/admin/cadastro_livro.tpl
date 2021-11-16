{include file="../cabecalho.tpl"}
{if $aviso}
<div id="resposta">
	<p>{$aviso}</p>
</div>
{/if}
{if $autorizado}
<div id="conteudo">
	{if $smarty.get.id or $smarty.post.id}
	<h2>Editando livro</h2>
	{else}
	<h2>Cadastrando novo livro</h2>
	{/if}
	<div style="float:right; margin-right: 50px;"><img width="150px" src="{$imagem}" border="0"></div>
	<form class="contato" enctype="multipart/form-data" method="POST" action="cadastro_livro.php">
		<p><label for="nome">Nome:</label><input type="text" name="nome" maxlength="80" value="{$smarty.post.nome}{$livro.nome}"></p>
		<p><label for="idAutor">Autor:</label>
		{foreach item=selection from=$selectionAutor}
			<select style="margin-left: {$selection.margem}" size="1" name="idAutor[]">
				<option>Selecione autor</option>
				{foreach item=autor from=$autores}
				<option {if $selection.idAutor == $autor.id} selected="selected" {/if} value="{$autor.id}">{$autor.f_name} {$autor.l_name}</option>
				{/foreach}
			</select><br>
		{/foreach}
		</p>
		<p><label for="editora">Editora:</label>
			<select style="margin-left: 0;" size="1" name="editora">
				<option selected="selected" value="-1">Selecione editora</option>
				{foreach item=editora from=$editoras}
				<option {$editora.selected} value="{$editora.id}">{$editora.nome}</option>
				{/foreach}
			</select></p>
		<p><label for="edicao">Edição:</label><input type="text" name="edicao" value="{$smarty.post.edicao}{$livro.edicao}"></p>
		<p><label for="data_publicacao">Publicado em:</label><input type="text" name="data_publicacao" value="{$smarty.post.data_publicacao}{$livro.data_publicacao}"></p>
		<p><label for="isbn">ISBN:</label><input type="text" name="isbn" maxlength="13" value="{$smarty.post.isbn}{$livro.isbn}"></p>
		<p><label for="imagem">Imagem:</label><input type="file" name="imagem"></p>
		<p><label for="n_exemplares">Exemplares:</label><input type="text" name="n_exemplares" value="{$smarty.post.n_exemplares}{$livro.n_exemplares}"></p>
		<p><label for="localizacao">Localização:</label><input type="text" name="localizacao" maxlength="6" value="{$smarty.post.localizacao}{$livro.localizacao}"></p>
		<p><label for="resenha">Resenha:</label><textarea name="resenha">{$smarty.post.resenha}{$livro.resenha}</textarea></p>
		<input type="hidden" name="action" value="{$action}">
		<input type="hidden" name="id" value="{$smarty.get.id}">
		<p><input class="limpar" type="reset" value="Limpar"><input class="enviar" type="submit" value="{$caption}"></p>
	</form>
</div>
{/if}
</body>
</html>