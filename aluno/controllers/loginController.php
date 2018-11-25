<?php 
	
	class loginController extends controller{

		public function index(){
			$status['status'] = 0;

			if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) {
				header("Location: ".BASE_URL);
			} else {
				echo "Entrou aqui";
				$this->loadTemplate('login', $status);
			}

		}

		public function entrar(){
			$status['status'] = 0;

			//status 0 - Não exibe alert 
			//status 1 - alert Preencha os campos email e senha
			//status 2 - alert Email e/ou senha inválidos


			$aluno = new Alunos();

			if (isset($_POST['ra'])) {

				if (!empty($_POST['ra']) && !empty($_POST['senha'])) {
					$ra = addslashes($_POST['ra']);
					$senha = $_POST['senha'];

					if ($aluno->login($ra, $senha)) { //Verifica o login
						header("Location: ".BASE_URL);
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