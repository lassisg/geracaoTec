{include file="cabecalho.tpl"}
<div id="busca">
	<form method="GET">
		<p>
			Digite o nome do autor: <input type="text" name="nome" size="15" value="{$smarty.get.nome}">
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
		<th width="20%">Nome do Autor</th>
		<th width="30%">Livros</th>
		<th>Observações</th>
		{if $autorizado}
		<th width="7%"> </th>
		{/if}
	</tr>
	{foreach item=autor from=$autores}
	<tr>
		<td><a href="autor.php?id={$autor.id}">{$autor.l_name}, {$autor.f_name}</a></td>
		<td>
		{foreach item=livro from=$autor.livros}
			<a href="livro.php?id={$livro.id}">{$livro.nome}</a><br>
		{/foreach}
		</td>
		<td>{$autor.observacoes}</td>
		{if $autorizado}
		<td>
		<a href="admin/cadastro_autor.php?id={$autor.id}&nome={$autor.f_name}&sobrenome={$autor.l_name}&observacoes={$autor.observacoes}"><img height="18px" src="images/edit.png" border="0"></a> 
		<a href="javascript:confirmDelete('autor.php?delete={$autor.id}')"><img height="18px" src="images/delete.png" border="0"></a>
		</td>
		{/if}
	</tr>
	{/foreach}
	{if $smarty.get.nome!=""}
	<tr class="resumo">
		<td colspan="{if $autorizado}3{else}2{/if}">Total de resultados da pesquisa:</td>
		<td>{$autores|@count}</td>
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