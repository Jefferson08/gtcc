<?php 
	class homeController extends controller{

		public function index(){


			if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) {
				header('Location: '.BASE_URL);
			
			} else {
				header('Location: '.BASE_URL.'login');
			}

			

		}

	}
 ?>