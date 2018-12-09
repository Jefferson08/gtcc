<div class="container">

	<h1>Trabalhos sob orientação</h1>
	<hr>
	
	<?php foreach($trabalhos as $trabalho): ?>
		<div class="card">
			<div class="card-header">
				<?php echo $trabalho['tema']; ?>
			</div>
			<div class="card-body">
				<h5 class="card-title">Título: <?php echo $trabalho['titulo']; ?></h5><hr>
				<h5>Autores:</h5>
				<p class="card-text">
					<ul>
						<?php foreach($trabalho['autores'] as $autor): ?>
							<li><?php echo $autor['nome']; ?></li>
						<?php endforeach; ?>
					</ul>
				</p>
				<hr>
				<a href="<?php echo BASE_URL; ?>trabalhos/etapas/<?php echo $trabalho['id']; ?>" class="btn btn-primary">Visualizar etapas</a>
				<?php if ($trabalho['avaliado'] == true) {
					?>
						<button class="btn btn-success">Avaliado</button>
					<?php
				} elseif ($trabalho['finalizado'] == true) {
					?>
						<a href="<?php echo BASE_URL; ?>trabalhos/avaliarTrabalho/<?php echo $trabalho['id']; ?>" class="btn btn-outline-dark">Avaliar</a>
					<?php
				} ?>
			</div>

		</div>

		<hr>
	<?php endforeach; ?>

	
	
</div>