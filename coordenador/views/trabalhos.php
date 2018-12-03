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

				<h5>Orientador: <a href="<?php echo BASE_URL; ?>orientadores/orientacoes/<?php echo $trabalho['id_orientador']; ?>"><?php echo $trabalho['orientador']; ?></a></h5>

				<hr>
				<a href="<?php echo BASE_URL; ?>trabalhos/etapas/" class="btn btn-primary">Visualizar etapas</a>
			</div>

		</div>

		<hr>
	<?php endforeach; ?>

	
	
</div>