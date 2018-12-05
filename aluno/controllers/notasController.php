<?php 
	class notasController extends controller{

		public function index(){

			if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) {
				$this->loadTemplate('notas');
			} else {
				header('Location: '.BASE_URL.'login');
			}
		}
	}
 ?>