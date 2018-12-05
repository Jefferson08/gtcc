
<div class="container">
	
	<h1>Atualizar etapa</h1>
	<hr>

	<?php 
		if ($status == 1) {
			?>
				<div class="alert alert-warning">Somente arquivos PDF!!!</div><hr>
			<?php
		} else if($status == 2){
			?>
				<div class="alert alert-warning">Selecione um arquivo!!!</div><hr>
			<?php
		}
	 ?>

	<h1><?php echo $evento; ?></h1>

	<hr>

	<h4>Arquivo: (apenas formato .pdf)</h4>
	<hr>

	<form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL; ?>etapas/atualizarEtapa/<?php echo $id_etapa; ?>">
		
		<div class="form-group">
			<input type="file" name="trabalho">
		</div>
		<hr>

		<input type="submit" value="Enviar" class="btn btn-primary">
	</form>

</div>