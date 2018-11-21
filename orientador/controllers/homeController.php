<?php 
	class homeController extends controller{

		public function index(){

			$dados = array();

			$a = new Anuncios();
			$u = new Usuarios();
			$c = new Categorias();

			$filtros = array(
				"categoria" => "",
				"preco" => "",
				"estado" => "",
			);

			if (isset($_GET['filtros'])) {
				$filtros = $_GET['filtros'];
			}

			$totAnuncios = $a->getTotalAnuncios($filtros);
			$totUsuarios = $u->getTotalUsuarios();
			$categorias = $c->getCategorias();

			$itens_por_pagina = 2;
			$tot_paginas = ceil($totAnuncios['tot_anuncios_filtro'] / $itens_por_pagina);
			$pag_atual = 1;

			if (isset($_GET['page']) && !empty($_GET['page'])) {
				if ($_GET['page'] > $tot_paginas) {
					$pag_atual = ($_GET['page'] - ($_GET['page'] - $tot_paginas));
				} else if ($_GET['page'] < 1) {
					$pag_atual = 1;
				}else {
					$pag_atual = $_GET['page'];
				}
			}

			$anuncios = $a->getUltimosAnuncios($pag_atual, $itens_por_pagina, $filtros);

			$dados['filtros'] = $filtros;
			$dados['totAnuncios'] = $totAnuncios;
			$dados['totUsuarios'] = $totUsuarios;
			$dados['categorias'] = $categorias;
			$dados['itens_por_pagina'] = $itens_por_pagina;
			$dados['tot_paginas'] = $tot_paginas;
			$dados['pag_atual'] = $pag_atual;
			$dados['anuncios'] = $anuncios;

			$this->loadTemplate('home', $dados); //Carrega o template (Topo) e passa o nome da view a ser carregada e os dados

		}

	}
 ?>