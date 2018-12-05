<?php 
	class materiaisController extends controller{

		public function index(){

			if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) {
				$this->loadTemplate('materiais');
			} else {
				header('Location: '.BASE_URL.'login');
			}

		}

	}
 ?>