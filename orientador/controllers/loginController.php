<?php 
	
	class loginController extends controller{

		public function index(){
			$status['status'] = 0;

			if (isset($_SESSION['oLogin']) && !empty($_SESSION['oLogin'])) { //Verifica se o usuário está logado
				header('Location: '.BASE_URL.'trabalhos');
				exit;
			} else {
				$this->loadTemplate('login', $status);
			}

		}

		public function entrar(){ //Método que recebe o envio do formulário de login
			$status['status'] = 0;

			//status 0 - Não exibe alert 
			//status 1 - alert Preencha os campos email e senha
			//status 2 - alert Email e/ou senha inválidos


			$user = new Orientadores();

			if (isset($_POST['email'])) {

				if (!empty($_POST['email']) && !empty($_POST['senha'])) {
					$email = addslashes($_POST['email']);
					$senha = $_POST['senha'];

					if ($user->login($email, $senha)) { //Verifica o login
						header('Location: '.BASE_URL.'trabalhos');
						exit;
					} else {
						$status['status'] = 2;

						$this->loadTemplate('login', $status);
					}
				} else {
					$status['status'] = 1;

					$this->loadTemplate('login', $status);
				}
			} else {
				$status['status'] = 1;

				$this->loadTemplate('login', $status);
			}

		}
	}
 ?>