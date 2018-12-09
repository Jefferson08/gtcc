


<div class="container">

	<h1>Etapas</h1>
	<hr>

	<?php 
		/*echo "<pre>";
		print_r($eventos);
		echo "</pre>";*/
	 ?>
	
	<?php foreach($eventos as $key => $evento): ?>

		<?php if (!empty($evento['etapa'])) {
			?>
				<div class="card border-secondary">
					<div class="card-header">
						<div class="row">
							<div class="col-sm-8"><?php echo $evento['data']; ?></div>
							<div class="col-sm-4">Enviado em: <?php echo $evento['etapa']['data_envio']; ?></div>
						</div>
					</div>
					<div class="card-body">
						<h5 class="card-title"><?php echo $evento['evento']; ?></h5><hr>
						<a href="../../../trabalhos/<?php echo $evento['etapa']['url']; ?>" target="_blank" class="btn btn-secondary">Visualizar</a>
						<button class="btn btn-primary" data-toggle="collapse" data-target="<?php echo("#comentarios".$key); ?>">Comentários</button>
						<hr>

						<div class="card border-secondary collapse" id="<?php echo("comentarios".$key); ?>">
							<div class="card-header bg-dark text-center" style="color: white;">
								Comentários:
							</div>

							<div class="card-body">
								<div>
									<?php foreach ($evento['comentarios'] as $comentario): ?>
										<div class="card">
											<div class="card-header">
												<?php echo $comentario['nome']; ?>, em <?php echo $comentario['data_envio']; ?>
											</div>

											<div class="card-body">
												<p class="card-text">
													<?php echo $comentario['comentario']; ?>
												</p>
											</div>
										</div>

										<hr>
									<?php endforeach; ?>
								</div>

								<textarea class="form-control"></textarea><br>

								<button class="btn btn-primary" onclick="adicionarComentario(<?php echo $evento['etapa']['id_trabalho']; ?>, <?php echo $evento['id']; ?>, this);">Enviar</button>
							</div>
						</div>

						
					</div>

					<div class="card-footer">
						Última atualização em <?php echo $evento['etapa']['ultima_atualizacao']; ?>
					</div>
				</div>

				<hr>
			<?php
		} else {
			?>
				<div class="card border-secondary">
					<div class="card-header"><?php echo $evento['data']; ?></div>
					<div class="card-body">
						<h5 class="card-title"><?php echo $evento['evento']; ?></h5><hr>
						<div class="alert alert-warning">Ainda não enviado!!!</div>
					</div>
				</div>

				<hr>
			<?php
		} ?>

	<?php endforeach; ?>
</div>