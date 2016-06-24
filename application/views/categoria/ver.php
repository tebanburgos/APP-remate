<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
				<?php $data['f_tipo'] = $fitro_tipo; ?>
				<?php $data['f_marca'] = $fitro_marca;?>
				<ol class="breadcrumb">
					<li class="active"><a href="<?php echo base_url() ?>">Inicio</a></li>
						<?php $numero_categoria = $this->uri->segment(3); ?>
					<li><a href="<?php echo site_url('categoria/ver/'.$numero_categoria); ?>"><?=$nombre_categoria?></a></li>
				</ol>
			</div>
		</div>
		
		<div class="row">
			<?php $this->load->view('categoria/menu_categorias', $data); ?>
				
                <div class="col-md-10">
                    <?php $this->load->view('categoria/remates_de_la_categoria', $data); ?>
                </div>
        </div>
			

        </div><!-- /.container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="/js/ie10-viewport-bug-workaround.js"></script>
</body>