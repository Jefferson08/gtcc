<?php 
	class materiaisController extends controller{

		public function index(){

			if (isset($_SESSION['aLogin']) && !empty($_SESSION['aLogin'])) {
				$this->loadTemplate('materiais');
			} else {
				header('Location: '.BASE_URL.'login');
			}

		}

	}
 ?>