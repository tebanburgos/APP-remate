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
									<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
									<?php $codigo_activador_ofertante = $this->uri->segment(3); ?>
									<label>Gracias por registrarse, <?php echo $this->ofertante_model->consultar_datos_ofertante_por_token_activacion($codigo_activador_ofertante, 'nombre');?>&nbsp;<?php echo $this->ofertante_model->consultar_datos_ofertante_por_token_activacion($codigo_activador_ofertante, 'apellido');?></label>
									
									<form action="<?php echo site_url('ofertante/activacion/'.$this->uri->segment(3)); ?>" method="POST">
										<div class="form-group">
											<p>Haga click en el botón para confirmar su registro</p>
											<input type="hidden" id="ofertante_estado" name="ofertante_estado" value="activo">
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