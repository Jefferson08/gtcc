<?php 
	class trabalhosController extends controller{

		public function index(){

			if (isset($_SESSION['bLogin']) && !empty($_SESSION['bLogin'])) {
				$dados = array();

				$a = new Avaliador();

				$trabalhos = $a->getTrabalhos();

				$dados['trabalhos'] = $trabalhos;

				$this->loadTemplate('trabalhos', $dados);
			} else {
				header('Location: '.BASE_URL.'login');
			}
		}

		public function avaliarTrabalho($id_trabalho = array()){

			$dados = array();

			$a = new Avaliador();

			if ($a->checkAvaliacao($id_trabalho)) {
				header('Location: '.BASE_URL.'trabalhos');
			} else {
				$dados['avaliado'] = $a->checkAvaliacao($id_trabalho);

				$dados['id_trabalho'] = $id_trabalho;

				$dados['titulo_trabalho'] = $a->getTitulo($id_trabalho);

				$this->loadTemplate('avaliacao', $dados);
			}
		}

		public function enviar($id_trabalho = array()){

			$a = new Avaliador();

			if ($a->checkAvaliacao($id_trabalho)) {
				header('Location: '.BASE_URL.'trabalhos');
			} else {
				if (isset($_POST['nota']) && !empty($_POST['nota'])) {
				
					$nota = $_POST['nota'];
					
					$a->avaliar($id_trabalho, $nota);

					header('Location: '.BASE_URL.'trabalhos');
				}
			}

		}
	}
 ?>