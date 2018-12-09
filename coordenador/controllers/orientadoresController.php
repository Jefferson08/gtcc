<?php 
	class orientadoresController extends controller{

		public function index(){

			if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) { //Verifica se o usuário está logado
				$dados = array();
				$dados['status'] = 0;

				$o = new Orientadores();

				$dados['orientadores'] = $o->getOrientadores();

				$this->loadTemplate('orientadores', $dados); //Carrega o template (orientadores) e passa o nome da view a ser carregada e os dados
			} else {
				header('Location: '.BASE_URL.'login');
				exit;
			}
		}

		public function orientacoes($id_orientador = array()){

			if (empty($id_orientador)) {
				header('Location: '.BASE_URL.'orientadores');
				exit;
			} else {
				if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) { //Verifica se o usuário está logado
					$dados = array();

					$c = new Coordenador();

					$dados['orientacoes'] = $c->getOrientacoes($id_orientador);

					$dados['status'] = 0;

					$dados['nome_orientador'] = $c->getOrientador($id_orientador);

					$this->loadTemplate('orientacoes', $dados);
				} else {
					header('Location: '.BASE_URL.'login');
					exit;
				}
			}
		}

		public function cadastrar(){

			if (isset($_POST['nome'])) { //Verifica se o usuario está logado
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
			} else {
				header('Location: '.BASE_URL.'orientadores');
				exit;
			}
		}

	}
 ?>
