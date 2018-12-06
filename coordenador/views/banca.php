
<div class="container">
	<div class="row">
		
		<div class="col-sm-12">
    		<h3>Cadastrar Integrantes da Banca Avaliadora:</h3>
			<hr>

			<?php 
				if ($status == 1) {
					?>
						<div class="alert alert-warning">Preencha os campos!!!</div>
					<?php
				} else if($status == 2){
					?>
						<div class="alert alert-success">Cadastrado com sucesso!!!</div>
					<?php
				}
			 ?>

    		<form method="POST" action="<?php echo BASE_URL; ?>banca/cadastrar/">
				<div class="form-group">
					<label for="nome" class="h4">Nome:</label>
					<input id="nome" type="text" name="nome" class="form-control">
				</div>

				<div class="form-group">
					<label for="email" class="h4">Email:</label>
					<input id="email" type="email" name="email" class="form-control">
				</div>

				<div class="form-group">
					<input class="btn btn-success" type="submit" value="Enviar acesso">
				</div>
			</form>

			<hr>


			<h3>Avaliadores Cadastrados:</h3>
    		<hr>

    		<table class="table table-sm table-hover table-striped table-bordered text-center">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nome</th>
						<th>Email</th>
						<th>Ações</th>
					</tr>
				</thead>

				<tbody>
					
					<?php foreach ($banca as $avaliador): ?>

						<tr>
							<th scope="row"><?php echo $avaliador['id']; ?></th>
							<td><?php echo $avaliador['nome']; ?></td>
							<td><?php echo $avaliador['email']; ?></td>
							<td>
								<button class="btn btn-danger" onclick="excluirAvaliador(<?php echo $avaliador['id']; ?>, this);">Excluir</button>
							</td>
						</tr>

					<?php endforeach ?>

					
				</tbody>	
			</table>



    	</div>



	</div>
</div>