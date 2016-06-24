		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">		
					<div class="row">
						<div class="col-md-6">						
							<div class="panel panel-default panel-login">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-user"></i> Nueva Contraseña</h3>
								</div>
								<div class="panel-body">						
									<?php echo validation_errors(); ?>
									<?php mostrar_mensaje($mensaje, $mensaje_clase); ?>
									<p>Ingrese su nueva contraseña.</p>									
									<form action="<?php echo site_url('admin/cambiar_clave'); ?>" method="POST">
										<div class="form-group">
											<label><i class="fa fa-lock icolor"></i> Contraseña</label>
											<input name="clave" class="form-control" placeholder="" id="" type="password">
										</div>										
										<div class="form-group">
											<label><i class="fa fa-lock icolor"></i> Repetir Contraseña</label>
											<input name="clave_confirmar" class="form-control" placeholder="" id="" type="password">
											
										</div>
										<button type="submit" class="btn btn-success">Enviar</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>