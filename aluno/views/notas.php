<div class="container">
	<h1>Notas</h1>
	<hr>

	<div class="card">
		<div class="card-header">
			Coordenador:
		</div>

		<div class="card-body">
			<?php if (!empty($notas['nota_coordenador'])) {
				?>
					<h3>Nota: <?php echo $notas['nota_coordenador']; ?></h3>
				<?php
			} else {
				?>
					<div class="alert alert-warning">Ainda não avaliado!!!</div>
				<?php
			} ?>
		</div>
	</div>

	<hr>

	<div class="card">
		<div class="card-header">
			Orientador:
		</div>

		<div class="card-body">
			<?php if (!empty($notas['nota_orientador'])) {
				?>
					<h3>Nota: <?php echo $notas['nota_orientador']; ?></h3>
				<?php
			} else {
				?>
					<div class="alert alert-warning">Ainda não avaliado!!!</div>
				<?php
			} ?>
		</div>

	</div>

	<hr>

	<div class="card">
		<div class="card-header">
			Banca avaliadora:
		</div>

		<div class="card-body">
			<?php if (!empty($notas['notas_banca'])) {
				?>
					<ul>
						<?php foreach ($notas['notas_banca'] as $nota): ?>
							<li><h5><?php echo $nota['nome_avaliador']; ?> - Nota <?php echo $nota['nota']; ?></h5></li>
						<?php endforeach; ?>
					</ul>
					<hr>
				<?php
			} else {
				?>
					<div class="alert alert-warning">Ainda não avaliado!!!</div>
				<?php
			} ?>
		</div>
	</div>

	<hr>

	<div class="card">
		<div class="card-header">
			Nota final: 
		</div>

		<div class="card-body">
			<h5><?php echo $notas['total']; ?></h5>
		</div>
	</div>
</div>