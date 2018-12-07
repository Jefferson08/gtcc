<?php 
	class orientacoesController extends controller{

		public function index(){

			$dados = array();

			$o = new Orientadores();

			$dados['orientacoes'] = $o->getOrientacoes();

			$dados['status'] = 0;

			$this->loadTemplate('orientacoes', $dados);
		}

		public function novaOrientacao(){

			//Status 1 - alert "preencha os campos título e descrição"

			$dados = array();

			$o = new Orientadores();

			$dados['trabalhos'] = $o->getTrabalhos($_SESSION['oLogin']);

			$dados['status'] = 0;

			$this->loadTemplate('nova-orientacao', $dados);
		}

		public function enviar(){

			$dados = array();

			$o = new Orientadores();

			$dados['trabalhos'] = $o->getTrabalhos($_SESSION['oLogin']);

			if (isset($_POST['trabalho'])) {
				if (!empty($_POST['titulo']) && !empty($_POST['descricao'])) {
					
					$id_trabalho = $_POST['trabalho'];
					$titulo = $_POST['titulo'];
					$descricao = $_POST['descricao'];

					$o->cadastrarOrientacao($id_trabalho, $titulo, $descricao);

					header('Location: '.BASE_URL.'orientacoes');


				} else {
					$dados['status'] = 1;
					$this->loadTemplate('nova-orientacao', $dados);
				}
			}
		}
	}
 ?>