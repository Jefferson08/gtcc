
<?php 
	class logoutController extends controller{

		public function index(){

			$_SESSION['oLogin'] = "";
			$_SESSION['oNome'] = "";
			header("Location: ".BASE_URL);

		}
	}
 ?>