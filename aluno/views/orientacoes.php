
<div class="container">

	<h1>Orientações</h1>

	<hr>

	<?php foreach($orientacoes as $orientacao): ?>
		<div class="card">
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
