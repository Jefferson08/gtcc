<?php 
	class orientacoesController extends controller{

		public function index(){

			if (isset($_SESSION['aLogin']) && !empty($_SESSION['aLogin'])) {
				$this->loadTemplate('orientacoes');
			} else {
				header('Location: '.BASE_URL.'login');
			}

		}
	}
 ?>