{include file="cabecalho.tpl"}
<div id="conteudo">
	<table>
	<tr>
		<td width="150">Nome do Livro: </td>
		<td width="550">{$livro.nome}</td>
		{if $autorizado}
		<td style="padding-left: 50px">
		<a href="admin/cadastro_livro.php?id={$livro.id}"><img height="18px" src="images/edit.png" border="0"></a> 
		<a href="javascript:confirmDelete('busca.php?delete={$livro.id}&ext={$livro.imgext}')"><img height="18px" src="images/delete.png" border="0"></a>
		</td>
		{else}
		<td rowspan="7"><img src="{$imagem}" width="150" border="0"></td>
		{/if}
	</tr>
	<tr>
		<td>Autor:</td>
		<td>
		{foreach item=autor from=$autores}
			<a href="autor.php?id={$autor.id}">{$autor.l_name}, {$autor.f_name}</a><br>
		{/foreach}
		</td>
		{if $autorizado}
		<td rowspan="6" style="text-align:center; font-size:10pt;">
		<img src="{$imagem}" width="150" border="0">
		{if $livro.imgext}<p style="padding-top:5px;padding-bottom:5px;"><a href="javascript:confirmImgRemoval('livro.php?id={$livro.id}&noimg={$foto}')">Remover imagem</p>{/if}
		</td>
		{/if}
	</tr>
	<tr><td>ISBN:</td><td>{$livro.isbn}</td></tr>
	<tr><td>Editora:</td>
		<td>
		{if $autorizado}
		<a style="padding-right:10px;" href="admin/cadastro_editora.php?id={$livro.id_editora}&nome={$livro.editora}"><img height="18px" src="images/edit.png" border="0"></a>
		{/if}
		{$livro.editora}
		</td>
	</tr >
	<tr><td>Edição:</td><td>{$livro.edicao}</td></tr >
	<tr><td>Data Publicação:</td><td>{$livro.data_publicacao}</td></tr>
	<tr><td>Resenha:</td><td>{$livro.resenha}</td></tr>
</table>
</div>
</body>
</html>