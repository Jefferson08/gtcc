<div class="container">

<hr>

<h1>Diretrizes dos trabalhos</h1>
<hr>

<?php 
	if ($status == 1) {
		?>
			<div class="alert alert-warning">Insira pelo menos um tema!!!</div>
		<?php
	} else if($status == 2){
		?>
			<div class="alert alert-success">Diretrizes Salvas!!!</div>
		<?php
	}


 ?>

<div class="row">

	<div class="col-sm-12">
		<form method="POST" action="<?php echo BASE_URL; ?>diretrizes/cadastrar/">

    		<div class="form-group">
    			<label for="qtdMax" class="h2">Quantidade máxima de autores:</label><br><br>
    			<input type="number" name="qtdMax" class="form-control" value="<?php echo $qtdMax; ?>">
    		</div>

    		<label class="h2">Temas:</label>
    		<hr>

    		<table class="table table-sm table-hover table-striped table-bordered text-center" id="temas">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Tema</th>
						<th>Ações</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($temas as $tema):
						?>
							<tr>
								<th scope="row"><?php echo $tema['id']; ?></th>
								<td><?php echo $tema['tema']; ?></td>
								<td><button class="btn btn-danger" onclick="excluirTema(<?php echo $tema['id']; ?>, this);">Excluir</button></td>
							</tr>
						<?php

					endforeach;
					 ?>
				</tbody>	
			</table>

			<label for="tema" class="h5">Tema:</label>
			<input type="text" id="tema" class="form-control"><br>

			<button class="btn btn-primary" id="addTema">Adicionar</button><br>

    		<hr>

    		<input type="submit" value="Salvar" class="btn btn-success">

    		
		</form>
	</div>
</div>
          
                
</div>