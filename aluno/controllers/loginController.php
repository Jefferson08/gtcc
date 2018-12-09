<?php 
	
	class loginController extends controller{

		public function index(){
			$status['status'] = 0;

			$a = new Alunos();

			if (isset($_SESSION['aLogin']) && !empty($_SESSION['aLogin'])) {
				if ($a->checkAluno($_SESSION['aLogin'])) { //Verifica se o aluno está cadastrado em algum grupo
					header('Location: '.BASE_URL.'etapas/');
				} else {
					header('Location: '.BASE_URL.'cadastrarTrabalho'); //Se não, redireciona para cadastrarTrabalho
					exit;
				}
			} else {
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
						if ($aluno->checkAluno($_SESSION['aLogin'])) { //Verifica se o aluno está cadastrado em algum grupo
							header('Location: '.BASE_URL.'etapas/');
							exit;
						} else {
							header('Location: '.BASE_URL.'cadastrarTrabalho');
							exit;
						}
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