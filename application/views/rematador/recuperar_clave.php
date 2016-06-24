		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
							<h3>Recuperar Contraseña - Rematador</h3>
						</div>
					</div>		
					<div class="row">
						<div class="col-md-6">						
							<div class="panel panel-default panel-login">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-user"></i> Datos de Recuperación</h3>
								</div>
								<div class="panel-body">
									<?php echo validation_errors(); ?>
									<?php  mostrar_mensaje($mensaje, $mensaje_clase); ?>
									<form action="<?php echo site_url('rematador/recuperar_clave'); ?>" method="POST">
										<div class="row-fluid">
										<div class="span12">
										<form>
											<div class="form-group">
												<label><i class="fa fa-envelope"></i> Email</label>
												<input name="email" placeholder="" id="" type="email" class="form-control">
											</div>
											<button type="submit" class="btn btn-success">Cambiar Clave</button>
										</form>
										</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-md-6">						
							<p class="alert alert-info" style="margin-top: 0px;"><i class="fa fa-info fa-2x"></i> &nbsp;Ingrese el email con el cual se registró. Llegará a su correo un link para ingresar una nueva contraseña</p>
						</div>
					</div>
				</div>
			</div>
		</div>
