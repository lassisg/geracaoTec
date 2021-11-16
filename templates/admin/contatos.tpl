{include file="../cabecalho.tpl"}
{if $autorizado}
<div id="conteudo">
	<h2>Contatos</h2>
	<table>
	<tr>
		<th width="50">Nome</th>
		<th width="50">Email</th>
		<th width="20">Telefone</th>
		<th>Mensagem</th>
		<th width="7%"> </th>
	</tr>
	{foreach item=contato from=$contatos}
	<tr>
		<td>{$contato.nome}</td>
		<td><a href="mailto:{$contato.email}?Subject=Re:Contato">{$contato.email}</a></td>
		<td>{$contato.telefone}</td>
		<td>{$contato.mensagem}</td>
		<td style="padding-left: 15px;"><a href="javascript:confirmDelete('contatos.php?delete={$contato.id}')"><img height="18px" src="../images/delete.png" border="0"></a></td>
	</tr>
	{/foreach}
</table>
</div>
{/if}
</body>
</html>