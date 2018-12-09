<?php 
	class orientacoesController extends controller{

		public function index(){

			if (isset($_SESSION['oLogin']) && !empty($_SESSION['oLogin'])) {
				
				$dados = array();

				$o = new Orientadores();

				$dados['orientacoes'] = $o->getOrientacoes();

				$dados['status'] = 0;

				$this->loadTemplate('orientacoes', $dados);
			} else {
				header('Location: '.BASE_URL.'login');
				exit;
			}
		}

		public function novaOrientacao(){

			if (isset($_SESSION['oLogin']) && !empty($_SESSION['oLogin'])) {
				//Status 1 - alert "preencha os campos título e descrição"

				$dados = array();

				$o = new Orientadores();

				$dados['trabalhos'] = $o->getTrabalhos($_SESSION['oLogin']);

				$dados['status'] = 0;

				$this->loadTemplate('nova-orientacao', $dados);
			} else {
				header('Location: '.BASE_URL.'login');
			}
		}

		public function enviar(){

			$dados = array();

			if (isset($_POST['trabalho'])) {

				$o = new Orientadores();
				$dados['trabalhos'] = $o->getTrabalhos($_SESSION['oLogin']);

				if (!empty($_POST['titulo']) && !empty($_POST['descricao'])) {
					
					$id_trabalho = $_POST['trabalho'];
					$titulo = $_POST['titulo'];
					$descricao = $_POST['descricao'];

					$o->cadastrarOrientacao($id_trabalho, $titulo, $descricao);

					header('Location: '.BASE_URL.'orientacoes');
					exit;

				} else {
					$dados['status'] = 1;
					$this->loadTemplate('nova-orientacao', $dados);
				}
			} else {
				header('Location: '.BASE_URL.'orientacoes/novaOrientacao');
				exit;
			}
		}
	}
 ?>