

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

			$dados = array();

			$sql = "SELECT * FROM alunos WHERE ra = :ra";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':ra', $ra);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$sql = $sql->fetch();

				$dados['id'] = $sql['id'];
				$dados['nome'] = $sql['nome'];

				return $dados;
			} else {
				return $dados;
			}


		}

	}

 ?>