<?php 
	class homeController extends controller{

		public function index(){

			

			$this->loadTemplate('home', $dados); //Carrega o template (Topo) e passa o nome da view a ser carregada e os dados

		}

	}
 ?>