<?php 
	class orientacoesController extends controller{

		public function index(){

			if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) {
				$this->loadTemplate('orientacoes');
			} else {
				header('Location: '.BASE_URL.'login');
			}

		}
	}
 ?>