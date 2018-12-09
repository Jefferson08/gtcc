<?php 
	class orientacoesController extends controller{

		public function index(){

			if (isset($_SESSION['aLogin']) && !empty($_SESSION['aLogin'])) {
				
				$dados = array();

				$a = new Alunos();

				$dados['orientacoes'] = $a->getOrientacoes();

				$this->loadTemplate('orientacoes', $dados);

			} else {
				header('Location: '.BASE_URL.'login');
				exit;
			}

		}
	}
 ?>