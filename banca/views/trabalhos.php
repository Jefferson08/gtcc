<div class="container">

	<h1>Trabalhos</h1>
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

				<h5>Orientador: <?php echo $trabalho['orientador']; ?></h5>

				<hr>

				<?php if ($trabalho['avaliado'] == true) {
					?>
						<a href="../../../trabalhos/<?php echo $trabalho['ultimaEtapa']['url']; ?>" target="_blank" class="btn btn-secondary">Visualizar</a>
						<button class="btn btn-success">Avaliado</button>
					<?php
				} else if ($trabalho['finalizado'] == true) {
					?>
						<a href="../../../trabalhos/<?php echo $trabalho['ultimaEtapa']['url']; ?>" target="_blank" class="btn btn-secondary">Visualizar</a>

						<a href="<?php echo BASE_URL; ?>trabalhos/avaliarTrabalho/<?php echo $trabalho['id']; ?>" class="btn btn-outline-dark">Avaliar</a>
					<?php
				} else {
					?>
						<button class="btn btn-danger">Ainda não finalizado</button>
					<?php
				} ?>
			</div>

		</div>

		<hr>
	<?php endforeach; ?>

	
	
</div>