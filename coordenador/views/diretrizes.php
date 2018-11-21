<div class="container">

<hr>

<h1>Diretrizes dos trabalhos</h1>
<hr>

<!--Primeira Linha -->

<div class="row">

	<div class="col-sm-12">
		<form>

    		<div class="form-group">
    			<label for="qtdMax" class="h2">Quantidade máxima de autores:</label><br><br>
    			<input type="number" class="form-control">
    		</div>

    		<label class="h2">Temas:</label>
    		<hr>

    		<table class="table table-sm table-hover table-striped table-bordered text-center" id="temas">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Tema</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<tr>
						<th scope="row">1</th>
						<td>Desenvolvimento Web</td>
						<td><button class="btn btn-danger" onclick="remove(this)">Excluir</button></td>
					</tr>

					<tr>
						<th scope="row">2</th>
						<td>Tecnologia na Educação</td>
						<td><button class="btn btn-danger" onclick="remove(this)">Excluir</button></td>
					</tr>

					<tr>
						<th scope="row">3</th>
						<td>Inteligência Artificial</td>
						<td><button class="btn btn-danger" onclick="remove(this)">Excluir</button></td>
					</tr>
				</tbody>	
			</table>

			<label for="tema" class="h5">Tema:</label>
			<input type="text" id="tema" class="form-control"><br>

			<button class="btn btn-primary" id="adicionarTema">Adicionar</button><br>
			<hr>

    		

    		<hr>

    		<button class="btn btn-success">Salvar</button>

    		
		</form>
	</div>
</div>
          
                
</div>