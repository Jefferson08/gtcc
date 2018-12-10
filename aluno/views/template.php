

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Projeto - Aluno</title>
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
                    <a href="<?php echo BASE_URL; ?>etapas/">Etapas</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>orientacoes">Orientações</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>materiais">Materiais</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL; ?>notas">Notas</a>
                </li>
                
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <div class="topo">

        	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

			<a href="#menu-toggle" class="btn btn-secondary navbar-toggler-icon" id="menu-toggle" style="margin-right: 10px;"></a>

			<div class="separator"></div>

			<div class="navbar-brand"><?php if(isset($_SESSION['aNome'])) {echo $_SESSION['aNome'];} ?></div>

			<div class="navbar-nav ml-auto">

					<div class="dropdown">
                        <a href="" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="notificacoes_aluno" style="margin-right: 20px;"><span class="badge badge-danger" id="badge">0</span> Notificações</a>
                    </div>
					
					<a href="<?php echo BASE_URL; ?>logout" class="btn btn-primary" style="margin-right: 20px;">Sair</a>
				
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