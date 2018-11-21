<?php 
	
	class controller{

		public function loadView($viewName, $viewData = array()){ //Recebe o nome da View a ser carregada e os dados
			extract($viewData); //Extraios dados do array e tranforma em variáveis para poder serem usadas na view
			require 'views/'.$viewName.'.php';
		}

		public function loadTemplate($viewName, $viewData = array()){ //Carrega o template
			require 'views/template.php';
		}

		public function loadViewInTemplate($viewName, $viewData = array()){ //Carrega a view no template
			extract($viewData);
			require 'views/'.$viewName.'.php';
		}
	}

 ?>