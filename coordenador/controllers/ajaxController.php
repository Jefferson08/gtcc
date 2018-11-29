<?php 
	class ajaxController extends controller{

		public function index(){

		}

		public function excluirTema(){

			if (isset($_POST['id_tema']) && !empty($_POST['id_tema'])) {
				$dados = array();
				
				$id = $_POST['id_tema'];

				$c = new Coordenador();

				$c->excluirTema($id);

				echo json_encode($dados);

				exit;
			}
		}
	}
 ?>