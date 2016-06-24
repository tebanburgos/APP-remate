		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<h3>Recuperar Contraseña</h3>
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
									<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
									<form action="<?php echo site_url('admin/recuperar_clave'); ?>" method="POST">
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
							<img src="http://re-remate.s2.imacom.cl/assets/img/logo.png" style="width: 50%; height: 50%; margin-right: -10px; margin-left: -9px; float: right; margin-top: -15px;">
						</div>
					</div>
				</div>
			</div>
		</div>
