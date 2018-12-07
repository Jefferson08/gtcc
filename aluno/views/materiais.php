
<div class="container">

	<h1>Materiais</h1>

	<hr>
	
	<?php foreach($materiais as $material): ?>
		<div class="card">
			
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
