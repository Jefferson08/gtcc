

<?php 
	
	class Alunos extends model {

		function login($ra, $senha){
			
			$sql = "SELECT id, nome FROM alunos WHERE ra = :ra AND senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":ra", $ra);
			$sql->bindValue(":senha", md5($senha));
			$sql->execute();
			if ($sql->rowCount() > 0) {
				$dado = $sql->fetch();
				$_SESSION['cLogin'] = $dado['id'];
				$_SESSION['nome'] = $dado['nome'];
				return true;
			} else {
				return false;
			}
		}


		function verificaAluno($ra){

			$aluno = array();

			$sql = "SELECT * FROM alunos WHERE ra = :ra";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':ra', $ra);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$sql = $sql->fetch();

				$aluno['id'] = $sql['id'];
				$aluno['nome'] = $sql['nome'];

				return $aluno;
			} else {
				return $aluno;
			}
		}

		function cadastrarTrabalho($id_tema, $titulo, $id_orientador, $autores){


			$sql = "INSERT INTO trabalhos SET id_tema = :id_tema, titulo = :titulo, id_orientador = :id_orientador";

			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_tema', $id_tema);
			$sql->bindValue(':titulo', $titulo);
			$sql->bindValue(':id_orientador', $id_orientador);
			$sql->execute();

			$id_trabalho = $this->db->lastInsertId();

			foreach ($autores as $id) {
				$sql = "INSERT INTO grupos SET id_trabalho = :id_trabalho, id_aluno = :id_aluno";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':id_trabalho', $id_trabalho);
				$sql->bindValue(':id_aluno', $id);
				$sql->execute();
			}

		}

		function getTemas(){
			$temas = array();

			$sql = "SELECT * FROM temas";
			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$temas = $sql->fetchAll();

				return $temas;
			} else {
				return $temas;
			}

		}

		function getOrientadores(){
			$orientadores = array();

			$sql = "SELECT id, nome, email FROM orientadores";
			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$orientadores = $sql->fetchAll();
			}

			return $orientadores;
		}

		function getQtdMax(){ //Retorna a quantidade máxima de autores

			$sql = "SELECT * FROM diretrizes";
			$sql = $this->db->query($sql);
			$sql->execute();

			$sql = $sql->fetch();

			$qtdMax = $sql['qtdMax'];

			return $qtdMax;
		}

		function getIdTrabalho($id_aluno){
			
			$sql = "SELECT id_trabalho FROM grupos WHERE id_aluno = :id_aluno";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_aluno', $id_aluno);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$sql = $sql->fetch();

				$id_trabalho = $sql['id_trabalho'];

				return $id_trabalho;
			} else {
				$id_trabalho = false;

				return $id_trabalho;
			}
		}

		function getEtapa($id_etapa){
			$sql = "SELECT evento FROM cronograma WHERE id = $id_etapa";
			$sql = $this->db->query($sql);
			$sql->execute();

			$sql = $sql->fetch();

			$etapa = $sql['evento'];

			return $etapa;
		}

		function getEtapas($id_trabalho){
			$eventos = array();

			$sql = "SELECT * FROM cronograma";
			$sql = $this->db->query($sql);
			$sql->execute();

			$eventos = $sql->fetchAll();

			foreach ($eventos as $key => $evento) {
				

				$sql = "SELECT * FROM etapas WHERE id_evento = :id_evento AND id_trabalho = :id_trabalho";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':id_evento', $evento['id']);
				$sql->bindValue(':id_trabalho', $id_trabalho);
				$sql->execute();

				if ($sql->rowCount() > 0) {
					$etapa = $sql->fetch();

					$eventos[$key]["etapa"] = $etapa;
				} else {
					$eventos[$key]["etapa"] = array();
				}
			}

			/*echo "<pre>";
			print_r($eventos);
			echo "</pre>";*/

			return $eventos;
		}

		function cadastrarEtapa($id_trabalho, $id_evento, $url){

			$sql = 	"INSERT INTO etapas SET id_trabalho = :id_trabalho, id_evento = :id_evento, url = :url";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->bindValue(':id_evento', $id_evento);
			$sql->bindValue(':url', $url);
			$sql->execute();

		}

	}

 ?>