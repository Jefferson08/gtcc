
<?php 
	class logoutController extends controller{

		public function index(){

			$_SESSION['bLogin'] = "";
			$_SESSION['bNome'] = "";
			header("Location: ".BASE_URL);

		}
	}
 ?>