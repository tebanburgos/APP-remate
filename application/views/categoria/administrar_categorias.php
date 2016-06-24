<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
			</div>
			<div class="col-md-6 pull-right text-right">
				<button class="btn btn-success" id="ingresar-categoria-c" data-toggle="modal" data-target="#ingresar_categoria" style="margin-bottom: 10px;"><i class="fa fa-plus-square"></i> Ingresar Categoría</button>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-building-o"></i> Administrador de Categorías</h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>Categoría</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<?php $sin_categoria = $this->categoria_model->obtener_la_primera_categoria() ?>
						<?php if ( $sin_categoria->num_rows() > 0): ?>
						<?php foreach ($sin_categoria->result() as $sc): ?>
						<tr>
							<td> <?php echo $sc->categoria_nombre; ?> </td>
						</tr>
						<?php endforeach; ?>
						<?php else: ?>
							<td colspan="2"><p class="alert alert-warning">No existe ningún tipo de categoría. <br> Debe agregar categorías en la Base de Datos. </p></td>
						<?php endif; ?>
						<?php $categoria = $this->categoria_model->obtener_categorias(); ?>
						<?php if ( $categoria->num_rows() > 0): ?>
						<?php foreach ( $categoria->result() as $c): ?>
						<tr>
							<td>
								<?php echo $c->categoria_nombre; ?>
								
								<?php $todos_los_tipos = ""; ?>
								<?php $tipos_nombre = $this->categoria_model->obtener_nombre_del_tipo_de_la_categoria($c->categoria_id); ?>
								<?php if (is_object($tipos_nombre)){ ?>
								<?php if ( $tipos_nombre->num_rows() > 0){ ?>
								<?php foreach ( $tipos_nombre->result() as $tn): ?>
								<?php $todos_los_tipos = $todos_los_tipos.', '.$tn->tipo_nombre; ?>
								<?php $todos_los_tipos = trim($todos_los_tipos, ' ,');?>
								<?php endforeach; ?>
								<?php } ?>
								<div align="justify" style="padding-left:10px; width:750px;"><small><i>Tipos de <?php echo $c->categoria_nombre; ?>:</i> <?php echo $todos_los_tipos ?></small></div>
								<?php  } else { ?>
								<div style="padding-left:10px;"><small>No se ha ingresado ningún tipo en esta categoría</small></div>
								<?php  } ?>
								
								<?php $todos_las_marcas = ""; ?>
								<?php $marcas_nombre = $this->categoria_model->obtener_nombre_de_las_marcas_de_la_categoria($c->categoria_id); ?>
								<?php if (is_object($marcas_nombre)){ ?>
								<?php if ( $marcas_nombre->num_rows() > 0){ ?>
								<?php foreach ( $marcas_nombre->result() as $mn): ?>
								<?php $todos_las_marcas = $todos_las_marcas.', '.$mn->marca_nombre; ?>
								<?php $todos_las_marcas = trim($todos_las_marcas, ' ,');?>
								<?php endforeach; ?>
								<?php } ?>
								<div align="justify" style="padding-left:10px; width:750px;"><small><i>Marcas de <?php echo $c->categoria_nombre; ?>:</i> <?php echo $todos_las_marcas ?></small></div>
								<?php  } else { ?>
								<div style="padding-left:10px;"><small>No se ha ingresado ninguna marca en esta categoría</small></div>
								<?php  } ?>
								
							</td>
							<td>
								<a href="<?php echo site_url('categoria/editar/'.$c->categoria_id); ?>"><button class="btn btn-xs btn-success" id="editar-e" data-toggle="modal" data-target="#editar_categoria"><i class="fa fa-edit"></i> Editar</button></a>
								<a href="#" onclick="eliminar(<?php echo $c->categoria_id; ?>);"><button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Eliminar</button></a>
								<a href="<?php echo site_url('tipo_categoria/administrar/'.$c->categoria_id); ?>"><button class="btn btn-xs btn-primary"><i class="fa fa-tags"></i> Ver tipos</button></a>
								<a href="<?php echo site_url('marca_categoria/administrar/'.$c->categoria_id); ?>"><button class="btn btn-xs btn-info" id="ver-marca-m">® Ver marcas</button></a>
							</td>
						</tr>
						<?php endforeach; ?>
						<?php else: ?>
						<td colspan="2"><p class="alert alert-warning">No hay categorías.</p></td>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	function eliminar(categoria_id)
	{
		bootbox.confirm(' <strong>¿Está seguro de eliminar este categoría? </strong> <br>Si lo hace, todos los remates, tipos y marcas relacionadas con esta categoría pasarán a la categoría a <i>"(Sin Categoría)"</i>.',
			function(result)
			{
				if ( result)
					{
						jQuery.ajax
						({
							dataType: 'json',
							type: 'post',
							url: '<?php echo site_url("categoria/eliminar"); ?>/'+categoria_id,
							success: function(r)
							{
								if ( r.success)
									{
										window.location.href = '<?php echo site_url("categoria/administrar"); ?>';
									}
								else
									{
										bootbox.alert('Ocurrió un error al eliminar la categoría');
									}
							},
							error: function()
							{
								bootbox.alert('Ocurrió un error de conexión al eliminar la categoría');
							}
						});
					}
				else return;
				}
		);
	}
</script>
<!-- Ingresar categoría -->
<div class="modal fade" id="ingresar_categoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form class="form" action="<?php echo site_url('categoria/ingresar'); ?>" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Ingrese una categoría</h4>
				</div>
				<div class="modal-body">
					<input type="text" name="categoria_nombre" value="<?php echo set_value('categoria_nombre'); ?>" class="form-control">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Ingresar</button>
				</div>
			</form>
		</div>
	</div>
</div>