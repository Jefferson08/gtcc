<?php 
	class orientacoesController extends controller{

		public function index(){

			$this->loadTemplate('orientacoes');
		}

		public function novaOrientacao(){

			$this->loadTemplate('nova-orientacao');
		}
	}
 ?>