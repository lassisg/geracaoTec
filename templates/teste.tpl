{include file="cabecalho.tpl"}
{if $aviso}
<div id="resposta">
	<p>{$aviso}</p>
</div>
{/if}
{if $autorizado}
<div id="conteudo">
	<h2>testando checkdate</h2>
	<form class="contato" enctype="multipart/form-data" method="POST" action="teste.php">
		<p><label for="data_publicacao">Publicado em:</label><input type="text" name="data_publicacao" value="10/10/2011"></p>
		<p><input class="limpar" type="reset" value="Limpar"><input class="enviar" type="submit" value="Testar"></p>
	</form>
</div>
{/if}
</body>
</html>