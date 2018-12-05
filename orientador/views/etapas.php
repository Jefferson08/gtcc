


<div class="container">

	<h1>Etapas</h1>
	<hr>
	
	<?php foreach($eventos as $evento): ?>

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
						<button class="btn btn-primary" data-toggle="collapse" data-target="#comentarios">Comentários</button>
						<hr>

						<div class="card border-secondary collapse" id="comentarios">
							<div class="card-header bg-dark text-center" style="color: white;">
								Comentários:
							</div>

							<div class="card-body">
								<div class="card">
									<div class="card-header">
										Orientador 1, às 13:44:20s
									</div>

									<div class="card-body">
										<p class="card-text">
											Nessa introdução, é importante também explicar os objetivos da pesquisa e as metodologia adotadas durante o processo.
										</p>
									</div>
								</div>

								<hr>

								<div class="form-group">
									<textarea class="form-control">
										
									</textarea>
								</div>

								<button class="btn btn-primary">Enviar</button>
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