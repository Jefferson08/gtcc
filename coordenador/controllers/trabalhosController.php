<?php 
	class trabalhosController extends controller{

		public function index(){

			$dados = array();

			$c = new Coordenador();

			$trabalhos = $c->getTrabalhos();

			$dados['trabalhos'] = $trabalhos;

			$this->loadTemplate('trabalhos', $dados);
		}

		public function etapas(){

			$this->loadTemplate('etapas');
		}

		public function avaliar(){

			$this->loadTemplate('avaliacao');
		}
	}
 ?>