<?php 
	class Core{

		public function run(){

			//Dividir a url em 3 partes
			//1 - controller
			//2 - action
			//3 - parâmetros

			$url = '/';
			$param = array(); //Parâmetros

			if (isset($_GET['url'])) {
				$url .= $_GET['url'];
			}

			if (empty($url) || $url == '/') { //verifica se a url está vazia. Se não enviou nada, o controller atual recebe o controller principal (home) e a action padrão (index)
				
				$currentController = 'homeController';
				$currentAction = 'index';

			} else { //Se enviou prossegue
				$url = explode('/', $url);

				array_shift($url); //Remove do array o primeiro item (vazio) , o controller passa a ser o primeiro

				$currentController = $url[0].'Controller';

				if (!(file_exists('controllers/'.$currentController.'.php'))) { //Verifica se o controller não existe
					$currentController = 'homeController';
					$currentAction = 'index';			
				} else { //Se o controller existe 
					
					echo "Controller: ".$currentController." EXISTE!!!";

					array_shift($url); //Remove o controller do array, e o action passa a ser o primeiro

					if (isset($url[0]) && !empty($url[0])) { //verifica se o action foi enviado e se não está vazio
						
						$currentAction = $url[0];
						
						array_shift($url); //Remove o action do array e os parametros passam a ser o primeiro item

						if (count($url) > 0) {
							$param = $url;
						}else { //Se enviou a action sem parametros (produto/abrir)
							$currentControlle = 'homeController';
							$currentAction ='index';
						}

					} else { //Se não foi enviado, ou foi enviado só '/', recebe a action padrão (index)
						$currentAction = 'index';
					}	
				}
			}

			$c = new $currentController(); //instanciando o controller da classe correspondente

			/*echo "CurrentController: ".$currentController."<br>";
			echo "CurrentAction: ".$currentAction."<br>";
			echo "Parametros: ".print_r($param, true)."<br>";*/

			call_user_func_array(array($c, $currentAction), $param); //Chamando a função ($currentAction) do controller ($c), passando os parâmetros ($param)

			
			
		}

	}
 ?>