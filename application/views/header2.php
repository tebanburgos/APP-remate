<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">

<head>

  <!-- Basic -->
  <title>Proyecto | Re-Remate</title>

  <!-- Define Charset -->
  <meta charset="utf-8">

  <!-- Responsive Metatag -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Page Description and Author -->
  <meta name="description" content="Margo - Responsive HTML5 Template">
  <meta name="author" content="iThemesLab">

  <!-- Bootstrap CSS  -->
  <link rel="stylesheet" href="http://re-remate.s2.imacom.cl/asset/css/bootstrap.min.css" type="text/css" media="screen">
		
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="http://re-remate.s2.imacom.cl/css/font-awesome.min.css" type="text/css" media="screen">

  <!-- Slicknav -->
  <link rel="stylesheet" type="text/css" href="http://re-remate.s2.imacom.cl/css/slicknav.css" media="screen">

  <!-- Margo CSS Styles  -->
  <link rel="stylesheet" type="text/css" href="http://re-remate.s2.imacom.cl/css/style.css" media="screen">

  <!-- Responsive CSS Styles  -->
  <link rel="stylesheet" type="text/css" href="http://re-remate.s2.imacom.cl/css/responsive.css" media="screen">

  <!-- Css3 Transitions Styles  -->
  <link rel="stylesheet" type="text/css" href="http://re-remate.s2.imacom.cl/css/animate.css" media="screen">

  <!-- Color CSS Styles  -->
  <link rel="stylesheet" type="text/css" href="http://re-remate.s2.imacom.cl/css/colors/red.css" title="red" media="screen" />
  
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300,400italic,800' rel='stylesheet' type='text/css'>
  
  <!-- Margo JS  -->
  <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="js/jquery.migrate.js"></script>
  <script type="text/javascript" src="js/modernizrr.js"></script>
  <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.fitvids.js"></script>
  <script type="text/javascript" src="js/owl.carousel.min.js"></script>
  <script type="text/javascript" src="js/nivo-lightbox.min.js"></script>
  <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
  <script type="text/javascript" src="js/jquery.appear.js"></script>
  <script type="text/javascript" src="js/count-to.js"></script>
  <script type="text/javascript" src="js/jquery.textillate.js"></script>
  <script type="text/javascript" src="js/jquery.lettering.js"></script>
  <script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>
  <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
  <script type="text/javascript" src="js/jquery.parallax.js"></script>
  <script type="text/javascript" src="js/mediaelement-and-player.js"></script>
  <script type="text/javascript" src="js/jquery.slicknav.js"></script>
  

  <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>

<body>

  <!-- Full Body Container -->
  <div id="container">


    <!-- Start Header Section -->
    <div class="hidden-header"></div>
    <header class="clearfix">

      <!-- Start Top Bar -->
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <!-- Start Contact Info -->
              <ul class="social-list">
                <li>
                  <a class="facebook itl-tooltip" data-placement="bottom" title="Facebook" href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a class="twitter itl-tooltip" data-placement="bottom" title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                </li>
              </ul>
              <ul class="contact-details">
                <li><a href="#"><i class="fa fa-map-marker"></i> Santiago</a>
                </li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> info@re-remate.cl</a>
                </li>
                <li><a href="#"><i class="fa fa-phone"></i> +562 2222 2222</a>
                </li>
              </ul>
              <!-- End Contact Info -->
            </div>
            <!-- .col-md-6 -->
            <div class="col-md-6">
              <!-- Start Social Links -->
              <ul class="footer-nav">
                <li><a href="#">Quienes Somos</a>
                </li>
                <li><a href="#">Servicios</a>
                </li>
                <li><a href="#">Cómo Participar</a>
                </li>
                <li><a href="#">Preguntas Frecuentes</a>
                </li>
              </ul>
              
              <!-- End Social Links -->
            </div>
            <!-- .col-md-6 -->
          </div>
          <!-- .row -->
        </div>
        <!-- .container -->
      </div>
      <!-- .top-bar -->
      <!-- End Top Bar -->


      <!-- Start  Logo & Naviagtion  -->
      <div class="navbar navbar-default navbar-top">
        <div class="container">
          <div class="navbar-header">
            <!-- Stat Toggle Nav Link For Mobiles -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
            <!-- End Toggle Nav Link For Mobiles -->
            <a class="navbar-brand" href="index.html">
              <img alt="" src="images/reremate.png">
            </a>
          </div>
          <div id="navbar" class="collapse navbar-collapse">
                    <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Buscar...">
                    </form>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Inicio</a></li>
						<?php if (!$this->session->userdata('ingresado')){ ?>
                        
						<li><a href="#" data-toggle="modal" data-target=".registro"><i class="fa fa-file-text-o"></i> Registro</a></li>
						
						<div class="modal fade registro" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Tipo de registro</h4>
									</div>
									<div class="modal-body">
										<div class="panel panel-default panel-login">
											<div class="panel-body">
												<div align="center"><a href="<?php echo site_url('rematador/registrar/'); ?>"><h4><i class="fa fa-check-square"></i> ¡Quiero Vender!</h4></a></div>
												<div align="center"><a href="<?php echo site_url('ofertante/registrar/'); ?>"><h4><i class="fa fa-sign-in"></i> ¡Quiero Comprar!</h4></a></div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
							</div>
						</div>
						
						
						<li><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-sign-in"></i> Login</a></li>
						
						<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Elija un tipo de acceso</h4>
									</div>
									<div class="modal-body">
										<div class="panel panel-default panel-login">
											<div class="panel-body">
												<div align="center"><a href="<?php echo site_url('rematador/acceso/'); ?>"><h4><i class="fa fa-briefcase"></i> Acceso Rematador</h4></a></div>
												<div align="center"><a href="<?php echo site_url('ofertante/acceso/'); ?>"><h4><i class="fa fa-shopping-cart"></i> Acceso Ofertante</h4></a></div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
							</div>
						</div>
						
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
        </div>

        <!-- Mobile Menu Start -->
        <ul class="wpb-mobile-menu">
          <li>
            <a class="active" href="index.html"><i class="fa fa-home"></i>  Inicio</a>
            </li>
          <li>
            <a href="#"><i class="fa fa-file-text-o"></i>  Registro</a>
            <ul class="dropdown">
              <li><a href="#">Persona</a>
              </li>
              <li><a href="#">Empresa</a>
              </li>
              </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-sign-in"></i>  Login</a>
            <ul class="dropdown">
              <li><a href="#">Persona</a>
              </li>
              <li><a href="#">Empresa</a>
              </li>
              </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-question-circle"></i>  Ayuda</a>
            </li>
          <li>
            <a href="contacto.html"><i class="fa fa-envelope"></i>  Contacto</a>
          </li>
        </ul>
        <!-- Mobile Menu End -->

      </div>
      <!-- End Header Logo & Naviagtion -->

    </header>
    <!-- End Header Section -->