
<?php 
	class trabalhosController extends controller{

		public function index(){

			$this->loadTemplate('trabalhos');
		}


		public function etapas(){
			$this->loadTemplate('etapas');
		}
	}
 ?>