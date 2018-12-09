<?php 
	class materiaisController extends controller{

		public function index(){

			if (isset($_SESSION['aLogin']) && !empty($_SESSION['aLogin'])) {
				
				$dados = array();

				$a = new Alunos();

				$dados['materiais'] = $a->getMateriais();

				$this->loadTemplate('materiais', $dados);
			} else {
				header('Location: '.BASE_URL.'login');
				exit;
			}

		}

	}
 ?>