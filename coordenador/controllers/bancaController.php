<?php 

	class bancaController extends controller{

		public function index(){

			$dados = array();
			$dados['status'] = 0;

			$o = new Orientadores();

			$dados['banca'] = $o->getBanca();

			$this->loadTemplate('banca', $dados); 
		}

		public function cadastrar(){

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
		}
	}

 ?>