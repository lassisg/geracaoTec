{include file="cabecalho.tpl"}
{if $aviso}
<div id="resposta">
	<p>{$aviso}</p>
</div>
{/if}
<div id="conteudo">
<h2>Entre em contato</h2>
<form class="contato" method="GET" action="contato.php">
	<p><label for="nome">Nome:</label><input type="text" name="nome" value="{$smarty.get.nome}"></p>
	<p><label for="email">E-mail:</label><input type="text" name="email" value="{$smarty.get.email}"></p>
	<p><label for="telefone">Telefone:</label><input type="text" name="telefone" value="{$smarty.get.telefone}"></p>
	<p><label for="mensagem">Mensagem:</label><textarea name="mensagem">{$smarty.get.mensagem}</textarea></p>
	<p><input class="limpar" type="reset" value="Limpar"><input class="enviar" type="submit" value="Enviar"></p>
</form>
</div>
</body>
</html>