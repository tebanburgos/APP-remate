					<div class="row">
						<div class="col-md-12">
							<div class="row">
								
								<div class="col-md-12">
									<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
								</div>
								<div class="col-md-6 pull-right text-right">
									<a href="<?php echo site_url('remate/ingresar/'); ?>"><button class="btn btn-success" style="margin-bottom: 10px;"><i class="fa fa-plus-square"></i> Ingresar Remate</button></a>
								</div>
							</div>
							<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title"><i class="fa fa-building-o"></i> Administrar Remates</h3>
							</div>
							<div class="panel-body">
								<table class="table">
									<thead>
										<tr>
										<th>Nombre</th>
										<th>Categoría</th>
										<th>Fecha de Inicio</th>
										<th>Fecha de Cierre</th>
										<th>Estado</th>
										<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										<?php if ( $remate->num_rows() > 0): ?>
										<?php foreach ( $remate->result() as $r): ?>
										<tr>
										<td><?php echo $r->remate_nombre; ?></td>
										<td><?php echo $r->categoria_id; ?></td>
										<td><?php echo $r->remate_fecha_inicio; ?></td>
										<td><?php echo $r->remate_fecha_termino; ?></td>
										<td><?php echo $r->remate_estado; ?></td>
										<td width="360"> <a href="<?php echo site_url('remate/etapas_info/'.$r->remate_id); ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-align-justify"></i> Revisar</button></a> <a href="<?php echo site_url('remate/ingresar_info/'.$r->remate_id); ?>"><button class="btn btn-info btn-xs"><i class="fa fa-plus-circle"></i> Agregar Info</button></a> <a href="<?php echo site_url('remate/editar/').'/'.$r->remate_id; ?>"><button class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Editar</button></a> <a href="#" onclick="eliminar(<?php echo $p->remate_id; ?>);"><button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Eliminar</button></a></td>
										</tr>
										<?php endforeach; ?>
										<?php else: ?>
										<tr>
										<td colspan="5"><p class="alert alert-warning">Aún no hay remates que mostrar</p></td>
										</tr>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
							</div>
						</div>
					</div>
					<script>
						function eliminar(remate_id)
						{
							bootbox.confirm('¿Está seguro de eliminar este remate? <br>Todas los lotes de esta subasta se perderán', function(result){
								if ( result)
								{
									jQuery.ajax({
										dataType: 'json',
										type: 'post',
										url: '<?php echo site_url("remate/eliminar"); ?>/'+remate_id,
										success: function(r){
											if ( r.success)
											{
												window.location.href = '<?php echo site_url("remate/administrar"); ?>';
											}
											else
											{
												bootbox.alert('Ocurrió un error al eliminar');
											}
										},
										error: function(){
											bootbox.alert('Ocurrió un error de conexión al eliminar');
										}
									});
								}
								else return;
							});
						}
					</script>					
