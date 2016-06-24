<br>
<div class="row" id="row-box" style="padding-top:0px;">
	<?php $fecha_actual = date("Y-m-d");?>
	<?php $remates_disponibles = $this->gadget_model->obtener_remates('activo', $fecha_actual); ?>
	<?php if ( $remates_disponibles): ?>
	<?php foreach ( $remates_disponibles->result() as $rd): ?>

	<div id="box-bub" class="col-sm-6 col-md-2">
		<div class="thumbnail">
			<div>
				<div class="labelfecha"><i class="fa fa-calendar-check-o"></i> <?php echo date('d-m-Y H:i', strtotime($rd->remate_fecha_termino)); ?></div>
				<div class="labellugar" align="center"><i class="fa fa-map-marker"></i> <?php echo $rd->remate_comuna; ?></div>
			</div>
			
			<?php $datos_rematador = $this->gadget_model->obtener_rematadores_por_remate($rd->remate_id, $rd->rematador_id); ?>
			<?php if ( $datos_rematador): ?>
			<?php foreach ( $datos_rematador->result() as $dr): ?>
			
			<a href ="<?php echo site_url('remate/ver/'.$rd->remate_id); ?>"><img src="<?php echo base_url('uploads/pictures/rematadores/'.$rd->remate_imagen); ?>" alt="..." style="width: 170px;height: 90px;" ></a>
			<div class="caption">
				<div class="titlelotes"><?php echo $rd->remate_nombre; ?></div>
				<div class="sublotes"><?php echo $this->gadget_model->truncar_texto($rd->remate_descripcion); ?></div>
			</div>
			<div class="ir-al-remate"> <a href ="<?php echo site_url('remate/ver/'.$rd->remate_id); ?>"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-gavel"></i> Ir al remate</button></a></div>
			<div class="textolotes">Cantidad de lotes: <?php echo $this->gadget_model->obtener_lotes_totales_del_remate($rd->remate_id); ?></div>
			
			<div id="remate-disponible">
				<div class="icono-subasta">
					<i class="fa fa-check"></i>
				</div>
				<div class="texto-subasta">
					<p>Remate Disponible</p>
				</div>
			</div>
			<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
	<?php endforeach; ?>
	<?php else: ?>
	<div class="col-sm-6 col-md-2">
		<p class="alert alert-warning"> No hay subastas disponibles a mostrar</p>
	</div>
	<?php endif; ?>
</div> 