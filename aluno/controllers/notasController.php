<?php 
	class notasController extends controller{

		public function index(){

			if (isset($_SESSION['aLogin']) && !empty($_SESSION['aLogin'])) {
				$this->loadTemplate('notas');
			} else {
				header('Location: '.BASE_URL.'login');
			}
		}
	}
 ?>