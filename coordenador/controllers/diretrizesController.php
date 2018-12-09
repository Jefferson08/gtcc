<?php 
	class diretrizesController extends controller{

		public function index(){

			if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) { //Verifica se o usuário está logado
				$dados = array();

				$c = new Coordenador();

				$diretrizes = $c->getDiretrizes();

				$dados['qtdMax'] = $diretrizes['qtdMax'];
				$dados['temas'] = $diretrizes['temas'];

				$dados['status'] = 0;
				
				$this->loadTemplate('diretrizes', $dados); //Carrega o template (diretrizes) e passa o nome da view a ser carregada e os dados
			} else {
				header('Location: '.BASE_URL.'login');
				exit;
			}
		}

		public function cadastrar(){

			if (isset($_POST['qtdMax'])) {
				$status['status'] = 0;
				$dados = array();

				//status 0 - Não exibe alert 
				//status 1 - alert Insira um tema!!
				//status 2 - Diretrizes Salvas!!

				$c = new Coordenador();

				$diretrizes = $c->getDiretrizes();

				$dados['temas'] = $diretrizes['temas'];
				$dados['qtdMax'] = $diretrizes['qtdMax'];

				if (!empty($dados['temas'])) { //Se já tem temas cadastrados
					
					if (isset($_POST['qtdMax'])) { //Verifica se o formulário foi enviado

						if (isset($_POST['temas']) && !empty($_POST['temas'])) { //Se foram enviados temas

							$qtdMax = $_POST['qtdMax'];
							$temas = $_POST['temas'];

							$c->cadastrarDiretrizes($qtdMax, $temas);

							$diretrizes = $c->getDiretrizes();

							$dados['qtdMax'] = $diretrizes['qtdMax'];
							$dados['temas'] = $diretrizes['temas'];

							$dados['status'] = 2;

							$this->loadTemplate('diretrizes', $dados);

						}else{ //Se não foram enviados temas, só qtdMax de autores

							$qtdMax = $_POST['qtdMax'];
							$temas = array();

							$c->cadastrarDiretrizes($qtdMax, $temas);

							$diretrizes = $c->getDiretrizes();

							$dados['qtdMax'] = $diretrizes['qtdMax'];
							$dados['temas'] = $diretrizes['temas'];

							$dados['status'] = 2;
							$this->loadTemplate('diretrizes', $dados);
						}
					
					}

				} else { //Se não houverem temas cadastrados

					if (isset($_POST['qtdMax'])) {

						if (isset($_POST['temas']) && !empty($_POST['temas'])) { //Verifica se foi enviado um tema

							$qtdMax = $_POST['qtdMax'];
							$temas = $_POST['temas'];

							$c->cadastrarDiretrizes($qtdMax, $temas);

							$diretrizes = $c->getDiretrizes();

							$dados['qtdMax'] = $diretrizes['qtdMax'];
							$dados['temas'] = $diretrizes['temas'];

							$dados['status'] = 2;

							$this->loadTemplate('diretrizes', $dados);

						}else{ //Se não foi enviado, exibe alert("Insira pelomenos 1 tema")
							$dados['status'] = 1;
							$this->loadTemplate('diretrizes', $dados);
						}
					}
				}
			} else {
				header('Location: '.BASE_URL.'diretrizes');
				exit;
			}
		}
	}
 ?>