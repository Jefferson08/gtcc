<?php 
	class materiaisController extends controller{

		public function index(){
			if (isset($_SESSION['oLogin']) && !empty($_SESSION['oLogin'])) {
				$dados = array();

				$o = new Orientadores();

				$dados['materiais'] = $o->getMateriais();

				$dados['status'] = 0;

				$this->loadTemplate('materiais', $dados);
				
			} else {
				header('Location: '.BASE_URL.'login');
				exit;
			}
		}

		public function enviarMaterial(){

			//Status 1 - alert "preencha os campos título e descrição"
			//Status 2 - alert "Insira um link ou envie um arquivo"
			//Status 3 - alert "Somente arquivos pdf"

			$dados = array();

			$o = new Orientadores();

			$dados['trabalhos'] = $o->getTrabalhos($_SESSION['oLogin']);

			$dados['status'] = 0;

			$this->loadTemplate('enviar-material', $dados);
			
		}

		public function enviar(){

			if (isset($_POST['trabalho'])) {
				$dados = array();

				$o = new Orientadores();

				$dados['trabalhos'] = $o->getTrabalhos($_SESSION['oLogin']);

				if (!empty($_POST['titulo']) && !empty($_POST['descricao'])) {

					if ((isset($_FILES['material']) && !empty($_FILES['material']['name'])) || !empty($_POST['link'])) { //Verifica se enviou um arquivo ou um link
						
						if ((isset($_FILES['material']) && !empty($_FILES['material']['name'])) && !empty($_POST['link'])) { //Se enviou os dois

							$id_trabalho = $_POST['trabalho'];
							$titulo = $_POST['titulo'];
							$descricao = $_POST['descricao'];
							$link = $_POST['link'];
							$material = $_FILES['material'];

							if (in_array($material['type'], array('application/pdf'))) { //Verifica se o arquivo é um pdf
						
								$o->cadastrarMaterial($id_trabalho, $titulo, $descricao, $link, $material);

								header('Location: '.BASE_URL.'materiais');
								exit;

							} else {
								$dados['status'] = 3;
								$this->loadTemplate('enviar-material', $dados);
							}

						} else if((isset($_FILES['material']) && !empty($_FILES['material']['name'])) && empty($_POST['link'])) { //Se enviou só o arquivo

							$id_trabalho = $_POST['trabalho'];
							$titulo = $_POST['titulo'];
							$descricao = $_POST['descricao'];
							$link = array();
							$material = $_FILES['material'];

							if (in_array($material['type'], array('application/pdf'))) { //Verifica se o arquivo é um pdf
						
								$o->cadastrarMaterial($id_trabalho, $titulo, $descricao, $link, $material);
								header('Location: '.BASE_URL.'materiais');
								exit;

							} else {
								$dados['status'] = 3;
								$this->loadTemplate('enviar-material', $dados);
							}	

						} else { //Enviou só o link
							$id_trabalho = $_POST['trabalho'];
							$titulo = $_POST['titulo'];
							$descricao = $_POST['descricao'];
							$link = $_POST['link'];
							$material = array();

							$o->cadastrarMaterial($id_trabalho, $titulo, $descricao, $link, $material);
							header('Location: '.BASE_URL.'materiais');
							exit;

						}


					} else {
						$dados['status'] = 2;
						$this->loadTemplate('enviar-material', $dados);	
					}

				} else {
					$dados['status'] = 1;
					$this->loadTemplate('enviar-material', $dados);
				}
			} else {
				header('Location: '.BASE_URL.'materiais');
				exit;
			}
		}
	}
 ?>