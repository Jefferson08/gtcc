<?php 
	class etapasController extends controller{

		public function index(){

			

			$this->loadTemplate('etapas'); //Carrega o template (diretrizes) e passa o nome da view a ser carregada e os dados

		}

		public function enviar(){

			$this->loadTemplate('enviar');
		}

	}
 ?>