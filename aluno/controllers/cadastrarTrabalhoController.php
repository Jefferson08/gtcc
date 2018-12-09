<?php 
	class cadastrarTrabalhoController extends controller{

		public function index(){

			if (isset($_SESSION['aLogin']) && !empty($_SESSION['aLogin'])) {
				$dados = array();

				$a = new Alunos();

				if ($a->checkAluno($_SESSION['aLogin'])) { //Verifica se o aluno já está em algum grupo
					header('Location: '.BASE_URL.'etapas');
				} else {
					$dados['aluno'] = array("id" => $_SESSION['aLogin'], "nome" => $_SESSION['aNome']); 
					$dados['temas'] = $a->getTemas();
					$dados['orientadores'] = $a->getOrientadores();
					$dados['qtdMax'] = $a->getQtdMax();

					$dados['status'] = 0;

					$this->loadTemplate('cadastrar-trabalho', $dados); //Carrega a view (cadastrar-trabalho)
				}
			} else {
				header('Location: '.BASE_URL.'login');
				exit;
			}

		}

		public function salvar(){
			
			if (isset($_POST['titulo'])) {

				//Status 0 - Não faz nada
				//Status 1 - Prencha os campos!!

				$dados = array();

				$a = new Alunos();

				$dados['aluno'] = array("id" => $_SESSION['aLogin'], "nome" => $_SESSION['aNome']); 
				$dados['temas'] = $a->getTemas();
				$dados['orientadores'] = $a->getOrientadores();
				$dados['qtdMax'] = $a->getQtdMax();
					
				if (!empty($_POST['titulo'])) {
					
					$id_tema = $_POST['tema'];
					$titulo = $_POST['titulo'];
					$id_orientador = $_POST['orientador'];
					$autores = $_POST['autores'];

					$a->cadastrarTrabalho($id_tema, $titulo, $id_orientador, $autores);

					header('Location: '.BASE_URL.'etapas');
					exit;

				}else {
					$dados['status'] = 1; //Exibe alert "Insira um título"

					$this->loadTemplate('cadastrar-trabalho', $dados);
				}
			} else {
				header('Location: '.BASE_URL.'cadastrarTrabalho');
				exit;
			}
		}
	}
 ?>