<?php 
	class etapasController extends controller{

		public function index($id_aluno = array()){
			$a = new Alunos();

			if (isset($_SESSION['aLogin'])) {
				$id_aluno = $_SESSION['aLogin'];

				if ($a->checkAluno($_SESSION['aLogin'])) {
					$dados = array();

					$id_trabalho = $a->getIdTrabalho($id_aluno);

					$eventos = $a->getEtapas($id_trabalho);

					$dados['eventos'] = $eventos;

					$this->loadTemplate('etapas', $dados); //Carrega o template (diretrizes) e passa o nome da view a ser carregada e os dados
				} else {
					header('Location: '.BASE_URL.'cadastrarTrabalho');
				}
			} else {
				header('Location: '.BASE_URL.'login');
			}

		}

		public function enviar($id_evento = array()){
			$dados = array();

			$a = new Alunos();

			$dados['evento'] = $a->getEvento($id_evento);
			$dados['id_evento'] = $id_evento;
			$dados['status'] = 0;
			
			$this->loadTemplate('enviar', $dados);
		}

		public function enviarEtapa($id_evento = array()){ //Trata o formulário do primeiro envio da etapa
			$dados = array();

			$a = new Alunos();

			$id_trabalho = $a->getIdTrabalho($_SESSION['aLogin']);
			 
			$dados['evento'] = $a->getEvento($id_evento);
			$dados['id_evento'] = $id_evento;

			//Status 0 - Não faz nada
			//Status 1 - Alert "Somente Pdf"
			//Status 2 - Selecione um arquivo

			if (isset($_POST)) {
				if (isset($_FILES['trabalho']) && !empty($_FILES['trabalho']['name'])) {

					$trabalho = $_FILES['trabalho'];

					if (in_array($trabalho['type'], array('application/pdf'))) { //Verifica se o arquivo é um pdf
						
						$url = md5(time().rand(0, 9999)).'.pdf';
						move_uploaded_file($trabalho['tmp_name'], '../trabalhos/'.$url);

						$a->cadastrarEtapa($id_trabalho, $id_evento, $url);

						header('Location: '.BASE_URL.'etapas/index/');

					} else {
						$dados['status'] = 1;
						$this->loadTemplate('enviar', $dados);
					}
				} else {
					$dados['status'] = 2;
					$this->loadTemplate('enviar', $dados);
				}
			}

		}

		public function atualizar($id_etapa = array()){
			$dados = array();

			$a = new Alunos();

			$etapa = $a->getEtapa($id_etapa);

			$evento = $a->getEvento($etapa['id_evento']);

			$dados['evento'] = $evento;
			$dados['id_etapa'] = $id_etapa;
			$dados['status'] = 0;
			
			$this->loadTemplate('atualizar', $dados);
		}

		public function atualizarEtapa($id_etapa = array()){ //Trata o formulário da atualização da etapa
			$dados = array();

			$a = new Alunos();

			$id_trabalho = $a->getIdTrabalho($_SESSION['aLogin']);
			
			$etapa = $a->getEtapa($id_etapa);

			$evento = $a->getEvento($etapa['id_evento']);

			$dados['evento'] = $evento;
			$dados['id_etapa'] = $id_etapa;
			$dados['status'] = 0;

			//Status 0 - Não faz nada
			//Status 1 - Alert "Somente Pdf"
			//Status 2 - Selecione um arquivo

			if (isset($_POST)) {
				if (isset($_FILES['trabalho']) && !empty($_FILES['trabalho']['name'])) {

					$trabalho = $_FILES['trabalho'];

					if (in_array($trabalho['type'], array('application/pdf'))) { //Verifica se o arquivo é um pdf

						$url_antiga = $etapa['url'];
						
						$a->atualizarEtapa($trabalho, $url_antiga, $id_etapa);

						header('Location: '.BASE_URL.'etapas/index/');

					} else {
						$dados['status'] = 1;
						$this->loadTemplate('atualizar', $dados);
					}
				} else {
					$dados['status'] = 2;
					$this->loadTemplate('atualizar', $dados);
				}
			}
		}


	}
 ?>