<div class="col-md-10">
	<div class="panel-body">
        <div class="row">
            <div class="col-md-12">
				<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
                <h3 style="margin-top: 0;">Bienvenido a tu cuenta, <?php echo $this->session->userdata('nombre') ?></h3>
                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Panel de Ventas</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <ul>
                                    <a href="<?php echo site_url('remate/ingresar/'); ?>"><li>Crear Remates</li></a>
									<a href="<?php echo site_url('lote/seleccionar/'); ?>"><li>Crear Lotes</li></a>
									<a href="<?php echo site_url('lote/seleccionar_importacion/'); ?>"><li>Importar Lotes (CSV)</li></a>
                                </ul>
                            </div>
                        </div>
                    </div>
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Categorías</h3>
						</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <ul>
                                    <li><a href="<?php echo site_url("categoria/administrar"); ?>">Administrador de Categorías</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
					<div class="panel panel-info">

                        <div class="panel-heading">
                            <h3 class="panel-title">Garantías</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <ul>
                                    <li><a href="<?php echo site_url('/garantia/panel/'); ?>">Panel de Garantías</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
					
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Historial</h3>
                        </div>
                        <div class="panel-body">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
										<th>Remate</th>
										<th>Categoría</th>
										<th>Mandante</th>
										<th>Comuna</th>
										<th>Inicio</th>
										<th>Termina</th>
										<th>Visitas</th>
										<th>Ofertas</th>
										<th>Estado</th>
										<th>Lotes</th>
										<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										<?php $listado_remates = $this->rematador_model->consultar_remates_del_rematador($this->session->userdata('id')); ?>
										<?php if ( $listado_remates): ?>
										<?php foreach ( $listado_remates->result() as $lr): ?>
										<tr>
											<td> <a href="<?php echo site_url('remate/ver/'.$lr->remate_id); ?>"> <?php echo $lr->remate_nombre; ?> </a> </td>
											<td><?php echo $this->rematador_model->saber_categoria_del_remate($lr->categoria_id); ?></td>
											<td><?php echo $lr->remate_nombre_mandante; ?></td>
											<td><?php echo $lr->remate_comuna; ?></td>
											<td><?php echo date('d-m-Y H:i', strtotime($lr->remate_fecha_inicio)); ?></td>
											<td><?php echo date('d-m-Y H:i', strtotime($lr->remate_fecha_termino)); ?></td>
											<td><?php echo $lr->remate_contador_visitas; ?></td>
											<td><?php echo $lr->remate_contador_ofertas; ?></td>
											<td><?php echo $lr->remate_estado; ?></td>
											<td> <a href="<?php echo site_url('/remate/ver_lotes/'.$lr->remate_id); ?>"><button class="btn btn-primary btn-xs">Ver lotes</button></a></td>
											<td> <a href="<?php echo site_url('/remate/editar/'.$lr->remate_id); ?>"><button class="btn btn-success btn-xs" id="editar-remate-r">Editar remate</button></a></td>
											<td> <button type="submit" class="btn btn-xs btn-danger" onclick="finalizar(<?php echo $lr->remate_id ?>);"> Finalizar</button></td>
										</tr>
										<?php endforeach; ?>
										<?php else: ?>
										<tr>
											<td colspan="12"><p class="alert alert-warning" align="center">No hay remates creados</p></td>
										</tr>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Configuración</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <ul>
                                    <li><a href="<?php echo site_url('/rematador/recuperar_clave/'); ?>">Cambiar Contraseña</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
					
					
					
                </div>
                <div align="center">
                    #
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function finalizar(remate_id)
{
	
	bootbox.confirm('¿Está seguro de finalizar el remate? <br>Al hacerlo, todos los lotes en él finalizarán también y no podrá volver atrás. ', function(result){
if ( result)
{
	jQuery.ajax({
		dataType: 'json',
		type: 'post',
		url: '<?php echo site_url("remate/finalizar_remate/"); ?>/'+remate_id
	});
//	window.location.href = '<?php echo site_url("/rematador/panel_de_control/"); ?>';
	window.location = '<?php echo site_url("/remate/finalizar_remate"); ?>/'+remate_id;

}
else return;
});

}
</script>
	      



        


