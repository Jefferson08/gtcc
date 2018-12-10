

<?php 
	
	class Orientadores extends model {

		function login($email, $senha){ //Checa os dados do usuáriono banco
			
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

		function getTrabalhos($id_orientador){ //Retorna os trabalhos sob orientação
			$trabalhos = array();

			$sql = "SELECT trabalhos.id, temas.tema, trabalhos.titulo FROM trabalhos, temas WHERE trabalhos.id_tema = temas.id AND trabalhos.id_orientador = $id_orientador";

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

		function getTitulo($id_trabalho){ //Retorna o título do trabalho

			$sql = "SELECT titulo FROM trabalhos WHERE id = $id_trabalho";
			$sql = $this->db->prepare($sql);
			$sql->execute();

			$sql = $sql->fetch();

			$titulo = $sql['titulo'];

			return $titulo;
		}

		function getEtapas($id_trabalho){ //Retorna os eventos do cronograma e as etapas já relizadas da tabela etapas
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

			return $eventos;
		}

		function getComentarios($id_trabalho, $id_etapa){ //Retorna os comentários de cada etapa do trabalho
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

		function cadastrarMaterial($id_trabalho, $titulo, $descricao, $link, $material){ //Insere um novo material no banco
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

			//Dados da notificação

			$dados = array();

			$dados['id_trabalho'] = $id_trabalho;

			$dados['titulo'] = $titulo;

			$this->novaNotificacao(2, $dados); //Adicionando nova notificação (tipo 2)

		}

		function cadastrarOrientacao($id_trabalho, $titulo, $descricao){ //Insere uma nova orientação
			
			$id_orientador = $_SESSION['oLogin'];

			$sql = "INSERT INTO orientacoes SET id_trabalho = :id_trabalho, id_orientador = :id_orientador, titulo = :titulo, descricao = :descricao, data = NOW()";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->bindValue(':id_orientador', $id_orientador);
			$sql->bindValue(':titulo', $titulo);
			$sql->bindValue(':descricao', $descricao);
			$sql->execute();

			//Dados da notificação

			$dados = array();

			$dados['id_trabalho'] = $id_trabalho;

			$this->novaNotificacao(4, $dados);

		}

		function getMateriais(){ //Retorna todos os materiais enviados
			$materiais = array();

			$id_orientador = $_SESSION['oLogin'];

			$sql = "SELECT materiais.titulo, materiais.descricao, materiais.link, materiais.url, materiais.data_envio, trabalhos.titulo AS titulo_trabalho from materiais, trabalhos where trabalhos.id = materiais.id_trabalho AND materiais.id_orientador = $id_orientador ORDER BY data_envio DESC";
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

		function getOrientacoes(){ //Retorna todas as orientações realizadas
			$orientacoes = array();

			$id_orientador = $_SESSION['oLogin'];

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

		function getNomeEvento($id_evento){ //Retorna o nome do evento/etapa

			$sql = "SELECT evento FROM cronograma WHERE id = :id_evento";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_evento', $id_evento);
			$sql->execute();

			$sql = $sql->fetch();

			return $sql['evento'];
		}

		function checkAvaliacao($id_trabalho){ //Verifica se o trabalho já foi avaliado

			$sql = "SELECT * FROM notas_orientador WHERE id_trabalho = $id_trabalho";
			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				return true;
			} else {
				return false;
			}
		}

		function adicionarComentario($id_trabalho, $id_evento, $comentario){ //Adiciona um novo comentário na etapa do trabalho
			$id_orientador = $_SESSION['oLogin'];

			$sql = "INSERT INTO comentarios SET id_trabalho = :id_trabalho, id_orientador = :id_orientador, id_etapa = :id_etapa, comentario = :comentario, data_envio = NOW()";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->bindValue(':id_orientador', $id_orientador);
			$sql->bindValue(':id_etapa', $id_evento);
			$sql->bindValue(':comentario', $comentario);
			$sql->execute();

			$last_id = $this->db->lastInsertId();

			//Dados da notificação

			$dados = array();

			$dados['id_trabalho'] = $id_trabalho;

			$dados['nome_evento'] = $this->getNomeEvento($id_evento);

			$this->novaNotificacao(1, $dados); //Adicionando nova notificação (tipo 1)

			//Pegando o ultimo comentário inserido

			$comentario = $this->getComentario($last_id);

			return $comentario;
		}

		function getComentario($last_id){ //Retorna o último comentário inserido

			$sql = "SELECT orientadores.nome, comentarios.comentario, comentarios.data_envio FROM orientadores, comentarios WHERE comentarios.id_orientador = orientadores.id AND comentarios.id = :last_id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':last_id', $last_id);
			$sql->execute();

			$comentario = $sql->fetch();

			$data_envio = date_create($comentario['data_envio']); 
			$data_envio = date_format($data_envio, 'd/m/Y \à\s\ H\h\ i\m\i\n');

			$comentario['data_envio'] = $data_envio;
			
			return $comentario;

		}

		function avaliar($id_trabalho, $nota){ //Insere  a avaliação no banco e envia a notificação (tipo 0)

			$sql = "INSERT INTO notas_orientador SET id_trabalho = :id_trabalho, nota = :nota";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->bindValue(':nota', $nota);
			$sql->execute();

			$dados = array();

			$dados['id_trabalho'] = $id_trabalho;

			$this->novaNotificacao(0, $dados);
		}

		function getNotificacoes(){ //Pega as notificações do banco 
			$notificacoes = array(
				'qtd' => 0,
				'notificacoes' => array()
			);

			$id_orientador = $_SESSION['oLogin'];

			$sql = "SELECT id, texto, link FROM notificacoes WHERE id_orientador = :id_orientador AND lido = 0";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_orientador', $id_orientador);
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

		function novaNotificacao($tipo, $dados = array()){ //Adiciona uma nova notificação no banco

			//tipo 0 - Avaliação
			//tipo 1 - Comentário
			//tipo 2 - Material

			if ($tipo == 0) {

				$texto = "Avaliado por ".$_SESSION['oNome'];
				$link = "http://projeto.pc/aluno/notas";

			} else if($tipo == 1){

				$texto = $_SESSION['oNome']." adicionou um novo comentário em: ".$dados['nome_evento'];
				$link = "http://projeto.pc/aluno/etapas";

			} else if ($tipo == 2){

				$texto = "Novo material: ".$dados['titulo'];
				$link = "http://projeto.pc/aluno/materiais";

			} else if($tipo == 4){

				$texto = "Nova orientação cadastrada por: ".$_SESSION['oNome'];
				$link = "http://projeto.pc/aluno/orientacoes";

			}

			$sql = "INSERT INTO notificacoes SET id_trabalho = :id_trabalho, texto = :texto, link = :link";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $dados['id_trabalho']);
			$sql->bindValue(':texto', $texto);
			$sql->bindValue(':link', $link);
			$sql->execute();
		}

	}

 ?>