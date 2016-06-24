					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-edit"></i> Editar Categoría</h3>
								</div>
								<div class="panel-body">
									<form class="form" action="<?php echo site_url('categoria/editar/'.$this->uri->segment(3)); ?>" method="POST">
										<div class="col-md-12">
										<?php echo validation_errors(); ?>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" name="categoria_nombre" value="<?php echo set_value('categoria_nombre', $categoria->categoria_nombre); ?>" class="form-control">
													<input type="hidden" name="categoria_nombre_antiguo" value="<?php echo $categoria->categoria_nombre; ?>">
												</div>
											</div>
											<div class="col-md-6" align="center">											
												<div class="form-group pull-center">
												<a href="<?php echo site_url('categoria/administrar/'); ?>"><button type="button" class="btn btn-default btn-lg" id="volver-c">Volver</button></a>
												<button type="submit" class="btn btn-success btn-lg" id="editar-categoria-c">Editar categoría</button>
												</div>
											</div>
										</div>	
										<div class="row">
											<div class="col-md-12">
												<div class="col-md-6">
													<div class="panel panel-default">
														<div class="panel-heading">Tipos de <?php echo $categoria->categoria_nombre; ?> <a href="<?php echo site_url('tipo_categoria/administrar/'.$categoria->categoria_id); ?>"><button class="btn btn-xs btn-info" id="ver-tipos-t"><i class="fa fa-tags"></i> Ver tipos</button></a> </div>
														<?php $todos_los_tipos = ""; ?>
														<?php $tipos_nombre = $this->categoria_model->obtener_nombre_del_tipo_de_la_categoria($categoria->categoria_id); ?>
														<?php if (is_object($tipos_nombre)){ ?>
														<?php if ( $tipos_nombre->num_rows() > 0){ ?>
														<?php foreach ( $tipos_nombre->result() as $tn): ?>
														<?php $todos_los_tipos = $todos_los_tipos.', '.$tn->tipo_nombre; ?>
														<?php $todos_los_tipos = trim($todos_los_tipos, ' ,');?>
														<?php endforeach; ?>
														<?php } ?>
														  <div class="panel-body"><small><?php echo $todos_los_tipos ?></small></div>
														<?php  } else { ?>
														<div class="panel-body"><small>No se ha ingresado ningún tipo de <?php echo $categoria->categoria_nombre; ?> en esta categoría</small></div>
														<?php  } ?>
													</div>
												</div>
												<div class="col-md-6">
													<div class="panel panel-default">
														<div class="panel-heading">Marcas de <?php echo $categoria->categoria_nombre; ?> <a href="<?php echo site_url('marca_categoria/administrar/'.$categoria->categoria_id); ?>"><button class="btn btn-xs btn-info" id="ver-marcas-c"> ® Ver marcas</button></a> </div>
														<?php $todos_las_marcas = ""; ?>
														<?php $marcas_nombre = $this->categoria_model->obtener_nombre_de_las_marcas_de_la_categoria($categoria->categoria_id); ?>
														<?php if (is_object($marcas_nombre)){ ?>
														<?php if ( $marcas_nombre->num_rows() > 0){ ?>
														<?php foreach ( $marcas_nombre->result() as $mn): ?>
														<?php $todos_las_marcas = $todos_las_marcas.', '.$mn->marca_nombre; ?>
														<?php $todos_las_marcas = trim($todos_las_marcas, ' ,');?>
														<?php endforeach; ?>
														<?php } ?>
														<div class="panel-body"><small><?php echo $todos_las_marcas ?></small></div>
														<?php  } else { ?>
														<div style="padding-left:10px;"><small>No se ha ingresado ninguna marca en esta categoría</small></div>
														<?php  } ?>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>