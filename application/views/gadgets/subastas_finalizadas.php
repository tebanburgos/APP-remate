<br>
<div class="row">
	<?php $fecha_actual = date("Y-m-d");?>
	<?php $remates_finalizados = $this->gadget_model->obtener_remates('finalizado', $fecha_actual); ?>
	<?php if ( $remates_finalizados): ?>
	<?php foreach ( $remates_finalizados->result() as $rd): ?>

	<div id="box-fin" class="col-sm-6 col-md-2">
		<div class="thumbnail">
			<div>
				<div class="labelfecha"><i class="fa fa-calendar-check-o"></i> <?php echo date('d-m-Y H:i', strtotime($rd->remate_fecha_termino)); ?></div>
				<div class="labellugar" align="center"><i class="fa fa-map-marker"></i> <?php echo $rd->remate_comuna; ?></div>
			</div>
			
			<?php $datos_rematador = $this->gadget_model->obtener_rematadores_por_remate($rd->remate_id, $rd->rematador_id); ?>
			<?php if ( $datos_rematador): ?>
			<?php foreach ( $datos_rematador->result() as $dr): ?>
			
			<a href ="<?php echo site_url('remate/ver/'.$rd->remate_id); ?>"><img src="<?php echo base_url('uploads/pictures/rematadores/'.$rd->remate_imagen); ?>" alt="..." style="width: 144px;height: 90px;" ></a>
			<div class="caption">
				<div class="titlelotes"><?php echo $rd->remate_nombre; ?></div>
				<div class="sublotes"><?php echo $this->gadget_model->truncar_texto($rd->remate_descripcion); ?></div>
			</div>
			<div class="ver-detalles"> <a href ="<?php echo site_url('remate/ver/'.$rd->remate_id); ?>"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-file-text-o"></i> Ver detalles</button></a></div>
			<div class="textolotes">Cantidad de lotes: <?php echo $this->gadget_model->obtener_lotes_totales_del_remate($rd->remate_id); ?></div>
			<div id="remate-finalizado">
				<div class="icono-subasta">
					<i class="fa fa-times"></i>
				</div>
				<div class="texto-subasta">
					<p>Remate Finalizado</p>
				</div>
			</div>			
			<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
	<?php endforeach; ?>
	<?php else: ?>
	<div  class="col-sm-6 col-md-2">
		<p class="alert alert-warning"> No hay subastas finalizadas a mostrar</p>
	</div>
	<?php endif; ?>
</div>