<?php include("configuracao.php"); ?>
<script type="text/javascript">
	function confirmDelete(delUrl) {
		if (confirm("Deseja mesmo apagar este registro?")) {
			document.location = delUrl;
		}
	}
</script>