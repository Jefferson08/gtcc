
<div class="container">

	<h1>Orientações realizadas por <?php echo $nome_orientador; ?> </h1>

	<hr>

	<?php if (!empty($orientacoes)) {
		foreach($orientacoes as $orientacao): ?>
			<div class="card">
				<div class="card-header">
					<h5>Trabalho: <?php echo $orientacao['titulo_trabalho']; ?></h5>
				</div>
				<div class="card-body">
					
					<h5 class="card-title"><?php echo $orientacao['titulo']; ?></h5><hr>
					<p class="card-text"><?php echo $orientacao['descricao']; ?></p>
			
				</div>

				<div class="card-footer text-muted">
				    Realizada em: <?php echo $orientacao['data']; ?>
				</div>
			</div>

			<hr>
		<?php endforeach;
	} else {
		?>
			<div class="alert alert-warning"><?php echo $nome_orientador; ?> ainda não realizou nenhuma orientação!!!</div>
		<?php
	} ?>
	
</div>
