<?php 
	class ajaxController extends controller{

		public function index(){

		}

		public function excluirTema(){

			if (isset($_POST['id_tema']) && !empty($_POST['id_tema'])) {
				
				$id = $_POST['id_tema'];

				$c = new Coordenador();

				$c->excluirTema($id);

				exit;
			}

		}

		public function excluirOrientador(){

			if (isset($_POST['id_orientador']) && !empty($_POST['id_orientador'])) {
				
				$id = $_POST['id_orientador'];

				$o = new Orientadores();

				$o->excluirOrientador($id);

				exit;
			}
		}

		public function excluirAvaliador(){

			if (isset($_POST['id_avaliador']) && !empty($_POST['id_avaliador'])) {
				
				$id = $_POST['id_avaliador'];

				$o = new Orientadores();

				$o->excluirAvaliador($id);

				exit;
			}
		}

		public function excluirEvento(){

			if (isset($_POST['id_evento']) && !empty($_POST['id_evento'])) {
				
				$id = $_POST['id_evento'];

				$c = new Coordenador();

				$c->excluirEvento($id);

				exit;
			}
		}
	}
 ?>