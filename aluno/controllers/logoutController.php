
<?php 
	class logoutController extends controller{

		public function index(){

			$_SESSION['aLogin'] = "";
			$_SESSION['aNome'] = "";
			header("Location: ".BASE_URL);

		}
	}
 ?>