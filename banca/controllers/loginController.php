<?php 
	
	class loginController extends controller{

		public function index(){
			$status['status'] = 0;

			if (isset($_SESSION['bLogin']) && !empty($_SESSION['bLogin'])) {
				header('Location: '.BASE_URL.'trabalhos');
			} else {
				$this->loadTemplate('login', $status);
			}

		}

		public function entrar(){
			$status['status'] = 0;

			//status 0 - Não exibe alert 
			//status 1 - alert Preencha os campos email e senha
			//status 2 - alert Email e/ou senha inválidos


			$user = new Avaliador();

			if (isset($_POST['email'])) {

				if (!empty($_POST['email']) && !empty($_POST['senha'])) {
					$email = addslashes($_POST['email']);
					$senha = $_POST['senha'];

					if ($user->login($email, $senha)) { //Verifica o login
						header('Location: '.BASE_URL.'trabalhos');
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