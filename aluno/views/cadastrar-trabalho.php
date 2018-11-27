
<div class="container">

	<h1>Cadastrar Trabalho</h1>

	<hr>

	<form method="POST" action="http://projeto.pc/teste.php">

		<div class="form-group">
			<label for="tema" class="h5">Tema:</label>
			<select name="tema" id="tema" class="form-control">
				<option value="0">Desenvolvimento Web</option>
				<option value="1">Tecnologia na Educação</option>
				<option value="2">Inteligência Artificial</option>
			</select>
		</div>

		<div class="form-group">
			<label for="titulo" class="h5">Título: *</label>
			<input type="text" name="titulo" id="titulo" class="form-control">
		</div>

		<div class="form-group">
			<label for="orientador" class="h5">Orientador:</label>
			<select name="orientador" id="orientador" class="form-control">
				<option value="0">Orientador1</option>
				<option value="0">Orientador2</option>
				<option value="0">Orientador3</option>
				<option value="0">Orientador4</option>
				
			</select>
		</div>

		<hr>

		<h3>Autores: (max 3)</h3>
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

			</tbody>	
		</table>

		<label for="ra" class="h5">RA:</label>
		<input type="text" class="form-control" id="ra"><br>


		<button class="btn btn-primary" id="adicionarAluno">Adicionar</button>

		<hr>

		<input type="submit" value="Salvar" class="btn btn-success">
	</form>
</div>