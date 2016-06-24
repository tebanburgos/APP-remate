		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">		
					<div class="row">
						<div class="col-md-6 col-md-offset-3">						
							<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>						
							<div class="panel panel-default panel-login">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-user"></i> Nueva Contraseña</h3>
								</div>
								<div class="panel-body">						
									<?php echo validation_errors(); ?>
									<?php mostrar_mensaje($mensaje, $mensaje_clase); ?>
									<p>Ingrese su nueva contraseña.</p>									
									<form action="<?php echo site_url('rematador/cambiar_clave/'.$this->uri->segment(3)); ?>" method="POST">
										<div class="form-group">
											<label><i class="fa fa-lock icolor"></i> Contraseña</label>
											<input name="clave" id="clave" class="form-control" placeholder="" type="password">
										</div>										
										<div class="form-group">
											<label><i class="fa fa-lock icolor"></i> Repetir Contraseña</label>
											<input name="clave_confirmar" id="clave_confirmar" class="form-control" placeholder="" type="password">
										</div>
										<button type="submit" class="btn btn-success" id="enviar-c">Enviar</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>