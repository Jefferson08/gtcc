<?php 
	class trabalhosController extends controller{

		public function index(){

			if (isset($_SESSION['bLogin']) && !empty($_SESSION['bLogin'])) {
				$this->loadTemplate('trabalhos');
			} else {
				header('Location: '.BASE_URL.'login');
			}
		}

		public function avaliar(){

			$this->loadTemplate('avaliacao');
		}
	}
 ?>