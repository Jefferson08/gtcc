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
			}

			echo json_encode($dados);
			exit;
		}
	}
 ?>