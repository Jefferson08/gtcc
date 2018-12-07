
<div class="container">
	<h1>Nova orientação</h1>
	<hr>

	<?php if ($status == 1) {
		?>
			<div class="alert alert-warning">Preencha os campos título e descrição!!!</div>
		<?php
	} ?>

	<form method="POST" action="<?php echo BASE_URL; ?>orientacoes/enviar/">
		<div class="form-group">
			<label for="trabalho">Selecione o trabalho:</label>
			<select name="trabalho" id="trabalho" class="form-control">
				<?php foreach($trabalhos as $trabalho): ?>
					<option value="<?php echo $trabalho['id']; ?>"><?php echo $trabalho['titulo']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group">
			<label for="titulo">Título</label>
			<input type="text" name="titulo" id="titulo" class="form-control">
		</div>

		<div class="form-group">
			<label for="descricao">Descrição: </label><br>
			<textarea class="form-control" name="descricao" id="descricao"></textarea>
		</div>

		<input type="submit" value="Enviar" class="btn btn-primary">
	</form>


</div>