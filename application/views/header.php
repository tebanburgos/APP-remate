<!DOCTYPE html>
<?php $id_html = ( ! $this->auth->check()) ? 'pagina-login' : ''; ?>
<html lang="es">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
     <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
	
	<title>Rematador.cl - Venta Digital</title>
	<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/custom-theme/jquery-ui-1.10.0.custom.css'); ?>" rel="stylesheet">
	<!--[if IE]>
	  <link href="<?php echo base_url('assets/custom-theme/jquery.ui.1.10.0.ie.css'); ?>" rel="stylesheet">
	<![endif]-->
	<link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300,400italic,800' rel='stylesheet' type='text/css'>
	<link href="<?php echo base_url('assets/estilos.css'); ?>" rel="stylesheet">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script src="<?php echo base_url('assets/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/jquery-ui/jquery-ui.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/bootbox.min.js'); ?>"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300,400italic,800' rel='stylesheet' type='text/css'>
	<script src="js/ie-emulation-modes-warning.js"></script>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="/uploads/pictures/favicon.ico">
<!--[if lt IE 8]><link rel="stylesheet" href="assets/bootstrap/css/bootstrap-ie7buttonfix.css"><![endif]-->
<!--[if IE 8]><link rel="stylesheet" href="assets/bootstrap/css/bootstrap-ie8buttonfix.css"><![endif]-->



  </head>
  
  <body>

			
			
        <nav class="navbar">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url('assets/img/rsi.png'); ?>"></a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                  <!--  <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Buscar...">
                    </form> -->
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Inicio</a></li>
						<?php if (!$this->session->userdata('ingresado')){ ?>
                        
						<li><a href="<?php echo site_url('ofertante/registrar/'); ?>"><i class="fa fa-file-text-o"></i> Registro</a></li>
						
						<li><a href="<?php echo site_url('ofertante/acceso/'); ?>"><i class="fa fa-sign-in"></i> Login</a></li>
						
						
						<?php } ?>
						<?php if ($this->session->userdata('tipo') == "rematador"){ ?>
							<li><a href="<?php echo site_url('rematador/panel_de_control/'); ?>"><i class="fa fa-user"></i> Mi Cuenta</a></li>
						<? } ?>
						<?php if ($this->session->userdata('tipo') == "ofertante"){ ?>
							<li><a href="<?php echo site_url('ofertante/panel_de_control/'); ?>"><i class="fa fa-user"></i> Mi Cuenta</a></li>
						<? } ?>
						<li><a href="<?php echo site_url('/ayuda'); ?>"><i class="fa fa-question-circle"></i> Ayuda</a></li>
						
						<?php if ($this->session->userdata('ingresado')){ ?>
						<li><a href="<?php echo site_url('rematador/salir/'); ?>"><i class="fa fa-sign-out"></i> Salir</a></li>
						<li><a href="#"><i class="fa fa-male"></i> Bienvenido </i></a></li>
						<?php } ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
	<div class="container-fluid">	
