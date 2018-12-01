
<div class="container">
	
	<h1>Cronograma</h1>
	<hr>

	<?php 
		if ($status == 1) {
			?>
				<div class="alert alert-warning">Insira pelo menos 1 tema!!!</div>
			<?php
		} else if($status == 2){
			?>
				<div class="alert alert-success">Cronograma Salvo!!!</div>
			<?php
		}

	?>
	<form method="POST" action="<?php echo BASE_URL; ?>cronograma/salvar/">

		<table class="table table-sm table-hover table-striped table-bordered text-center" id="cronograma">
			<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Evento</th>
					<th>Data</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				

				<?php foreach($cronograma as $evento): ?>

					<tr>
						<th scope="row"><?php echo $evento['id']; ?></th>
						<td><?php echo $evento['evento']; ?></td>
						<td><?php echo $evento['data']; ?></td>
						<td><button class="btn btn-danger" onclick="excluirEvento(<?php echo $evento['id']; ?>, this);">Excluir</button></td>
					</tr>

				<?php endforeach; ?>
				
				
			</tbody>	
		</table>
		<hr>

	
		
		<div class="form-group">
			<label for="evento" class="h4">Evento:</label>
			<input type="text" class="form-control" name="evento" id="evento">
		</div>

		<div class="form-group">
			<label for="data" class="h4">Data:</label>
			<input type="date" class="form-control" name="data" id="data">
		</div>

		<hr>

		<button class="btn btn-primary" id="addEvento">Adicionar</button>

		<hr>

		<input type="submit" value="Salvar" class="btn btn-success" id="salvarCronograma">

	</form>

</div>