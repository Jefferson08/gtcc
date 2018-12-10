

<?php 
	
	class Coordenador extends model {

		function login($email, $senha){ //Verifica os dados do usuário no banco
			
			$sql = "SELECT id, nome FROM coordenadores WHERE email = :email AND senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":senha", md5($senha));
			$sql->execute();
			if ($sql->rowCount() > 0) {
				$dado = $sql->fetch();
				$_SESSION['cLogin'] = $dado['id'];
				$_SESSION['cNome'] = $dado['nome'];
				return true;
			} else {
				return false;
			}
		}

		function cadastrarDiretrizes($qtdMax, $temas){ //Cadastra as diretrizes no banco

			$sql = "UPDATE diretrizes SET qtdMax = :qtd";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':qtd', $qtdMax);
			$sql->execute();

			foreach ($temas as $tema) {
				$sql = "INSERT INTO temas SET tema = :tema";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':tema', $tema);
				$sql->execute();
			}

		}

		function getDiretrizes() { //Retorna as diretrizes cadastradas no banco
			$diretrizes = array();

			$sql = "SELECT * FROM temas";
			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$temas = $sql->fetchAll();

				$diretrizes['temas'] = $temas;
			} else {
				$diretrizes['temas'] = array();
			}

			$sql = "SELECT * FROM diretrizes";
			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$qtdMax = $sql->fetch();

				$diretrizes['qtdMax'] = $qtdMax['qtdMax'];
			}

			return $diretrizes;
		}

		function getCronograma(){ //Retorna o cronograma/eventos do banco

			$cronograma = array();

			$sql = "SELECT * FROM cronograma";
			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$eventos = $sql->fetchAll();

				foreach ($eventos as $key => $evento) { //Formatando as datas pro formato dd/mm/yyyy
					$data = date_create($evento['data']); 
					$data = date_format($data, 'd/m/Y');

					$eventos[$key]['data'] = $data;
				}

				$cronograma = $eventos;

				return $cronograma;
			} else {
				return $cronograma;
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

				}

				return $trabalhos;

			} else {
				return $trabalhos;
			}


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

		function getEtapas($id_trabalho){ //Retorna os eventos e as etapas realizadas
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

			/*echo "<pre>";
			print_r($eventos);
			echo "</pre>";*/

			return $eventos;
		}

		function getOrientador($id_orientador){ //Retorna o nome do orientador

			$sql = "SELECT nome FROM orientadores WHERE id = $id_orientador";
			$sql = $this->db->query($sql);
			$sql->execute();

			$sql = $sql->fetch();

			$nome_orientador = $sql['nome'];

			return $nome_orientador;
		}

		function getOrientacoes($id_orientador){ //Retorna as orientações realizadas pelo orientador
			$orientacoes = array();

			$sql = "SELECT orientacoes.titulo, orientacoes.descricao, orientacoes.data, trabalhos.titulo AS titulo_trabalho from orientacoes, trabalhos where trabalhos.id = orientacoes.id_trabalho AND orientacoes.id_orientador = $id_orientador ORDER BY orientacoes.data DESC";
			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$orientacoes = $sql->fetchAll();

				foreach ($orientacoes as $key => $orientacao) {
					$data = date_create($orientacao['data']); 
					$data = date_format($data, 'd/m/Y');

					$orientacoes[$key]["data"] = $data;
				}

				return $orientacoes;
			} else {

				return $orientacoes;
			}
		}

		function getTitulo($id_trabalho){ //Retorna o título do trabalho

			$sql = "SELECT titulo FROM trabalhos WHERE id = $id_trabalho";
			$sql = $this->db->prepare($sql);
			$sql->execute();

			$sql = $sql->fetch();

			$titulo = $sql['titulo'];

			return $titulo;
		}

		function cadastrarCronograma($eventos, $datas){ //Cadastra os eventos do cronograma no banco

			$cronograma = array();

			foreach ($datas as $key => $data) { //Formatando as datas pro formato dd/mm/yyyy

				$date = date_create($data); 
				$date = date_format($date, 'Y-m-d');

				$datas[$key] = $date;
			}

			for($i = 0; $i < count($eventos); $i++){
				array_push($cronograma, array("evento" => $eventos[$i], "data" => $datas[$i]));
			}

			foreach ($cronograma as $evento) {
				
				$sql = "INSERT INTO cronograma SET evento = :evento, data = :data";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':evento', $evento['evento']);
				$sql->bindValue(':data', $evento['data']);
				$sql->execute();
			}

		}

		function excluirTema($id){ //Exclui um tema do banco

			$sql = "DELETE FROM temas WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id', $id);
			$sql->execute();
		}

		function excluirEvento($id){ //Exclui um evento do cronograma no banco

			$sql = "DELETE FROM cronograma WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id', $id);
			$sql->execute();
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

			$sql = "SELECT * FROM notas_coordenador WHERE id_trabalho = $id_trabalho";
			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				return true;
			} else {
				return false;
			}
		}

		function avaliar($id_trabalho, $nota){ //Cadastra a avaliação no banco

			$sql = "INSERT INTO notas_coordenador SET id_trabalho = :id_trabalho, nota = :nota";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->bindValue(':nota', $nota);
			$sql->execute();

			$this->novaNotificacao($id_trabalho);


		}

		function novaNotificacao($id_trabalho){ //Adiciona uma nova notificação de avaliação no banco

			$texto = "Avaliado por ".$_SESSION['cNome'];
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