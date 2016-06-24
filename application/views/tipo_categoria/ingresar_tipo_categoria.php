					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title"><i class="fa fa-building-o"></i> Ingresar Tipo de Categoría</h3>
							</div>
							<div class="panel-body">
							<form class="form" action="<?php echo site_url('tipo_categoria/ingresar'); ?>" method="POST">
									<div class="col-md-12">
									<?php echo validation_errors(); ?>
									</div>									
										<div class="col-md-6">
											<div class="form-group">
												<input type="text" name="tipo_categoria_nombre" value="<?php echo set_value('tipo_categoria_nombre'); ?>" class="form-control">
											</div>
										</div>
										<div class="col-md-6">											
											<div class="form-group">
												<button type="submit" class="btn btn-default pull-right">Ingresar</button>
											</div>
										</div>
								</form>
							</div>
							</div>
						</div>
					</div>