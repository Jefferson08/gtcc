
<div class="container">

	<div class="row">
		<div class="col-sm-10">
			<h1>Orientações realizadas: </h1>
		</div>

		<div class="col-sm-2">
			<a href="<?php echo BASE_URL; ?>orientacoes/novaOrientacao/" class="btn btn-success">+ Nova orientação</a>
		</div>
	</div>

	<hr>

	<?php foreach($orientacoes as $orientacao): ?>
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
	<?php endforeach; ?>
	
</div>
