<?php 
	class trabalhosController extends controller{

		public function index(){

			if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) { //Verifica se o usuário está logado
				$dados = array();

				$c = new Coordenador();

				$trabalhos = $c->getTrabalhos();

				$dados['trabalhos'] = $trabalhos;

				$this->loadTemplate('trabalhos', $dados);
			} else {
				header('Location: '.BASE_URL.'login');
				exit;
			}
		}

		public function etapas($id_trabalho = array()){

			if (empty($id_trabalho)) {
				header('Location: '.BASE_URL.'trabalhos');
				exit;
			} else {
				if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) { //Verifica se o usuario está logado
					$dados = array();

					$c = new Coordenador();

					$dados['eventos'] = $c->getEtapas($id_trabalho);

					$this->loadTemplate('etapas', $dados);
				} else {
					header('Location: '.BASE_URL.'login');
					exit;
				}
			}
			
		}

		public function avaliarTrabalho($id_trabalho = array()){

			if (empty($id_trabalho)) {
				header('Location: '.BASE_URL.'trabalhos');
				exit;
			} else {
				if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) { //Verifica se o usuario está logado
					$dados = array();

					$c = new Coordenador();

					if ($c->checkAvaliacao($id_trabalho)) {
						header('Location: '.BASE_URL.'trabalhos');
						exit;
					} else {
						$dados['avaliado'] = $c->checkAvaliacao($id_trabalho);

						$dados['id_trabalho'] = $id_trabalho;

						$dados['titulo_trabalho'] = $c->getTitulo($id_trabalho);

						$dados['status'] = 0;

						$this->loadTemplate('avaliacao', $dados);
					}
				} else {
					header('Location: '.BASE_URL.'login');
					exit;
				}
			}
		}

		public function enviar($id_trabalho = array()){

			if (empty($id_trabalho)) {
				header('Location: '.BASE_URL.'trabalhos');
			} else {
				if (isset($_POST['nota'])) { //Verifica se o formulário foi enviado
					$c = new Coordenador();

					if ($c->checkAvaliacao($id_trabalho)) {
						header('Location: '.BASE_URL.'trabalhos');
						exit;
					} else {
						if (isset($_POST['nota']) && !empty($_POST['nota'])) {
						
							$nota = $_POST['nota'];

							echo "NOTA: ".$nota;
							
							$c->avaliar($id_trabalho, $nota);

							header('Location: '.BASE_URL.'trabalhos');
							exit;
						} else {
							if ($c->checkAvaliacao($id_trabalho)) {
								header('Location: '.BASE_URL.'trabalhos');
								exit;
							} else {
								$dados['avaliado'] = $c->checkAvaliacao($id_trabalho);

								$dados['id_trabalho'] = $id_trabalho;

								$dados['titulo_trabalho'] = $c->getTitulo($id_trabalho);

								$dados['status'] = 1;

								$this->loadTemplate('avaliacao', $dados);
							}
						}
					}
				} else{
					header('Location: '.BASE_URL.'trabalhos/avaliarTrabalho');
					exit;
				}	
			}
		}
	}
 ?>