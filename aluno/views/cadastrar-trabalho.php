
<div class="container">

	<h1>Cadastrar Trabalho</h1>

	<hr>

	<div class="form-group">
		<label for="estado" class="h5">Tema:</label>
		<select name="estado" id="estado" class="form-control">
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
			<option value="0">Fulano</option>
			<option value="1">Ciclano</option>
			<option value="1">Beltrano</option>
			<option value="1">Rodinei</option>
		</select>
	</div>

	<hr>

	<h3>Autores: (max 3)</h3>
	<hr>

	<table class="table table-sm table-hover table-striped table-bordered text-center" id="datas">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nome</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<th scope="row">1</th>
				<td>Fulano da Silva</td>
				<td><button class="btn btn-danger" onclick="remove(this)">Excluir</button></td>
			</tr>

			<tr>
				<th scope="row">2</th>
				<td>Ciclano Pereira</td>
				<td><button class="btn btn-danger" onclick="remove(this)">Excluir</button></td>
			</tr>

			
		</tbody>	
	</table>

	<label for="RA" class="h5">RA:</label>
	<input type="text" class="form-control" id="RA"><br>


	<button class="btn btn-primary" id="adicionarData">Adicionar</button>

	<hr>

	<button class="btn btn-success">Salvar</button>
</div>