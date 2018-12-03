<?php 
	class orientadoresController extends controller{

		public function index(){

			$dados = array();
			$dados['status'] = 0;

			$o = new Orientadores();

			$dados['orientadores'] = $o->getOrientadores();

			$this->loadTemplate('orientadores', $dados); //Carrega o template (diretrizes) e passa o nome da view a ser carregada e os dados

		}

		public function orientacoes(){

			$this->loadTemplate('orientacoes');
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

					$o->cadastrarOrientador($nome, $email, $senha);

					$dados['status'] = 2;

					$dados['orientadores'] = $o->getOrientadores();

					$this->loadTemplate('orientadores', $dados);

				} else {

					$dados['status'] = 1;

					$dados['orientadores'] = $o->getOrientadores();

					$this->loadTemplate('orientadores', $dados);

				}

			}
		}

	}
 ?>