<?php 

	class bancaController extends controller{

		public function index(){

			if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) { //Verifica se o usuário está logado
				$dados = array();
				$dados['status'] = 0;

				$o = new Orientadores();

				$dados['banca'] = $o->getBanca();

				$this->loadTemplate('banca', $dados); 
			} else {
				header('Location: '.BASE_URL.'login');
				exit;
			}
		}

		public function cadastrar(){

			if (isset($_POST['nome'])) {
				$dados = array();

				//Status 0 - Não faz nada
				//Status 1 - alert "Preencha os campos!!"
				//Status 2 - alert "Cadastrado com sucesso!!!"

				$o = new Orientadores();

				if (isset($_POST['nome'])) {
					
					if (!empty($_POST['nome']) && !empty($_POST['email'])) {
						
						$nome = $_POST['nome'];
						$email = $_POST['email'];
						$senha = md5('teste');

						$o->cadastrarAvaliador($nome, $email, $senha);

						$dados['status'] = 2;

						$dados['banca'] = $o->getBanca();

						$this->loadTemplate('banca', $dados);

					} else {

						$dados['status'] = 1;

						$dados['banca'] = $o->getBanca();

						$this->loadTemplate('banca', $dados);

					}

				}
			} else {
				header('Location: '.BASE_URL.'banca');
				exit;
			}
		}
	}

 ?>