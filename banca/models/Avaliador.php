<?php

	class Avaliador extends model{

		function login($email, $senha){
			
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
	}
?>