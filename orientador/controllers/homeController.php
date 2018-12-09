<?php 
	class homeController extends controller{

		public function index(){

			if (isset($_SESSION['oLogin']) && !empty($_SESSION['oLogin'])) { //Verifica se o usuário está logado
				header('Location: '.BASE_URL.'trabalhos');
				exit;
			
			} else {
				header('Location: '.BASE_URL.'login');
				exit;
			}
		}

	}
 ?>