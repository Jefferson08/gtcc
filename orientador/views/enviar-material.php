
<div class="container">
	<h1>Novo material</h1>
	<hr>

	<div class="form-group">
		<label for="trabalho">Selecione o trabalho:</label>
		<select name="trabalho" id="orientador" class="form-control">
			<option value="0">Algoritmo inteligente com redes neurais</option>
			<option value="0">Sistema de gerenciamento inteligente</option>
			
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
		<label for="arquivos">Arquivos:</label>

		<input type="file" name="arquivos" id="arquivos" class="form-coltrol-file" multiple style="width: 100%;">
	</div>
	<hr>

	<button class="btn btn-primary">Enviar</button>


</div>