{include file="../cabecalho.tpl"}
<div id="conteudo">
	{if !$autorizado}
	<h2>Login</h2>
	<form class="login" method="GET" action="login.php?acao=login">
		<p><label for="login">Usuário:</label><input type="text" name="login" maxlength="30"></p>
		<p><label for="senha">Senha:</label><input type="password" name="senha" maxlength="32"></p>
		<p><input class="limpar" type="reset" value="Cancelar"><input class="enviar" type="submit" value="Enviar"></p>
	</form>
	{/if}
</div>
</body>
</html>