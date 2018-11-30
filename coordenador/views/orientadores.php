
<div class="container">
	<div class="row">
		
		<div class="col-sm-12">
    		<h3>Cadastrar Orientadores:</h3>
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

    		<form method="POST" action="<?php echo BASE_URL; ?>orientadores/cadastrar/">
				<div class="form-group">
					<label for="nome" class="h4">Nome:</label>
					<input id="nome" type="text" name="nome" class="form-control">
				</div>

				<div class="form-group">
					<label for="senha" class="h4">Email:</label>
					<input id="email" type="email" name="email" class="form-control">
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
						<th>Ações</th>
					</tr>
				</thead>

				<tbody>
					
					<?php foreach ($orientadores as $orientador): ?>

						<tr>
							<th scope="row"><?php echo $orientador['id']; ?></th>
							<td><?php echo $orientador['nome']; ?></td>
							<td><?php echo $orientador['email']; ?></td>
							<td>
								<a href="<?php echo BASE_URL; ?>orientadores/orientacoes/<?php echo $orientador['id']; ?>" class="btn btn-primary">Ver orientações</a>
								<button class="btn btn-danger" onclick="excluirOrientador(<?php echo $orientador['id']; ?>, this);">Excluir</button>
							</td>
						</tr>

					<?php endforeach ?>

					
				</tbody>	
			</table>



    	</div>



	</div>
</div>