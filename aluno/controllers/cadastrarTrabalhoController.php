<?php 
	class cadastrarTrabalhoController extends controller{

		public function index(){

			$dados = array();

			$a = new Alunos();

			$dados['aluno'] = array("id" => $_SESSION['aLogin'], "nome" => $_SESSION['aNome']); 
			$dados['temas'] = $a->getTemas();
			$dados['orientadores'] = $a->getOrientadores();
			$dados['qtdMax'] = $a->getQtdMax();

			$dados['status'] = 0;

			//VERIFICAR SE O ALUNO JÁ FOI INCLUIDO EM ALGUM GRUPO

			$this->loadTemplate('cadastrar-trabalho', $dados); //Carrega a view (cadastrar-trabalho)

		}

		public function salvar(){

			//Status 0 - Não faz nada
			//Status 1 - Prencha os campos!!

			$dados = array();

			$a = new Alunos();

			$dados['aluno'] = array("id" => $_SESSION['aLogin'], "nome" => $_SESSION['aNome']); 
			$dados['temas'] = $a->getTemas();
			$dados['orientadores'] = $a->getOrientadores();
			$dados['qtdMax'] = $a->getQtdMax();

			if (isset($_POST['titulo'])) {
				
				if (!empty($_POST['titulo'])) {
					
					$id_tema = $_POST['tema'];
					$titulo = $_POST['titulo'];
					$id_orientador = $_POST['orientador'];
					$autores = $_POST['autores'];

					$a->cadastrarTrabalho($id_tema, $titulo, $id_orientador, $autores);

					header('Location: '.BASE_URL.'etapas');

				}else {
					$dados['status'] = 1; //Exibe alert "Insira um título"

					$this->loadTemplate('cadastrar-trabalho', $dados);
				}
			}
		}

		

	}
 ?>