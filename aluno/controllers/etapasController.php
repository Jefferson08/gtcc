<?php 
	class etapasController extends controller{

		public function index($id_aluno = array()){

			if (isset($_SESSION['cLogin'])) {
				$id_aluno = $_SESSION['cLogin'];
			} else {
				header('Location: '.BASE_URL.'login');
			}

			$dados = array();
			
			$a = new Alunos();

			$id_trabalho = $a->getIdTrabalho($id_aluno);

			$eventos = $a->getEtapas($id_trabalho);

			$dados['eventos'] = $eventos;

			$this->loadTemplate('etapas', $dados); //Carrega o template (diretrizes) e passa o nome da view a ser carregada e os dados

		}

		public function enviar($id_evento = array()){
			$dados = array();

			$a = new Alunos();

			$dados['evento'] = $a->getEtapa($id_evento);
			$dados['id_evento'] = $id_evento;
			$dados['status'] = 0;
			
			$this->loadTemplate('enviar', $dados);
		}

		public function salvar($id_evento = array()){
			$dados = array();

			$a = new Alunos();

			$id_trabalho = $a->getIdTrabalho($_SESSION['cLogin']);

			$dados['evento'] = $a->getEtapa($id_evento);
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

						$a->cadastrarEtapa($id_evento, $id_trabalho, $url);

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


	}
 ?>