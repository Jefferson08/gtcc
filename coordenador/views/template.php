

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Projeto - Coordenador</title>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/style.css">
	<link href="<?php echo BASE_URL; ?>assets/css/simple-sidebar.css" rel="stylesheet">
</head>
<body>


	<div id="wrapper" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Menu
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>diretrizes">Diretrizes</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>orientadores">Orientadores</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>cronograma">Cronograma</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>trabalhos">Trabalhos</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>banca">Banca</a>
                </li>
                
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <div class="topo">

        	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

			<a href="#menu-toggle" class="btn btn-secondary navbar-toggler-icon" id="menu-toggle" style="margin-right: 10px;"></a>

			<div class="separator"></div>

			<div class="navbar-brand"><?php if(isset($_SESSION['cNome'])) {echo $_SESSION['cNome'];} ?></div>

			<div class="navbar-nav ml-auto">
					
					<a href="<?php echo BASE_URL; ?>logout" class="btn btn-primary">Sair</a>
				
			</div>

			
		</nav>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">

                <?php $this->loadViewInTemplate($viewName, $viewData); //Carrega a view passada pelo controller passando o nome e os dados ?> 
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>


	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
</body>
</html>