{include file="../cabecalho.tpl"}
{if $aviso}
<div id="resposta">
	<p>{$aviso}</p>
</div>
{/if}
{if $autorizado}
<div id="conteudo">
	{if $smarty.post.id}
	<h2>Editando autor</h2>
	{else}
	<h2>Cadastrando novo autor</h2>
	{/if}
	<form class="contato" method="POST">
		<p><label for="nome">Nome:</label><input type="text" name="nome" maxlength="30" value="{$smarty.post.nome}"></p>
		<p><label for="sobrenome">Sobrenome:</label><input type="text" name="sobrenome" maxlength="20" value="{$smarty.post.sobrenome}"></p>
		<p><label for="observacoes">Observações:</label><textarea name="observacoes">{$smarty.post.observacoes}</textarea></p>
		<input type="hidden" name="action" value="{$action}">
		<input type="hidden" name="id" value="{$smarty.post.id}">
		<p><input class="limpar" type="reset" value="Limpar"><input class="enviar" type="submit" value="{$caption}"></p>
	</form>
</div>
{/if}
</body>
</html>