{include file="cabecalho.tpl"}
<div id="conteudo">
	<table>
		<tr>
			<th width="500">Últimos Lançamentos</th>
			<th width="300">Mais lidos</th>
			<th width="300">Principais Autores</th>
		</tr>
		<tr>
			<td>
			{foreach item=livro from=$livros}
				<a href="livro.php?id={$livro.id}">{$livro.nome}</a><br>
			{/foreach}
			</td>
			<td><!-- Mais lidos -->
				<a href="livro.php?id=11">Romeu e Julieta</a><br>
				<a href="livro.php?id=10">Avatar</a><br>
				<a href="livro.php?id=9">Código Da Vinci</a><br>
				<a href="livro.php?id=13">Turma da Mônica</a><br>
				<a href="livro.php?id=12">E.T.</a><br>
			</td>
			<td>
			{foreach item=autor from=$autores}
				<a href="autor.php?id={$autor.id}">{$autor.l_name}, {$autor.f_name}</a><br>
			{/foreach}
			</td>
		</tr>
	</table>
</div>

<div id="busca">
	<form method="GET" action="busca.php">
		<p>
			Digite o nome do livro: <input type="text" name="nome_livro" size="15"><input type="submit" value="Buscar">
		</p>
	</form>
</div>
</body>
</html>