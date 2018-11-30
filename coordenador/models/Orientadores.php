<?php 
	class Orientadores extends model{

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

		function cadastrarOrientador($nome, $email, $senha){

			$sql = "INSERT INTO orientadores SET nome = :nome, email = :email, senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':nome', $nome);
			$sql->bindValue(':email', $email);
			$sql->bindValue(':senha', $senha);
			$sql->execute();
		}

		function excluirOrientador($id){
			$sql = "DELETE FROM orientadores WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id', $id);
			$sql->execute();
		}
	}
 ?>