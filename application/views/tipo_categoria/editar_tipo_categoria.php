<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-edit"></i> Editar Tipo de <?php echo $categoria;?></h3>
			</div>
			<div class="panel-body">
				<form class="form" action="<?php echo site_url('tipo_categoria/editar/'.$this->uri->segment(3)); ?>" method="POST">
					<div class="col-md-12">
						
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" name="tipo_nombre" value="<?php echo set_value('nombre_tipo_categoria', $tipo_categoria->tipo_nombre); ?>" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group pull-right">
							<a href="<?php echo site_url('tipo_categoria/administrar/'); ?>"><button type="button" class="btn btn-default">Volver al administrador de categorías</button></a>
							<button type="submit" class="btn btn-primary">Editar Tipo de Categoría</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>