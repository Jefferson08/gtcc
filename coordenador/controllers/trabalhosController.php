<?php 
	class trabalhosController extends controller{

		public function index(){

			$dados = array();

			$c = new Coordenador();

			$trabalhos = $c->getTrabalhos();

			$dados['trabalhos'] = $trabalhos;

			$this->loadTemplate('trabalhos', $dados);
		}

		public function etapas($id_trabalho = array()){

			$dados = array();

			$c = new Coordenador();

			$dados['eventos'] = $c->getEtapas($id_trabalho);

			$this->loadTemplate('etapas', $dados);
		}

		public function avaliarTrabalho($id_trabalho = array()){

			$dados = array();

			$c = new Coordenador();

			if ($c->checkAvaliacao($id_trabalho)) {
				header('Location: '.BASE_URL.'trabalhos');
			} else {
				$dados['avaliado'] = $c->checkAvaliacao($id_trabalho);

				$dados['id_trabalho'] = $id_trabalho;

				$dados['titulo_trabalho'] = $c->getTitulo($id_trabalho);

				$this->loadTemplate('avaliacao', $dados);
			}
		}

		public function enviar($id_trabalho = array()){

			$c = new Coordenador();

			if ($c->checkAvaliacao($id_trabalho)) {
				header('Location: '.BASE_URL.'trabalhos');
			} else {
				if (isset($_POST['nota']) && !empty($_POST['nota'])) {
				
					$nota = $_POST['nota'];

					echo "NOTA: ".$nota;
					
					$c->avaliar($id_trabalho, $nota);

					header('Location: '.BASE_URL.'trabalhos');
				}
			}

		}
	}
 ?>