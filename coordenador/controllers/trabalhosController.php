<?php 
	class trabalhosController extends controller{

		public function index(){

			$dados = array();

			$c = new Coordenador();

			$trabalhos = $c->getTrabalhos();

			$dados['trabalhos'] = $trabalhos;

			$this->loadTemplate('trabalhos', $dados);
		}

		public function etapas($id_trabalho = array()){

			$dados = array();

			$c = new Coordenador();

			$dados['eventos'] = $c->getEtapas($id_trabalho);

			$this->loadTemplate('etapas', $dados);
		}

		public function avaliar(){

			$this->loadTemplate('avaliacao');
		}
	}
 ?>