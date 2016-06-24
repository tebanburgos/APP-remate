		<div class="col-md-8">			
		
			<div class="panel-body">
			<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
			<div class="row">
				<div class="col-md-12">
					<h3 style="margin-top: 0;">Login Ofertante</h3>
				</div>
			</div>		
			<div class="row">
				<div class="col-md-10" align="center">
					<div class="panel panel-default panel-login">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-user"></i> Acceda a su cuenta</h3>
						</div>
						<div class="panel-body">
							<?php echo validation_errors(); ?>
							<form role="form" action="<?php echo site_url('ofertante/accesar'); ?>" method="POST">
								<fieldset>
									<div class="form-group">
										<input class="form-control" placeholder="E-mail" name="ofertante_correo" type="email" autofocus="">
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Contraseña" name="ofertante_password" type="password" value="">
										<div class="pull-right"><small><a href="<?php echo site_url('ofertante/recuperar_clave'); ?>">Olvidé mi contraseña</a></small></div>
									</div>
									
									<div class="checkbox">
										<label>
											<input name="remember_me" type="checkbox" value="Remember Me">Remember Me
										</label>
									</div>
									
									<button type="submit" class="btn btn-sm btn-success" id="entrar-o"><i class="fa fa-arrow-circle-right"></i> Entrar</button>
								</fieldset>
							</form>
						</div>
					</div>
					<div align="center">
					<a href=" <?php echo base_url(); ?> " >« Volver a Inicio | Re-Remate</a>
					</div>
				</div>
			</div>
			
			</div>
			
		</div>	