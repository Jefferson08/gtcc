<?php 
	class Orientadores extends model{

		function getOrientadores(){ //Retorna os orientadores cadastrados no banco
			$orientadores = array();

			$sql = "SELECT id, nome, email FROM orientadores";
			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$orientadores = $sql->fetchAll();
			}

			return $orientadores;
		}

		function getBanca(){ //Retorna os avaliadores cadastrados no banco
			$banca = array();

			$sql = "SELECT id, nome, email FROM banca";
			$sql = $this->db->query($sql);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$banca = $sql->fetchAll();
			}

			return $banca;
		}

		function cadastrarOrientador($nome, $email, $senha){ //Cadastra o orientador no banco

			$sql = "INSERT INTO orientadores SET nome = :nome, email = :email, senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':nome', $nome);
			$sql->bindValue(':email', $email);
			$sql->bindValue(':senha', $senha);
			$sql->execute();
		}

		function cadastrarAvaliador($nome, $email, $senha){ //Cadastra o avaliador no banco

			$sql = "INSERT INTO banca SET nome = :nome, email = :email, senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':nome', $nome);
			$sql->bindValue(':email', $email);
			$sql->bindValue(':senha', $senha);
			$sql->execute();
		}

		function excluirOrientador($id){ //Exclui o orientador do banco
			$sql = "DELETE FROM orientadores WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id', $id);
			$sql->execute();
		}

		function excluirAvaliador($id){ //Exclui o avaliador do banco
			$sql = "DELETE FROM banca WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id', $id);
			$sql->execute();
		}
	}
 ?>