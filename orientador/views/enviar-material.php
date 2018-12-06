
<div class="container">
	<h1>Novo material</h1>
	<hr>

	<?php if ($status == 1) {
		?>
			<div class="alert alert-warning">Preencha os campos título e descrição!!!</div>
		<?php
	} else if($status == 2){
		?>
			<div class="alert alert-danger">Insira um link ou envie um arquivo!!!</div>
		<?php
	} else if($status == 3){
		?>
			<div class="alert alert-info">Somente arquivos do tipo PDF!!!</div>
		<?php
	} ?>

	<form method="POST" action="<?php echo BASE_URL; ?>materiais/enviar/" enctype="multipart/form-data">
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
			<label for="descricao">Descrição:</label><br>
			<textarea class="form-control" name="descricao" id="descricao"></textarea>
		</div>

		<div class="form-group">
			<label for="link">Link: </label>
			<input type="text" name="link" id="link" class="form-control">
		</div>

		<div class="form-group">
			<label for="material">Arquivos:</label>

			<input type="file" name="material" id="material">
		</div>
		<hr>

		<input type="submit" value="Enviar" class="btn btn-primary">

		</form>


</div>