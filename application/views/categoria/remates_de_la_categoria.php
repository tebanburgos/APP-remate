<?php $categoria_codigo = $this->uri->segment(3); ?>
<div class="row">

<?php if ( $f_tipo == null and $f_marca == null) { ?>
	<?php $remates_de_la_categoria = $this->categoria_model->obtener_remates_de_la_categoria($categoria_codigo); ?>
<?php } elseif ( $f_tipo == true and $f_marca == null) { ?>
	<?php $remates_de_la_categoria = $this->categoria_model->obtener_remates_de_la_categoria_filtrado($categoria_codigo, $f_tipo, null); ?>
<?php } elseif ( $f_tipo == null and $f_marca == true) { ?>
	<?php $remates_de_la_categoria = $this->categoria_model->obtener_remates_de_la_categoria_filtrado($categoria_codigo, null, $f_marca); ?>
<?php } elseif ( $f_tipo == true and $f_marca == true) { ?>
	<?php $remates_de_la_categoria = $this->categoria_model->obtener_remates_de_la_categoria_filtrado($categoria_codigo, $f_tipo, $f_marca); ?>
<?php } ?>

	<?php // $remates_de_la_categoria = $this->categoria_model->obtener_remates_de_la_categoria($categoria_codigo); ?>
	<?php if ( $remates_de_la_categoria): ?>
	<?php foreach ( $remates_de_la_categoria->result() as $rc): ?>

		<div class="col-sm-6 col-md-6">
		
		<?php $datos_rematador = $this->categoria_model->obtener_rematadores_por_remate($rc->remate_id, $rc->rematador_id); ?>
		<?php if ( $datos_rematador): ?>
		<?php foreach ( $datos_rematador->result() as $dr): ?>
		
			<div class="col-sm-6 col-md-4 info2img">
				<a href="<?php echo site_url('remate/ver/'.$rc->remate_id); ?>"><img src="<?php echo base_url('uploads/pictures/rematadores/'.$rc->remate_imagen); ?>" class="img-responsive" alt="..." width="185" height="146"></a>
			</div> 
			<div class="col-sm-6 col-md-8 info2">
				<div class="infotop">
					<div class="col-sm-6 col-md-4" align="left">
						<small><div class="lote"><i class="fa fa-angle-right"></i> Subasta</div></small>
					</div>
					<div class="col-sm-6 col-md-8" align="right">
						<small><div class="fecha3"><i class="fa fa-calendar-check-o"></i> Cierre: <?php echo date('d-m-Y H:i', strtotime($rc->remate_fecha_termino)); ?></div></small>
					</div>
				</div>
				<div class="infolote">
					<div class="col-sm-3 col-md-7 infolote">
						<div class="sublotes3"><?php echo $this->categoria_model->truncar_texto($rc->remate_descripcion); ?></div>
					</div>
					<div class="col-sm-3 col-md-5">
						<a href ="<?php echo site_url('remate/ver/'.$rc->remate_id); ?>"><button type="button" class="btn btn-success btn-xs btn-block"><i class="fa fa-eye"></i> Ver lotes</button></a>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="infobottom2">
					<div class="row">
						<div class="col-sm-3 col-md-12">
							<div class="valor">
							<!--	Valor Actual: <?php // echo $this->categoria_model->obtener_valor_del_ultimo_lote_del_remate($rc->remate_id); ?>  <small>(CLP)</small> -->
								
							</div>
						</div>
					</div>
				</div>
				<div class="infobottom">
					<div class="row">
						<div class="col-sm-4 col-md-4">
							<center><i class="fa fa-user"></i> Visitas totales: <?php echo $rc->remate_contador_visitas; ?></center>
						</div>
						
						<div class="col-sm-4 col-md-4">
							<center><i class="fa fa-files-o"></i> Cantidad de lotes: <?php echo $this->categoria_model->obtener_lotes_totales_del_remate($rc->remate_id); ?></center>
						</div>
						
						<div class="col-sm-4 col-md-4">
							<center><i class="fa fa-hand-paper-o"></i> Ofertas totales: <?php echo $rc->remate_contador_ofertas; ?></center>
						</div>
					</div>
				</div>
					<div class="row">
						<div class="col-sm-3 col-md-12">
							<div class="disponible3"><i class="fa fa-check"></i> Disponible - Abierto para Ofertas</div> 
						</div>
					</div>
			</div>
		
		<?php endforeach; ?>
		<?php endif; ?>
		</div>
	<?php endforeach; ?>
	<?php else: ?>
	<div class="col-sm-6 col-md-2">
		<p class="alert alert-warning"> No hay remates disponibles en esta categoría</p>
	</div>
	<?php endif; ?>
</div>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="/js/ie10-viewport-bug-workaround.js"></script>