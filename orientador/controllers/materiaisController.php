<?php 
	class materiaisController extends controller{

		public function index(){

			$this->loadTemplate('materiais');
		}

		public function enviarMaterial(){

			$this->loadTemplate('enviar-material');
		}
	}
 ?>