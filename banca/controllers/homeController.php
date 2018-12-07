<?php 
	class homeController extends controller{

		public function index(){

			if (isset($_SESSION['bLogin']) && !empty($_SESSION['bLogin'])) {
				header('Location: '.BASE_URL.'trabalhos');
			} else {
				header('Location: '.BASE_URL.'login');
			}

		}

	}
 ?>