<?php 
	class ajaxController extends controller{

		public function index(){
			if (isset($_SESSION['bLogin'])) {
				header('Location: '.BASE_URL.'trabalhos');
				exit;
			} else {
				header('Location: '.BASE_URL.'login');
				exit;
			}
		}

		public function adicionarComentario(){


			if (isset($_POST['id_trabalho'])) {
				$o = new Orientadores();

				$id_trabalho = $_POST['id_trabalho'];
				$id_evento = $_POST['id_evento'];
				$comentario = $_POST['comentario'];

				$last_comment = $o->adicionarComentario($id_trabalho, $id_evento, $comentario);

				echo json_encode($last_comment);
			} else {
				header('Location: '.BASE_URL.'trabalhos');
				exit;
			}
		}

		function getNotificacoes(){

			$o = new Orientadores();

			$notificacoes = $o->getNotificacoes();

			echo json_encode($notificacoes);
		}

		function lerNotificacao(){

			if (isset($_POST['id_notificacao'])) {
				$o = new Orientadores();

				$id_notificacao = $_POST['id_notificacao'];

				$o->lerNotificacao($id_notificacao);
			}

			exit;
		}
	}
 ?>