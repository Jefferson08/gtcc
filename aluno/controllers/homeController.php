<?php 
	class homeController extends controller{

		public function index(){

			echo "Index";

			if (isset($_SESSION['aLogin']) && !empty($_SESSION['aLogin'])) {
				header('Location: '.BASE_URL.'etapas');
			} else {
				header('Location: '.BASE_URL.'login');
			}

		}

	}
 ?>