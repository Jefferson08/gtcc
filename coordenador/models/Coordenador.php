

<?php 
	
	class Coordenador extends model {

		function login($email, $senha){
			
			$sql = "SELECT id, nome FROM coordenadores WHERE email = :email AND senha = :senha";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":email", $email);
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

		function cadastrarDiretrizes($qtdMax, $temas){

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

		function getDiretrizes() {
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

		function excluirTema($id){

			$sql = "DELETE FROM temas WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id', $id);
			$sql->execute();
		}

	}

 ?>