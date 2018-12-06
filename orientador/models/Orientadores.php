

<?php 
	
	class Orientadores extends model {

		function login($email, $senha){
			
			$sql = "SELECT id, nome FROM orientadores WHERE email = :email AND senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":senha", md5($senha));
			$sql->execute();
			if ($sql->rowCount() > 0) {
				$dado = $sql->fetch();
				$_SESSION['oLogin'] = $dado['id'];
				$_SESSION['oNome'] = $dado['nome'];
				return true;
			} else {
				return false;
			}
		}

		function getTrabalhos($id_orientador){
			$trabalhos = array();

			$sql = "SELECT trabalhos.id, temas.tema, trabalhos.titulo FROM trabalhos, temas WHERE trabalhos.id_tema = temas.id AND trabalhos.id_orientador = $id_orientador";

			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				
				$trabalhos = $sql->fetchAll();

				foreach ($trabalhos as $key => $trabalho) {
					
					$autores = $this->getAutores($trabalho['id']);
					$trabalhos[$key]["autores"] = $autores;

				}

				return $trabalhos;

			} else {
				return $trabalhos;
			}
		}

		function getAutores($id_trabalho){
			$autores = array();

			$sql = "SELECT alunos.nome FROM alunos, grupos WHERE alunos.id = grupos.id_aluno AND id_trabalho = :id_trabalho";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->execute();

			$autores = $sql->fetchAll();

			return $autores;

		}

		function getEtapas($id_trabalho){
			$eventos = array();

			$sql = "SELECT * FROM cronograma";
			$sql = $this->db->query($sql);
			$sql->execute();

			$eventos = $sql->fetchAll();

			foreach($eventos as $key => $evento){ //Percorrendo os eventos e formatando as datas
				$data = date_create($evento['data']); 
				$data = date_format($data, 'd/m/Y');

				$eventos[$key]['data'] = $data;
			}

			foreach ($eventos as $key => $evento) {

				$sql = "SELECT * FROM etapas WHERE id_evento = :id_evento AND id_trabalho = :id_trabalho";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':id_evento', $evento['id']);
				$sql->bindValue(':id_trabalho', $id_trabalho);
				$sql->execute();

				if ($sql->rowCount() > 0) {
					$etapa = $sql->fetch();

					//Formatando data de envio e ultimaatualização

					$data_envio = date_create($etapa['data_envio']); 
					$ultima_atualizacao = date_create($etapa['ultima_atualizacao']); 

					$data_envio = date_format($data_envio, 'd/m/Y \à\s\ H\h\ i\m\i\n');
					$ultima_atualizacao = date_format($ultima_atualizacao, 'd/m/Y \à\s\ H\h\ i\m\i\n');

					$etapa['data_envio'] = $data_envio;
					$etapa['ultima_atualizacao'] = $ultima_atualizacao;

					$eventos[$key]["etapa"] = $etapa;
				} else {
					$eventos[$key]["etapa"] = array();
				}
			}

			return $eventos;
		}

		function cadastrarMaterial($id_trabalho, $titulo, $descricao, $link, $material){
			$url = null;

			$id_orientador = $_SESSION['oLogin'];

			if (empty($link)) {
				$link = null;
			}

			if (!empty($material)) {
				$url = md5(time().rand(0, 9999)).'.pdf';
				move_uploaded_file($material['tmp_name'], '../materiais/'.$url);
			}

			$sql = "INSERT INTO materiais SET id_trabalho = :id_trabalho, id_orientador = :id_orientador, titulo = :titulo, descricao = :descricao, link = :link, url = :url, data_envio = NOW()";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->bindValue(':id_orientador', $id_orientador);
			$sql->bindValue(':titulo', $titulo);
			$sql->bindValue(':descricao', $descricao);
			$sql->bindValue(':link', $link);
			$sql->bindValue(':url', $url);
			$sql->execute();


		}

		function getMateriais(){
			$materiais = array();

			$id_orientador = $_SESSION['oLogin'];

			$sql = "SELECT materiais.titulo, materiais.descricao, materiais.link, materiais.url, materiais.data_envio, trabalhos.titulo AS titulo_trabalho from materiais, trabalhos where trabalhos.id = materiais.id_trabalho AND materiais.id_orientador = $id_orientador";
			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$materiais = $sql->fetchAll();

				foreach ($materiais as $key => $material) {
					$data = date_create($material['data_envio']); 
					$data = date_format($data, 'd/m/Y \à\s\ H\h\ i\m\i\n');

					$materiais[$key]["data_envio"] = $data;
				}

				return $materiais;
			} else {

				return $materiais;
			}
		}

	}

 ?>