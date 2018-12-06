<?php 
	class ajaxController extends controller{

		public function index(){

			echo "Index do ajaxController";
			exit;
			
		}

		public function verificaAluno(){
			$dados = array();
			$a = new Alunos();

			if (isset($_POST['ra']) && !empty($_POST['ra'])) {
				$ra = $_POST['ra'];

				$dados = $a->verificaAluno($ra);

				if (!empty($dados)) {
					
					if ($dados['id'] == $_SESSION['aLogin']) { //Se ele estiver colocando o próprio RA

						$dados = array(); //Retorna $dados como um array vazio e exibe o erro aluno não encontrado

						echo json_encode($dados);
						exit;

					} else {
						$dados['qtdMax'] = $a->getQtdMax();
						echo json_encode($dados);
						exit;
					}
				} else {
					echo json_encode($dados);
				}

				
			}

			exit;
		}
	}
 ?>