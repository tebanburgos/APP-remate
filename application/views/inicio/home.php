<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
    </head>
	<body>
        
        
		<div class="container-fluid">
			<div class="row">
				<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
				
				<?php $this->load->view('gadgets/categorias'); ?>
				<?php  $this->load->view('gadgets/tabs'); ?>
		<!--	<div class="col-md-12">
				<?php // $this->load->view('gadgets/banners'); ?>
				</div>	-->

		<!--	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p> -->
			</div> <!-- /.row -->
		</div> <!-- /. container-fluid -->
	</body>
</html>