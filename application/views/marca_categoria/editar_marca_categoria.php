<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-edit"></i> Editar marca de <?php echo $categoria;?></h3>
			</div>
			<div class="panel-body">
				<form class="form" action="<?php echo site_url('marca_categoria/editar/'.$this->uri->segment(3)); ?>" method="POST">
					<div class="col-md-12">
						
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" name="marca_nombre" value="<?php echo set_value('nombre_marca_categoria', $marca_categoria->marca_nombre); ?>" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group pull-right">
							<a href="<?php echo site_url('marca_categoria/administrar/'); ?>"><button type="button" class="btn btn-default">Volver al administrador de categorías</button></a>
							<button type="submit" class="btn btn-primary">Editar marca de Categoría</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>