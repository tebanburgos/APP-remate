<div class="row">
	<div class="col-md-12">
		<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
		<div class="panel-body">
			<?php echo validation_errors(); ?>
			<?php $remate_codigo = $this->uri->segment(3); ?>
			<?php $remate_existencia = $this->remate_model->existe($remate_codigo); ?>
			<?php $rematador = $this->remate_model->obtener_rematador_del_remate($remate_codigo); ?>
			
			<?php if($remate_codigo == NULL or $remate_existencia == false or $rematador == NULL or $rematador != (int)$this->session->userdata('id')){ ?>
			<div class="col-md-6 col-md-offset-3">
				<div class="alert alert-info" align="center">
					Este remate no existe o ud. no tiene los permisos para acceder a este módulo
				</div>
				<div class="col-md-6 col-md-offset-5">
					<a href="<?php echo site_url('rematador/panel_de_control/'); ?>"><button type="button" class="btn btn-default btn-lg pull-left"> Volver</button></a>
				</div>
			</div>
			<?php
			}
			else
			{
			?>
			
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Lotes del remate </h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
								<th>Lote</th>
								<th>Tipo</th>
								<th>Marca</th>
								<th>Modelo</th>
								<th>Inicio</th>
								<th>Termina</th>
								<th>Visitas</th>
								<th>N° de pujas</th>
								<th>Puja mínima</th>
								<th>Incremento</th>
								<th>Valor actual</th>
								<th>Estado</th>
								<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php $listado_lotes = $this->remate_model->consultar_lotes_del_remate($remate_codigo); ?>
								<?php if ( $listado_lotes): ?>
								<?php foreach ( $listado_lotes->result() as $ll): ?>
								<tr>
									<td> <a href="<?php echo site_url('lote/ver/'.$ll->lote_id); ?>"> <?php echo $ll->lote_nombre; ?> </a> </td>
									<td><?php echo $this->remate_model->consultar_tipo_del_lote($ll->tipo_id); ?></td>
									<td><?php echo $this->remate_model->consultar_marca_del_lote($ll->marca_id); ?></td>
									<td><?php echo $ll->lote_modelo; ?></td>
									<td><?php echo date('d-m-Y H:i', strtotime($ll->lote_fecha_inicio)); ?></td>
									<td><?php echo date('d-m-Y H:i', strtotime($ll->lote_fecha_cierre)); ?></td>
									<td><?php echo number_format($ll->lote_contador_visita, 0, '', '.'); ?></td>
									<td><?php echo number_format($ll->lote_contador_puja, 0, '', '.'); ?></td>
									<td><?php echo number_format($ll->lote_puja_minima, 0, '', '.'); ?></td>
									<td><?php echo number_format($ll->lote_incremento, 0, '', '.'); ?></td>
									<td><?php echo number_format($ll->lote_valor_actual, 0, '', '.'); ?></td>
									<td><?php echo $ll->lote_estado; ?></td>
									<td> <a href="<?php echo site_url('/lote/editar/'.$ll->lote_id); ?>"><button class="btn btn-success btn-xs" id="editar-lote-l">Editar lote</button></a></td>
									<td> <button type="submit" class="btn btn-xs btn-danger" onclick="finalizar(<?php echo $ll->lote_id ?>);"> Finalizar</button></td>
								</tr>
								<?php endforeach; ?>
								<?php else: ?>
									<td colspan="12"><p align="center">No hay lotes creados</p></td>
								<tr>
								</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<? } ?>
		</div>
	</div>
</div>
<script>
function finalizar(lote_id)
{
	
	bootbox.confirm('¿Está seguro de finalizar el lote? <br>Al hacerlo, no podrá volver atrás. ', function(result){
if ( result)
{
	jQuery.ajax({
		dataType: 'json',
		type: 'post',
		url: '<?php echo site_url("remate/finalizar_lote/"); ?>/'+lote_id
	});
//	window.location.href = '<?php echo site_url("/rematador/panel_de_control/"); ?>';
	window.location = '<?php echo site_url("/remate/finalizar_lote"); ?>/'+lote_id;

}
else return;
});

}
</script>