<?php 
	class homeController extends controller{

		public function index(){


			if (isset($_SESSION['oLogin']) && !empty($_SESSION['oLogin'])) {
				header('Location: '.BASE_URL);
			
			} else {
				header('Location: '.BASE_URL.'login');
			}

			

		}

	}
 ?>