
<div class="container">

	<h1>Cadastrar Trabalho</h1>

	<hr>

	<?php 

		if($status == 1){
			?>
				<div class="alert alert-warning">Insira um título!!!</div>
			<?php
		}

	 ?>

	<form method="POST" action="<?php echo BASE_URL; ?>cadastrarTrabalho/salvar/">

		<div class="form-group">
			<label for="tema" class="h5">Tema:</label>
			<select name="tema" id="tema" class="form-control">
				<?php foreach($temas as $tema): ?>
					<option value="<?php echo $tema['id']; ?>"><?php echo $tema['tema'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group">
			<label for="titulo" class="h5">Título: *</label>
			<input type="text" name="titulo" id="titulo" class="form-control">
		</div>

		<div class="form-group">
			<label for="orientador" class="h5">Orientador:</label>
			<select name="orientador" id="orientador" class="form-control">
				<?php foreach ($orientadores as $orientador): ?>
					<option value="<?php echo $orientador['id']; ?>"><?php echo $orientador['nome']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<hr>

		<h3>Autores: (Máximo <?php echo $qtdMax; ?> autores!)</h3>
		<hr>

		<table class="table table-sm table-hover table-striped table-bordered text-center" id="alunos">
			<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Nome</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<th scope="row"><?php echo $aluno['id']; ?></th>
					<td><?php echo $aluno['nome']; ?></td>
					<td></td>
					<input type="hidden" name="autores[]" value="<?php echo $aluno['id']; ?>">
				</tr>
			</tbody>	
		</table>

		<label for="ra" class="h5">RA:</label>
		<input type="text" class="form-control" id="ra"><br>


		<button class="btn btn-primary" id="adicionarAluno">Adicionar</button>

		<hr>

		<input type="submit" value="Salvar" class="btn btn-success">
	</form>
</div>