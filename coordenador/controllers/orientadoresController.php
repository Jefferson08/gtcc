<?php 
	class orientadoresController extends controller{

		public function index(){

			

			$this->loadTemplate('orientadores'); //Carrega o template (diretrizes) e passa o nome da view a ser carregada e os dados

		}

		public function orientacoes(){

			$this->loadTemplate('orientacoes');
		}

	}
 ?>