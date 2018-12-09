<?php 
	class homeController extends controller{

		public function index(){

			if (isset($_SESSION['aLogin']) && !empty($_SESSION['aLogin'])) {
				header('Location: '.BASE_URL.'etapas');
				exit;
			} else {
				header('Location: '.BASE_URL.'login');
				exit;
			}

		}

	}
 ?>