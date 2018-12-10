<?php

	class Avaliador extends model{

		function login($email, $senha){ //Checa os dados dousuário no banco
			
			$sql = "SELECT id, nome FROM banca WHERE email = :email AND senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":senha", md5($senha));
			$sql->execute();
			if ($sql->rowCount() > 0) {
				$dado = $sql->fetch();
				$_SESSION['bLogin'] = $dado['id'];
				$_SESSION['bNome'] = $dado['nome'];
				return true;
			} else {
				return false;
			}
		}

		function getTrabalhos(){ //Retorna todos os trabalhos
			$trabalhos = array();

			$sql = "SELECT trabalhos.id, temas.tema, trabalhos.id_orientador, orientadores.nome AS orientador, trabalhos.titulo FROM trabalhos, temas, orientadores WHERE trabalhos.id_tema = temas.id AND trabalhos.id_orientador = orientadores.id";

			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				
				$trabalhos = $sql->fetchAll();

				foreach ($trabalhos as $key => $trabalho) {
					
					$autores = $this->getAutores($trabalho['id']);
					$trabalhos[$key]["autores"] = $autores;

					$trabalhos[$key]["finalizado"] = $this->checkEtapa($trabalho['id']);
					$trabalhos[$key]["avaliado"] = $this->checkAvaliacao($trabalho['id']);
					$trabalhos[$key]["ultimaEtapa"] = $this->getUltimaEtapa($trabalho['id']);

				}

				return $trabalhos;

			} else {
				return $trabalhos;
			}
		}

		function getUltimaEtapa($id_trabalho){ //Retorna a ultima etapa enviada do trabalho
			$etapa = array();
				
			$sql = "SELECT MAX(id) AS maxId FROM cronograma";
			$sql = $this->db->query($sql);
			$sql->execute();

			$sql = $sql->fetch();

			$maxId = $sql['maxId'];

			$sql = "SELECT url FROM etapas WHERE id_trabalho = :id_trabalho AND id_evento = :max_id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->bindValue(':max_id', $maxId);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$sql = $sql->fetch();
				$etapa = $sql;
				return $etapa;
			} else{
				return $etapa;
			}
			
		}

		function getTitulo($id_trabalho){ //Retorna o titulo do trabalho

			$sql = "SELECT titulo FROM trabalhos WHERE id = $id_trabalho";
			$sql = $this->db->prepare($sql);
			$sql->execute();

			$sql = $sql->fetch();

			$titulo = $sql['titulo'];

			return $titulo;
		}

		function getAutores($id_trabalho){ //Retorna os autores do trabalho
			$autores = array();

			$sql = "SELECT alunos.nome FROM alunos, grupos WHERE alunos.id = grupos.id_aluno AND id_trabalho = :id_trabalho";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->execute();

			$autores = $sql->fetchAll();

			return $autores;

		}

		function getNotaMax(){ //Retorna a nota máxima que pode ser dada pelo avaliador da banca

			$sql = "SELECT COUNT(id) AS qtd FROM banca";
			$sql = $this->db->query($sql);
			$sql->execute();

			$sql = $sql->fetch();

			$nota_max = 6 / $sql['qtd'];

			return $nota_max;
		}

		function checkEtapa($id_trabalho){ //Verifica se a ultima etapa do trabalho foi enviada

			$sql = "SELECT MAX(id) AS maxId FROM cronograma";
			$sql = $this->db->query($sql);
			$sql->execute();

			$sql = $sql->fetch();

			$maxId = $sql['maxId'];

			$sql = "SELECT * FROM etapas WHERE id_trabalho = $id_trabalho AND id_evento = $maxId";
			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				return true;
			} else {
				return false;
			}

		}

		function checkAvaliacao($id_trabalho){ //Verifica se o trabalho já foi avaliado
			$id_avaliador = $_SESSION['bLogin'];

			$sql = "SELECT * FROM notas_banca WHERE id_trabalho = :id_trabalho AND id_avaliador = :id_avaliador";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->bindValue(':id_avaliador', $id_avaliador);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				return true;
			} else {
				return false;
			}
		}

		function avaliar($id_trabalho, $nota){ //Insere a avaliação no banco e adiciona uma nova notificação

			$id_avaliador = $_SESSION['bLogin'];

			$sql = "INSERT INTO notas_banca SET id_trabalho = :id_trabalho, nota = :nota, id_avaliador = :id_avaliador";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->bindValue(':nota', $nota);
			$sql->bindValue(':id_avaliador', $id_avaliador);
			$sql->execute();

			$this->novaNotificacao($id_trabalho);
		}

		function novaNotificacao($id_trabalho){ //Adiciona ao banco uma nova notificação sobre a avaliação realizada

			$texto = "Avaliado por ".$_SESSION['bNome'];
			$link = "http://projeto.pc/aluno/notas";

			$sql = "INSERT INTO notificacoes SET id_trabalho = :id_trabalho, texto = :texto, link = :link";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->bindValue(':texto', $texto);
			$sql->bindValue(':link', $link);
			$sql->execute();
		}
	}
?>