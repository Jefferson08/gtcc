

<div class="container">

	<h1>Etapas</h1>
	<hr>

	<?php 
		/*foreach ($eventos as $evento) {
			echo "<pre>";
			print_r($evento);
			echo "</pre>";
		}*/
	 ?>

	<?php foreach($eventos as $evento): ?>

		<?php if (empty($evento['etapa'])) {
			?>
				<div class="card">
					<div class="card-header">
						<?php echo $evento['data']; ?>
					</div>
					<div class="card-body">
						<h5 class="card-title"><?php echo $evento['evento']; ?></h5><hr>
						<a href="<?php echo BASE_URL; ?>etapas/enviar/<?php echo $evento['id']; ?>" class="btn btn-primary">Enviar</a>
					</div>
				</div>

				<hr>
			<?php
		} else {
			?>
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-sm-8"><?php echo $evento['data']; ?></div>
							<div class="col-sm-4">Enviado em: <?php echo $evento['etapa']['data_envio']; ?></div>
						</div>
					</div>
					<div class="card-body">
						<h5 class="card-title"><?php echo $evento['evento']; ?></h5><hr>
						<a href="../../../trabalhos/<?php echo $evento['etapa']['url']; ?>" target="_blank" class="btn btn-secondary">Visualizar</a>
						<a href="<?php echo BASE_URL; ?>etapas/atualizar/<?php echo $evento['etapa']['id']; ?>" class="btn btn-success">Atualizar</a>
					</div>

					<div class="card-footer">
						Última atualização em <?php echo $evento['etapa']['ultima_atualizacao']; ?>
					</div>
				</div>

				<hr>
			<?php
		} ?>

	<?php endforeach; ?>
	
	
</div>