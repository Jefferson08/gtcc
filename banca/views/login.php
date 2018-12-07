
<hr>

<div class="container">
	<h1>Login </h1>
	<hr>

	<?php 

		if ($status == 0) {
			
		}else if ($status == 1) {
			?>
				<div class="alert alert-warning">Preencha os campos email e senha!!!</div>
			<?php
		} else if($status == 2){
			?>
				<div class="alert alert-danger">Usuário e/ou senha inválidos!!</div>
			<?php
		}
	 ?>

	<form method="POST" action="<?php echo BASE_URL; ?>login/entrar/">

		<div class="form-group">
			<label for="email">Email: *</label>
			<input type="text" name="email" id="email" class="form-control">
		</div>

		<div class="form-group">
			<label for="senha">Senha: *</label>
			<input type="password" name="senha" id="senha" class="form-control">
		</div>

		<input type="submit" value="Entrar" class="btn btn-success">
	</form>

	<hr>
</div>