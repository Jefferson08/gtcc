<?php 
	class homeController extends controller{

		public function index(){

			echo "Index";

			if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) {
				header('Location: '.BASE_URL.'etapas/index/'.$_SESSION['cLogin']);
			} else {
				header('Location: '.BASE_URL.'login');
			}

		}

	}
 ?>