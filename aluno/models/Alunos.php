

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
				$_SESSION['aLogin'] = $dado['id'];
				$_SESSION['aNome'] = $dado['nome'];
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

		function checkAluno($id){
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

		function getEvento($id_evento){ //Retorna o nome do evento da tabela cronograma
			$sql = "SELECT evento FROM cronograma WHERE id = $id_evento";
			$sql = $this->db->query($sql);
			$sql->execute();

			$sql = $sql->fetch();

			$evento = $sql['evento'];

			return $evento;
		}

		function getEtapa($id_etapa){

			$sql = "SELECT id_evento, url FROM etapas WHERE id = $id_etapa";
			$sql = $this->db->query($sql);
			$sql->execute();

			$etapa = $sql->fetch();

			return $etapa;
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

			/*echo "<pre>";
			print_r($eventos);
			echo "</pre>";*/

			return $eventos;
		}

		function getOrientacoes(){
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

		function getMateriais(){
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

		function cadastrarEtapa($id_trabalho, $id_evento, $trabalho){
			
			$url = md5(time().rand(0, 9999)).'.pdf';
			move_uploaded_file($trabalho['tmp_name'], '../trabalhos/'.$url);

			$sql = 	"INSERT INTO etapas SET id_trabalho = :id_trabalho, id_evento = :id_evento, data_envio = NOW(), ultima_atualizacao = NOW(), url = :url";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_trabalho', $id_trabalho);
			$sql->bindValue(':id_evento', $id_evento);
			$sql->bindValue(':url', $url);
			$sql->execute();

		}

		function atualizarEtapa($trabalho, $url_antiga, $id_etapa){
			$nova_url = md5(time().rand(0, 9999)).'.pdf'; //Atribuindo nome aleatório para a url

			unlink('../trabalhos/'.$url_antiga); //Deleta o arquivo antigo
			move_uploaded_file($trabalho['tmp_name'], '../trabalhos/'.$nova_url); //Adiciona o novo arquivo

			$sql = "UPDATE etapas SET ultima_atualizacao = NOW(), url = :url WHERE id = :id_etapa"; //Atualiza a tabela etapas com a nova url
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':url', $nova_url);
			$sql->bindValue(':id_etapa', $id_etapa);
			$sql->execute();

		}

	}

 ?>