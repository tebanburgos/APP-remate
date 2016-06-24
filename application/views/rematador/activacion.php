		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-body">		
					<div class="row">
						<div class="col-md-12" align="center">
							<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
							<div class="panel panel-default panel-login">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-user"></i> Activación de usuario</h3>
								</div>
								<div class="panel-body">						
									<?php echo validation_errors(); ?>
									<?php mostrar_mensaje($mensaje, $mensaje_clase); ?>
									<?php $codigo_activador_rematador = $this->uri->segment(3); ?>
									<label>Gracias por registrarse, <?php echo $this->rematador_model->consultar_datos_rematador_por_token_activacion($codigo_activador_rematador, 'nombre');?>&nbsp;<?php echo $this->rematador_model->consultar_datos_rematador_por_token_activacion($codigo_activador_rematador, 'apellido');?></label>
									
									<form action="<?php echo site_url('rematador/activacion/'.$this->uri->segment(3)); ?>" method="POST">
										<div class="form-group">
											<p>Haga click en el botón para confirmar su registro</p>
											<input type="hidden" id="rematador_estado" name="rematador_estado" value="activo">
										</div>										
										<button type="submit" class="btn btn-success">Confirmar registro</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>