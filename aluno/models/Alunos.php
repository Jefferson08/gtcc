

<?php 
	
	class Alunos extends model {

		function login($ra, $senha){ //Verifica os dados do usuário no banco
			
			$sql = "SELECT id, nome FROM alunos WHERE ra = :ra AND senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":ra", $ra);
			$sql->bindValue(":senha", md5($senha));
			$sql->execute();
			if ($sql->rowCount() > 0) {
				$dado = $sql->fetch();
				$_SESSION['aLogin'] = $dado['id'];
				$_SESSION['aNome'] = $dado['nome'];
				return true;
			} else {
				return false;
			}
		}


		function verificaAluno($ra){ //Verifica se o aluno com o RA existe

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

		function checkAluno($id){  //Verifica se o aluno pertence a algum grupo

			$sql = "SELECT * FROM grupos WHERE id_aluno = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id', $id);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				return true;
			} else {
				return false;
			}
		}

		function cadastrarTrabalho($id_tema, $titulo, $id_orientador, $autores){ //Cadastra o trabalho no banco


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

		function getTemas(){ //Retorna os temas
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

		function getOrientadores(){ //Retorna os orientadores
			$orientadores = array();

			$sql = "SELECT id, nome, email FROM orientadores";
			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$orientadores = $sql->fetchAll();
			}

			return $orientadores;
		}

		function getIdOrientador($id_trabalho){ //Retorna o id do orientador do trabalho

			$sql = "SELECT id_orientador FROM trabalhos WHERE id = :id_trabalho";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->execute();

			$sql = $sql->fetch();

			return $sql['id_orientador'];
		}

		function getQtdMax(){ //Retorna a quantidade máxima de autores

			$sql = "SELECT * FROM diretrizes";
			$sql = $this->db->query($sql);
			$sql->execute();

			$sql = $sql->fetch();

			$qtdMax = $sql['qtdMax'];

			return $qtdMax;
		}

		function getIdTrabalho($id_aluno){ //Retorna o id do trabalho que o aluno é autor
			
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

		function getTitulo($id_trabalho){ //Retorna o título do trabalho

			$sql = "SELECT titulo FROM trabalhos WHERE id = $id_trabalho";
			$sql = $this->db->prepare($sql);
			$sql->execute();

			$sql = $sql->fetch();

			$titulo = $sql['titulo'];

			return $titulo;
		}

		function getEvento($id_evento){ //Retorna o nome do evento da tabela cronograma

			$sql = "SELECT evento FROM cronograma WHERE id = $id_evento";
			$sql = $this->db->query($sql);
			$sql->execute();

			$sql = $sql->fetch();

			$evento = $sql['evento'];

			return $evento;
		}

		function getEtapa($id_etapa){ //Retorna apenas uma etapa

			$sql = "SELECT id_evento, url FROM etapas WHERE id = $id_etapa";
			$sql = $this->db->query($sql);
			$sql->execute();

			$etapa = $sql->fetch();

			return $etapa;
		}

		function getEtapas($id_trabalho){ //Retorna todas as etapas
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

					$eventos[$key]["comentarios"] = $this->getComentarios($id_trabalho, $evento['id']);

				} else {
					$eventos[$key]["etapa"] = array();
				}
			}

			/*echo "<pre>";
			print_r($eventos);
			echo "</pre>";*/

			return $eventos;
		}

		function getComentarios($id_trabalho, $id_etapa){ //Retorna os comentários de cada etapa
			$comentarios = array();

			$sql = "SELECT orientadores.nome, comentarios.comentario, comentarios.data_envio FROM orientadores, comentarios WHERE comentarios.id_trabalho = :id_trabalho AND comentarios.id_etapa = :id_etapa AND comentarios.id_orientador = orientadores.id ORDER BY comentarios.data_envio DESC";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->bindValue(':id_etapa', $id_etapa);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$sql = $sql->fetchAll();
				$comentarios = $sql;

				foreach ($comentarios as $key => $comentario) { //Formatando a data de envio
					
					$data_envio = date_create($comentario['data_envio']); 
					$data_envio = date_format($data_envio, 'd/m/Y \à\s\ H\h\ i\m\i\n');

					$comentarios[$key]['data_envio'] = $data_envio;
				}

				return $comentarios;
			} else {
				return $comentarios;
			}

		}

		function getOrientacoes(){ //Retorna todas as orientações realizadas
			$orientacoes = array();

			$id_trabalho = $this->getIdTrabalho($_SESSION['aLogin']);

			$sql = "SELECT titulo, descricao, data FROM orientacoes WHERE id_trabalho = $id_trabalho ORDER BY data DESC";
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

		function getMateriais(){ //Retorna todos os materiais enviados
			$materiais = array();

			$id_trabalho = $this->getIdTrabalho($_SESSION['aLogin']);

			$sql = "SELECT titulo, descricao, link, url, data_envio FROM materiais WHERE id_trabalho = $id_trabalho ORDER BY data_envio DESC";
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

		function getNotificacoes(){ //Retorna as notificações não lidas
			$notificacoes = array(
				'qtd' => 0,
				'notificacoes' => array()
			);

			$id_trabalho = $this->getIdTrabalho($_SESSION['aLogin']);

			$sql = "SELECT id, texto, link FROM notificacoes WHERE id_trabalho = :id_trabalho AND lido = 0";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				
				$notificacoes['qtd'] = $sql->rowCount();
				$sql = $sql->fetchAll();
				$notificacoes['notificacoes'] = $sql;
			}

			return $notificacoes;
		}

		function lerNotificacao($id_notificacao){ //Atualiza a notificação no banco para lida (lido = 1)

			$sql = "UPDATE notificacoes SET lido = 1 WHERE id = :id_notificacao";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_notificacao', $id_notificacao);
			$sql->execute();

		}

		function cadastrarEtapa($id_trabalho, $id_evento, $trabalho){ //Cadastra a etapa no banco e adiciona o arquivo ao servidor
			
			$url = md5(time().rand(0, 9999)).'.pdf';
			move_uploaded_file($trabalho['tmp_name'], '../trabalhos/'.$url);

			$sql = 	"INSERT INTO etapas SET id_trabalho = :id_trabalho, id_evento = :id_evento, data_envio = NOW(), ultima_atualizacao = NOW(), url = :url";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->bindValue(':id_evento', $id_evento);
			$sql->bindValue(':url', $url);
			$sql->execute();

			//Dados da notificação

			$id_orientador = $this->getIdOrientador($id_trabalho);

			$evento = $this->getEvento($id_evento);

			$this->novaNotificacao(0, $id_trabalho, $id_orientador, $evento); //Adicionando a notificação (tipo 0)

		}

		function atualizarEtapa($trabalho, $url_antiga, $id_etapa){ //Atualiza a etapa no banco

			$nova_url = md5(time().rand(0, 9999)).'.pdf'; //Atribuindo nome aleatório para a url

			unlink('../trabalhos/'.$url_antiga); //Deleta o arquivo antigo
			move_uploaded_file($trabalho['tmp_name'], '../trabalhos/'.$nova_url); //Adiciona o novo arquivo

			$sql = "UPDATE etapas SET ultima_atualizacao = NOW(), url = :url WHERE id = :id_etapa"; //Atualiza a tabela etapas com a nova url
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':url', $nova_url);
			$sql->bindValue(':id_etapa', $id_etapa);
			$sql->execute();

			//Dados da notificação

			$sql = "SELECT id_evento FROM etapas WHERE id = :id_etapa"; 
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_etapa', $id_etapa);
			$sql->execute();
			$sql = $sql->fetch();

			$id_evento = $sql['id_evento'];

			$id_trabalho = $this->getIdTrabalho($_SESSION['aLogin']);

			$id_orientador = $this->getIdOrientador($id_trabalho);

			$evento = $this->getEvento($id_evento);

			$this->novaNotificacao(1, $id_trabalho, $id_orientador, $evento); //Adicionando a notificação (tipo 1)

		}

		function getNotas(){ //Retorna as notas das avaliacoes
			$notas = array(
				'nota_coordenador' => "",
				'nota_orientador' => "",
				'notas_banca' => array(),
				'total' => 0
			);

			$id_trabalho = $this->getIdTrabalho($_SESSION['aLogin']);

			$sql = "SELECT nota FROM notas_coordenador WHERE id_trabalho = :id_trabalho";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$sql = $sql->fetch();
				$notas['nota_coordenador'] = $sql['nota'];
				$notas['total'] += $sql['nota'];				
			}

			$sql = "SELECT nota FROM notas_orientador WHERE id_trabalho = :id_trabalho";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$sql = $sql->fetch();
				$notas['nota_orientador'] = $sql['nota'];
				$notas['total'] += $sql['nota'];
			}

			$sql = "SELECT id_avaliador, nota FROM notas_banca WHERE id_trabalho = :id_trabalho";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$sql = $sql->fetchAll();

				$notas_banca = $sql;

				foreach ($notas_banca as $key => $nota) {
					$notas_banca[$key]["nome_avaliador"] = $this->getNomeAvaliador($nota['id_avaliador']);
					$notas['total'] += $nota['nota'];
				}

				foreach ($notas_banca as $key => $nota) {
					array_push($notas['notas_banca'], $nota);
				}
			}

			return $notas;
		}

		function getNomeAvaliador($id_avaliador){ //Retorna o nome do Avaliador

			$sql = "SELECT nome FROM banca WHERE id = $id_avaliador";
			$sql = $this->db->query($sql);
			$sql->execute();

			$sql = $sql->fetch();

			$nome_avaliador = $sql['nome'];

			return $nome_avaliador;
		}

		function novaNotificacao($tipo, $id_trabalho, $id_orientador, $evento){ //Adiciona uma nova notificação no banco

			// Tipo 0 - Envio de etapa
			// Tipo 1 - Atualização de etapa

			$trabalho = $this->getTitulo($id_trabalho);

			if ($tipo == 0) {
				$texto = $trabalho." - Etapa: ".$evento." enviada!";
				$link = "http://projeto.pc/orientador/trabalhos/etapas/".$id_trabalho;
			} else if($tipo == 1){
				$texto = $trabalho." - Etapa: ".$evento." atualizada!";
				$link = "http://projeto.pc/orientador/trabalhos/etapas/".$id_trabalho;
			}

			$sql = "INSERT INTO notificacoes SET id_orientador = :id_orientador, texto = :texto, link = :link";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_orientador', $id_orientador);
			$sql->bindValue(':texto', $texto);
			$sql->bindValue(':link', $link);
			$sql->execute();
		}

	}

 ?>