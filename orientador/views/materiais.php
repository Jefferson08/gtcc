
<div class="container">

	
	<div class="row">
		<div class="col-sm-10">
			<h1>Materiais enviados: </h1>
		</div>

		<div class="col-sm-2">
			<a href="<?php echo BASE_URL; ?>materiais/enviarMaterial/" class="btn btn-success">+ Novo Material</a>
		</div>
	</div>

	<hr>
	
	<?php foreach($materiais as $material): ?>
		<div class="card">
			<div class="card-header">
				<h5>Trabalho: <?php echo $material['titulo_trabalho']; ?></h5>
			</div>

			<div class="card-body">
				
				<h5 class="card-title"><?php echo $material['titulo']; ?></h5><hr>
				<p class="card-text"><?php echo $material['descricao']; ?></p><hr>

				<?php if (!empty($material['link'])) {
					?>
						<a href="<?php echo $material['link']; ?>" target="_blank">Clique para acessar o link</a><hr>
					<?php
				} ?>

				<?php if (!empty($material['url'])) {
					?>
						<a href="../../../materiais/<?php echo $material['url']; ?>" target="_blank" class="btn btn-secondary">Ver arquivo</a>
					<?php
				} ?>
			</div>

			<div class="card-footer text-muted">
			    Postado em <?php echo $material['data_envio']; ?>
			</div>
		</div>

		<hr>
	<?php endforeach; ?>

	
</div>
