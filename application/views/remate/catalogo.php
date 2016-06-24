<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
			<?php $datos_remate = $this->remate_model->obtener_todos_los_datos_del_remate($this->uri->segment(3)); ?>
			<?php if ( $datos_remate): ?>
			<?php foreach ( $datos_remate->result() as $dr): ?>
				<div class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal'>
					<b>
						<u>
							<span style='font-size:12.0pt;font-family:"Verdana","sans-serif";color:black'><?php echo $dr->remate_nombre; ?> - <?php echo date('d-m-Y H:i', strtotime($dr->remate_fecha_termino)); ?>
								<br>
								<?php echo $dr->remate_direccion; ?> - <?php echo $dr->remate_comuna; ?>
							</span>
							
							
						</u>
					</b>
					<br>
					<br>
					<td style="color: #4E9CBF;">Catálogo sujeto a cambios hasta el final del remate.</td>
					<br>
				
					<?php $lotes_del_remate = $this->remate_model->obtener_lotes_del_remate($this->uri->segment(3), null); ?>
					<?php if ( $lotes_del_remate): ?>
					<?php foreach ( $lotes_del_remate->result() as $lr): ?>
					<br>
					<br>
					<b><?php echo $lr->lote_nombre; ?> - <?php echo date('d-m-Y H:i', strtotime($lr->lote_fecha_cierre)); ?></b>
					<br>
					<br>
					<?php echo $lr->lote_descripcion; ?>
					<br>
					<br>
					RECUERDE QUE ES TOTAL RESPONSABILIDAD DEL COMPRADOR REALIZAR VISITA TÉCNICA A LOS LOTES PARA CERCIORARSE DE SU ESTADO REAL ANTES DE OFERTAR. LAS FOTOS Y VIDEOS SON REFERENCIALES. RECUERDE REVISAR LAS CONDICIONES DE VENTA Y PAGO PARA ESTE REMATE. RE-REMATE NO SE RESPONSABILIZA DEL INCUMPLIMIENTO POR PARTE DEL CLIENTE COMPRADOR A TODAS LAS ADVERTENCIAS ANTERIORES. 
					<br>
					<br>
					Este portal se reserva el derecho de corrección de posibles errores de tecleo.
					<br>
					<br>
					<a href="<?php echo base_url('./uploads/files/'.$lr->lote_documento_adjunto); ?>" target="_blank">Haga clic aquí para ver y / o imprimir el archivo adjunto</a>
					<br>
					<a href="<?php echo $lr->lote_link_video; ?>" target="_blank">Haga clic aquí para ver el video adjunto</a>
					<br>
						<?php $fotos_del_lote = $this->lote_model->obtener_fotos_lote($lr->lote_id); ?>
						<?php if ( $fotos_del_lote): ?>
						<?php foreach ( $fotos_del_lote as $fl): ?>
							<?php if($fl['foto_url'] != null): ?>
							<a href="<?php echo base_url('./uploads/pictures/'.$fl['foto_url']); ?>" target="_blank">Haga clic aquí para ver y / o imprimir las fotos adjuntas</a>
							<br>
							<?php endif; ?>
						
						<?php endforeach; ?>
						<?php endif; ?>

					<?php endforeach; ?>
					<?php endif; ?>
				</div>	
				<?php endforeach; ?>
				<?php endif; ?>
				<br>
				<br>
				<div align="center">
				<b>Esta impresión está sujeta a cambios hasta el cierre de la subasta.Tiempo de impresión: <?php echo gmdate('d-m-Y H:i:s', time() + (3600*-3)); ?> America/Santiago(GMT -03:00)</b>
				</div>

			</div> <!-- /.row -->
		</div> <!-- /. container-fluid -->
	</body>
</html>