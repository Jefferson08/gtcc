<?php 
	class trabalhosController extends controller{

		public function index($id_orientador = array()){

			$o = new Orientadores();

			if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) {
				$id_orientador = $_SESSION['cLogin'];
				
				$dados = array();

				$dados['trabalhos'] = $o->getTrabalhos($id_orientador);

				$this->loadTemplate('trabalhos', $dados); 
				
			} else {
				header('Location: '.BASE_URL.'login');
			}
		}

		public function etapas($id_trabalho = array()){

			$dados = array();

			$o = new Orientadores();

			$dados['eventos'] = $o->getEtapas($id_trabalho);

			$this->loadTemplate('etapas', $dados);
		}

		public function avaliar(){

			$this->loadTemplate('avaliacao');
		}
	}
 ?>