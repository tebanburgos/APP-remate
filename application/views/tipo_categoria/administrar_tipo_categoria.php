<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
			</div>
			<?php $categoria_id = $this->uri->segment(3); ?>
			<div class="col-md-6 pull-left text-left">
				<h4>Nombre de la categoría: <strong><?php echo $categoria->categoria_nombre; ?></strong></h4>
			</div>
			<div class="col-md-6 pull-right text-right">
				<a href="<?php echo site_url("categoria/administrar"); ?>"><button class="btn btn-default" style="margin-bottom: 10px;"><i class="fa fa-arrow-left"></i> Volver</button></a> <button class="btn btn-success" id="ingresar-un-tipo-de-categoria-t" data-toggle="modal" data-target="#ingresar_tipo_categoria" style="margin-bottom: 10px;"><i class="fa fa-plus-square"></i> Ingresar un Tipo de Categoría</button>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-building-o"></i> Administrador de Tipo de Categorías</h3>
			</div>
			<div class="panel-body">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Tipo de Categoría</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<?php if ( $sin_tipo->num_rows() > 0): ?>
						<?php foreach ($sin_tipo->result() as $st): ?>
						<tr>
							<td> <?php echo $st->tipo_nombre; ?> </td>
							<?php $id_tipo_estandar = $st->tipo_id; ?>
						</tr>
						<?php endforeach; ?>
						<?php else: ?>
							<td colspan="2"><p class="alert alert-warning">No existe ningún tipo en esta categoría. <br> Por favor ingréselas en el botón "Ingresar un Tipo de Categoría" directo de en la Base de datos. </p></td>
						<?php endif; ?>
						<?php if (is_object($tipos)){ ?>
						<?php if ( $tipos->num_rows() > 0): ?>
						<?php foreach ( $tipos->result() as $t): ?>
						<tr>
							<td><?php echo $t->tipo_nombre; ?></td>
							<td><a href="<?php echo site_url('tipo_categoria/editar/'.$t->tipo_id); ?>"><button class="btn btn-xs btn-success" id="editar-t" data-toggle="modal" data-target="#editar_categoria"><i class="fa fa-edit"></i> Editar</button></a> <a href="#" onclick="eliminar(<?php echo $t->tipo_id.','.$id_tipo_estandar; ?>);"><button class="btn btn-xs btn-danger" id="eliminar-t"><i class="fa fa-trash"></i> Eliminar</button></a></td>
						</tr>
						<?php endforeach; ?>
						<?php else: ?>
							<td colspan="2"><p class="alert alert-warning">No hay tipos de categorías.</p></td>
						<?php endif; ?>
						<?php  } else { ?>
						<div class="alert alert-warning">No se ha ingresado ningún tipo en esta categoría <br> Por favor ingréselas en el botón "Ingresar un Tipo de Categoría" o directo en la Base de datos. </div>
						<?php  } ?>
					</tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>

<script>
	function eliminar(tipo_id, id_tipo_estandar)
	{
		bootbox.confirm(' <strong>¿Está seguro de eliminar este tipo de categoría? </strong> <br>Si lo hace, todos los remates relacionados con este tipo de categoría pasarán a <i>"(<?php echo $categoria->categoria_nombre; ?> - sin tipo)"</i>.',
			function(result)
			{
				if ( result)
					{
						jQuery.ajax
						({
							dataType: 'json',
							type: 'post',
							url: '<?php echo site_url("tipo_categoria/eliminar"); ?>/'+tipo_id+'/'+id_tipo_estandar,
							success: function(r)
							{
								if ( r.success)
									{
										window.location.href = '<?php echo site_url("categoria/administrar"); ?>';
									}
								else
									{
										bootbox.alert('Ocurrió un error al eliminar este tipo de categoría');
									}
							},
						});
					location.reload(true);
					location.reload(true);
					location.reload(true);
					}
				else return;
				}
		);
	}
</script>
<!-- Ingresar categoría -->
<div class="modal fade" id="ingresar_tipo_categoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form class="form" action="<?php echo site_url('tipo_categoria/ingresar/'.$categoria_id); ?>" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Ingrese un tipo de categoría</h4>
				</div>
				<div class="modal-body">
					<input type="text" name="tipo_nombre" value="<?php echo set_value('tipo_nombre'); ?>" class="form-control">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Ingresar</button>
				</div>
			</form>
		</div>
	</div>
</div>