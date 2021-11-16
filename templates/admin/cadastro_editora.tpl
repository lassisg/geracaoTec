{include file="../cabecalho.tpl"}
{if $aviso}
<div id="resposta">
	<p>{$aviso}</p>
</div>
{/if}
{if $autorizado}
<div id="conteudo">
	{if $smarty.get.id}
	<h2>Editando editora</h2>
	{else}
	<h2>Cadastrando nova editora</h2>
	{/if}
	<form class="contato" method="GET">
		<p><label for="nome">Nome:</label><input type="text" name="nome" maxlength="50" value="{$smarty.get.nome}"></p>
		<input type="hidden" name="id" value="{$smarty.get.id}">
		<p><input class="limpar" type="reset" value="Limpar"><input class="enviar" type="submit" value="{$caption}"></p>
	</form>
</div>
{/if}
</body>
</html>