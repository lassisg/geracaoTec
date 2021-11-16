{include file="cabecalho.tpl"}
<div id="busca">
	<form method="GET" action="busca.php">
		<p>
			Digite o nome do livro: <input type="text" name="nome_livro" size="15" value="{$smarty.get.nome_livro}">
			<input type="submit" value="Buscar">
		</p>
	</form>
</div>
{if !$smarty.get.id}
<div id="pageNav">
	{$nav}
</div>
{/if}
<div id="conteudo">
<table>
	<tr>
		<th>Nome do Livro</th>
		<th>Autor</th>
		<th>Editora</th>
		<th>Publicação</th>
		{if $autorizado}
		<th width="7%"> </th>
		{/if}
	</tr>
	{foreach item=livro from=$livros}		
	<tr>
		<td><a href="livro.php?id={$livro.id}">{$livro.nome}</a></td>
		<td>
		{foreach item=autor from=$livro.autores}
			<a href="autor.php?id={$autor.id}">{$autor.f_name} {$autor.l_name}</a><br>
		{/foreach}
		</td>
		<td>
		{if $autorizado}
		<a style="padding-right:10px;" href="admin/cadastro_editora.php?id={$livro.id_editora}&nome={$livro.editora}"><img height="18px" src="images/edit.png" border="0"></a>
		{/if}
		{$livro.editora}</td>
		<td style="text-align: center;">{$livro.data_publicacao}</td>
		{if $autorizado}
		<td>
		<a href="admin/cadastro_livro.php?id={$livro.id}"><img height="18px" src="images/edit.png" border="0"></a>
		<a href="javascript:confirmDelete('busca.php?delete={$livro.id}')"><img height="18px" src="images/delete.png" border="0"></a>
		</td>
		{/if}
	</tr>
	{/foreach}
	{if $smarty.get.nome_livro}
	<tr class="resumo">
		<td colspan="4">Total de resultados da pesquisa:</td>
		<td>{$livros|@count}</td>
	</tr>
	{/if}
</table>
</div>
{if !$smarty.get.id}
<div id="pageNav">
	{$nav}
</div>
{/if}
</body>
</html>