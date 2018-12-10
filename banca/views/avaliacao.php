
<div class="container">
	
	<h1>Avaliação final</h1>
	<hr>

	<h1><?php echo $titulo_trabalho; ?></h1>

	<hr>

	<?php if ($status == 1) {
		?>
			<div class="alert alert-warning">Insira uma nota !!!</div>
		<?php
	} ?>

	<form method="POST" action="<?php echo BASE_URL; ?>trabalhos/enviar/<?php echo $id_trabalho; ?>">
		<div class="form-group">
		<h4>Atribua uma nota de 0 a <?php echo number_format($nota_max, 1, ',', '.');; ?> pontos:</h4>
		<hr>
			<input type="number" name="nota" min="0" max="<?php echo $nota_max; ?>" step="0.10" class="form-control"><br>
		</div>

		<input type="submit" value="Avaliar" class="btn btn-primary">
	</form>

</div>