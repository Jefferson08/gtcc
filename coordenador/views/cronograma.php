
<div class="container">
	
	<h1>Cronograma</h1>
	<hr>	

	<table class="table table-sm table-hover table-striped table-bordered text-center" id="datas">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Evento</th>
				<th>Data</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<th scope="row">1</th>
				<td>Entrega da Introdução</td>
				<td>10/09/2018</td>
				<td><button class="btn btn-danger" onclick="remove(this)">Excluir</button></td>
			</tr>

			<tr>
				<th scope="row">2</th>
				<td>Materiais e métodos</td>
				<td>15/10/2018</td>
				<td><button class="btn btn-danger" onclick="remove(this)">Excluir</button></td>
			</tr>

			
		</tbody>	
	</table>
	<hr>

	<label for="evento" class="h4">Evento:</label>
	<input type="text" class="form-control" id="evento"><br>

	<label for="data" class="h4">Data:</label>
	<input type="text" class="form-control" id="data"><br>
	<hr>

	<button class="btn btn-primary" id="adicionarData">Adicionar</button>

</div>