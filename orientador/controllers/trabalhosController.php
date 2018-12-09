<?php 
	class trabalhosController extends controller{

		public function index($id_orientador = array()){

			$o = new Orientadores();

			if (isset($_SESSION['oLogin']) && !empty($_SESSION['oLogin'])) {
				$id_orientador = $_SESSION['oLogin'];
				
				$dados = array();

				$dados['trabalhos'] = $o->getTrabalhos($id_orientador);

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
				if (isset($_SESSION['oLogin']) && !empty($_SESSION['oLogin'])) {
					$dados = array();

					$o = new Orientadores();

					$dados['eventos'] = $o->getEtapas($id_trabalho);

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
				$dados = array();

				$o = new Orientadores();

				if (isset($_SESSION['oLogin']) && !empty($_SESSION['oLogin'])) {
					
					if ($o->checkAvaliacao($id_trabalho)) { //Se o trabalho já foi avaliado redireciona pra trabalhos
						header('Location: '.BASE_URL.'trabalhos');
						exit;
					} else {
						$dados['avaliado'] = $o->checkAvaliacao($id_trabalho);

						$dados['id_trabalho'] = $id_trabalho;

						$dados['titulo_trabalho'] = $o->getTitulo($id_trabalho);

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
				exit;
			} else {
				$o = new Orientadores();

				if (isset($_POST)) {

					if ($o->checkAvaliacao($id_trabalho)) { //Se o trabalho já foi avaliado redireciona pra trabalhos
						header('Location: '.BASE_URL.'trabalhos');
						exit;
					} else {
						if (isset($_POST['nota']) && !empty($_POST['nota'])) {
						
							$nota = $_POST['nota'];

							echo "NOTA: ".$nota;
							
							$o->avaliar($id_trabalho, $nota);

							header('Location: '.BASE_URL.'trabalhos');
							exit;
						} else {
							$dados['avaliado'] = $o->checkAvaliacao($id_trabalho);

							$dados['id_trabalho'] = $id_trabalho;

							$dados['titulo_trabalho'] = $o->getTitulo($id_trabalho);

							$dados['status'] = 1;

							$this->loadTemplate('avaliacao', $dados);
						}
					}
				} else {
					header('Location: '.BASE_URL.'trabalhos/avaliarTrabalho');
					exit;
				}
			}
		}
	}
 ?>