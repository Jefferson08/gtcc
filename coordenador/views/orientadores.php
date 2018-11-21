
<div class="container">
	<div class="row">
		
		<div class="col-sm-12">
    		<h3>Cadastrar Orientadores:</h3>
			<hr>

    		<form method="POST">
				<div class="form-group">
					<label for="nome" class="h4">Nome:</label>
					<input id="nome" type="text" name="nome" class="form-control" placeholder="nome">
				</div>

				<div class="form-group">
					<label for="senha" class="h4">Email:</label>
					<input id="email" type="email" name="email" class="form-control" placeholder="email">
				</div>

				<div class="form-group">
					<input class="btn btn-success" type="submit" value="Enviar acesso">
				</div>
			</form>

			<hr>


			<h3>Orientadores Cadastrados:</h3>
    		<hr>

    		<table class="table table-sm table-hover table-striped table-bordered text-center">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nome</th>
						<th>Email</th>
					</tr>
				</thead>

				<tbody>
					<tr>
						<th scope="row">1</th>
						<td>Fulano</td>
						<td>teste@teste.com.br</td>
					</tr>

					<tr>
						<th scope="row">2</th>
						<td>Ciclano</td>
						<td>teste@teste.com.br</td>
					</tr>

					<tr>
						<th scope="row">3</th>
						<td>Beltrano</td>
						<td>teste@teste.com.br</td>
					</tr>

					<tr>
						<th scope="row">4</th>
						<td>Rodinei</td>
						<td>teste@teste.com.br</td>
					</tr>
				</tbody>	
			</table>



    	</div>



	</div>
</div>