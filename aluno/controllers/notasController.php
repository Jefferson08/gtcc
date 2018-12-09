<?php 
	class notasController extends controller{

		public function index(){

			if (isset($_SESSION['aLogin']) && !empty($_SESSION['aLogin'])) {

				$dados = array();

				$a = new Alunos();

				$dados['notas'] = $a->getNotas();

				$this->loadTemplate('notas', $dados);

			} else {
				header('Location: '.BASE_URL.'login');
				exit;
			}
		}
	}
 ?>