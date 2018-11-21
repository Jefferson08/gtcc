
<?php 
	class logoutController extends controller{

		public function index(){

			session_unset($_SESSION['cLogin']);
			header("Location: ".BASE_URL);

		}
	}
 ?>