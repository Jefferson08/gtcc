<?php 
	class cronogramaController extends controller{

		public function index(){
			if (isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) { //Verifica se o usuário está logado
				$dados = array();

				$c = new Coordenador();

				$cronograma = $c->getCronograma();

				$dados['cronograma'] = $cronograma;

				$dados['status'] = 0;

				$this->loadTemplate('cronograma', $dados); //Carrega o template (diretrizes) e passa o nome da view a ser carregada e os dados
			} else {
				header('Location: '.BASE_URL.'login');
				exit;
			}
		}

		public function salvar(){

			if (isset($_POST['eventos'])) { //Verifica se o formulario foi enviado
				$status['status'] = 0;

				$dados = array();

				//status 0 - Não exibe alert 
				//status 1 - alert Insira um tema!!
				//status 2 - Diretrizes Salvas!!

				$c = new Coordenador();

				$cronograma = $c->getCronograma();

				$dados['cronograma'] = $cronograma;

				if (!empty($dados['cronograma'])) { //Se não estiver vazio, já tem cronogramas cadastrados
					
					if (isset($_POST['eventos'])) { //Verifica se o formulário foi enviado

						if (!empty($_POST['eventos'])) { //Se foram enviados temas

							$eventos = $_POST['eventos'];
							$datas = $_POST['datas'];

							$c->cadastrarCronograma($eventos, $datas);

							$cronograma = $c->getCronograma();

							$dados['cronograma'] = $cronograma;

							$dados['status'] = 2;

							$this->loadTemplate('cronograma', $dados);

						}else{ //Se não foram enviados cronogramas

							$cronograma = $c->getCronograma();
							
							$dados['cronograma'] = $cronograma;

							$dados['status'] = 2;

							$this->loadTemplate('cronograma', $dados);
						}
					
					}

				} else { //Se não houverem eventos cadastrados

					if ($_POST['eventos']) { //Se o formulario foi enviado

						if (!empty($_POST['eventos'])) { //Verifica se foi enviado evento

							$eventos = $_POST['eventos'];
							$datas = $_POST['datas'];

							$c->cadastrarCronograma($eventos, $datas);

							$cronograma = $c->getCronograma();

							$dados['cronograma'] = $cronograma;

							$dados['status'] = 2;

							$this->loadTemplate('cronograma', $dados);

						}else{ //Se não foi enviado, exibe alert("Insira pelo menos 1 evento")
							$dados['status'] = 1;
							$this->loadTemplate('cronograma', $dados);
						}
					}
				}
			} else {
				header('Location: '.BASE_URL.'cronograma');
				exit;
			}
		}
	}
 ?>
