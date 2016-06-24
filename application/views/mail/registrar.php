<div class="col-md-8">
	<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
	<form id="contactForm1" class="form-horizontal" action="<?php echo site_url('ofertante/registrar'); ?>" method="POST">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-edit"></i> Registro ofertante</h3>
			</div>
			
			<?php if($mensaje_error == "correcto"){ ?>
				
			<div class="alert alert-success">
				Registro Exitoso, le  hemos enviado un correo para que confirme su registro. <br />
				Una vez activado su usuario podra empezar a subastar remates.
			</div>
			
			<?php 	
			}
			else{
			?>
			
			<div class="alert alert-warning">
				<?php if ($correo == "existe") {
				?>
				<div class="alert alert-danger alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>El correo que ingreso ya existe en nuestra base de datos.</div>	
				<?php
				}
				?>
				
				<?php if ($nickname == "existe") {
				?>
				<div class="alert alert-danger alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>El alias que ingreso ya existe en nuestra base de datos.</div>	
				<?php
				}
				?>
				
				<?=$mensaje_error;?>
				
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-5 col-md-offset-1">
						<div class="bg-primary titlereg">
							Informaci&oacute;n Personal
						</div>

						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="ofertante_nombre_responsable"><small>*Nombre</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="ofertante_nombre" name="ofertante_nombre" value="<?=$datos['ofertante_nombre'];?>">
							</div>
						</div>
						
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="ofertante_apellido_responsable"><small>*Apellidos</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="ofertante_apellido" name="ofertante_apellido" value="<?=$datos['ofertante_apellido'];?>">
							</div>
						</div>
						
						<div class="form-group form-group-sm">
						<label class="col-sm-5" for="ofertante_rut_responsable"><small>*Rut</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="ofertante_rut" name="ofertante_rut" value="<?=$datos['ofertante_rut'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="ofertante_fono"><small>Tel&eacute;fono fijo</small></label>
							<div class="col-sm-4">
								<input type="text" class="form-horizontal" id="ofertante_fono" name="ofertante_fono" placeholder="ej: 221987654" onkeypress="javascript:return validarSoloNumero(event)" value="<?=$datos['ofertante_fono'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="ofertante_movil"><small>T&eacute;lefono Movil</small></label>
							<div class="col-sm-4">
								<input type="text" class="form-horizontal" id="ofertante_movil" name="ofertante_movil" placeholder="ej: 221987654" onkeypress="javascript:return validarSoloNumero(event)" value="<?=$datos['ofertante_movil'];?>">
							</div>
						</div>
						
						<input type="hidden" id="ofertante_estado" name="ofertante_estado" value="esperando">

					</div>
					<div class="col-md-5">
						<div class="bg-primary titlereg">Domicilio</div>

						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="ofertante_direccion"><small>*Direcci&oacute;n</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="ofertante_direccion" name="ofertante_direccion" placeholder="Direcci&oacute;n..." value="<?=$datos['ofertante_direccion'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="ofertante_ciudad"><small>*Ciudad</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="ofertante_ciudad" name="ofertante_ciudad" value="<?=$datos['ofertante_ciudad'];?>">
							</div>
						</div>
						
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="ofertante_region"><small>*Regi&oacute;n</small></label>
							<div class="col-sm-6">
								<select class="form-horizontal input-sm" name="ofertante_region" id="ofertante_region" value="<?=$datos['ofertante_region'];?>">
									<option value="">Seleccione una región</option>
									<?php $listado_regiones = $this->ofertante_model->consultar_regiones(); ?>
									<?php foreach ( $listado_regiones->result() as $lg): ?>
									<option value="<?php echo $lg->region_id; ?>"><?php echo $lg->region_nombre; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
												
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="ofertante_pais"><small>*Pa&iacute;s</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="ofertante_pais" name="ofertante_pais" value="Chile" value="<?=$datos['ofertante_pais'];?>" readonly>
							</div>
						</div>

					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="bg-primary titlereg">
							Datos de Acceso
						</div>

						<div class="form-group form-group-sm">
							<label class="col-md-5 col-md-offset-1" for="ofertante_correo"><small>*Email</small></label>
							<div class="col-md-5 col-md-offset-1">
								<input type="text" class="form-horizontal" id="ofertante_correo" name="ofertante_correo" placeholder="ej: email@gmail.com" value="<?=$datos['ofertante_correo'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-md-5 col-md-offset-1" for="ofertante_nickname"><small>*Nickname</small></label>
							<div class="col-md-5 col-md-offset-1">
								<input type="text" class="form-horizontal" id="ofertante_nickname" name="ofertante_nickname" placeholder="ej: usuario01" onkeypress="javascript:return validarCaracteres(event)" value="<?=$datos['ofertante_nickname'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-md-5 col-md-offset-1" for="ofertante_password"><small>*Contrase&ntilde;a</small></label>
							<div class="col-md-5 col-md-offset-1">
								<input type="password" class="form-horizontal" id="ofertante_password" name="ofertante_password">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-md-5 col-md-offset-1" for="ofertante_password_2"><small>*Repita Contrase&ntilde;a</small></label>
							<div class="col-md-5 col-md-offset-1">
								<input type="password" class="form-horizontal" id="ofertante_password_2" name="ofertante_password_2">
							</div>
						</div>

					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">

						<div class="bg-primary titlereg">
							Contrato
						</div>

						<label for="exampleInputEmail1">Favor leer el contrato, si est&aacute; de acuerdo seleccione <b>"Acepto"</b></small>
						</label>
						<br>
						<div style="overflow: auto;">
						<textarea name="message" rows="8"  class="col-md-12" readonly>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas quis aliquam est. Curabitur ac magna bibendum, mollis lectus sollicitudin, luctus justo. Aliquam nec venenatis justo. Duis tortor nulla, egestas et metus eget, fermentum ultrices lectus. Vestibulum et ornare lorem. Cras efficitur neque at convallis posuere. Donec interdum enim ac ultrices condimentum. Sed viverra, nisl in lacinia euismod, sapien augue laoreet velit, id mollis nisi erat at velit. Suspendisse potenti. Maecenas luctus interdum dapibus. Donec ac dolor id magna egestas rutrum. Aenean laoreet tellus quis purus accumsan, et accumsan neque pulvinar. Vivamus porta augue in mauris gravida vestibulum. Praesent viverra et nulla sit amet posuere. Fusce a purus maximus, laoreet mi at, fringilla nulla. Suspendisse vitae lectus pharetra, consectetur purus vitae, porta dui. Integer condimentum ultricies nibh nec euismod. In lectus dui, facilisis ut ex eu, vulputate laoreet lorem. Vivamus feugiat hendrerit sem dictum iaculis. Nunc laoreet, massa nec tempus mattis, tellus arcu porttitor nunc, nec placerat lorem diam id sem. Mauris odio lacus, tincidunt nec sollicitudin non, malesuada at ligula. Nunc aliquam nunc vitae eros tincidunt, in cursus nisl porttitor. Nulla facilisi. Pellentesque sem nulla, laoreet egestas sollicitudin sed, condimentum sit amet turpis. Cras suscipit nisi sed sapien ultricies ultrices. Aliquam erat volutpat. Nullam consequat metus sed eros faucibus laoreet. Fusce commodo id velit nec porta. Nulla pulvinar dui et mauris euismod, eu pellentesque diam luctus. Nulla sollicitudin lobortis dui a sodales. Suspendisse potenti. Etiam quis aliquet neque. Phasellus at nibh vitae nibh ornare malesuada. Aliquam consequat nunc sit amet nisi accumsan auctor. Morbi fermentum justo sed pellentesque pharetra. Fusce erat ante, eleifend sit amet dui in, viverra luctus velit. Vivamus semper sem in mi posuere ornare. In arcu ante, commodo ac augue et, ornare semper tellus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce vel viverra massa. Duis ac diam viverra, hendrerit augue ac, suscipit mauris. Curabitur tincidunt massa ut tortor dignissim finibus. Phasellus maximus vestibulum rhoncus. Donec feugiat, mauris sed iaculis convallis, purus quam commodo magna, non porttitor ligula massa et purus. Maecenas urna mi, lobortis ac lectus vitae, cursus mattis eros. Mauris eu purus eget risus pharetra cursus eget vel nisl. Aenean at tempus libero, eu ullamcorper leo. Integer pellentesque nibh vel tempor dignissim. Donec mi erat, luctus nec sem ut, viverra condimentum dui. Nulla accumsan luctus orci, vitae aliquam nisl tristique quis. Pellentesque interdum mauris augue. Cras dapibus feugiat condimentum. Praesent posuere elit id arcu pulvinar, in sollicitudin ligula pharetra. Cras et tellus sagittis eros iaculis cursus at quis massa. Morbi ultricies fringilla enim at posuere. Maecenas varius mollis viverra. Nam pulvinar luctus quam in luctus. Vestibulum id leo vitae elit eleifend pellentesque. Nunc eget finibus sem. Aenean nisi dui, faucibus nec nisl sed, sodales congue nunc. Morbi nisl est, dignissim ut quam at, sodales pellentesque est.
						</textarea>
						</div>
						<div class="checkbox">
							<label>
								<input name="ofertante_contrato" type="checkbox" value="1"> Acepto las condiciones</small>
							</label>
						</div>

					</div>
				</div>
				
				<hr>
				<div class="row">
					<div class="col-md-12" id="boton-registrar">
						<center>
							<input type="submit" class="btn btn-primary" value="REGISTRARSE" />

						</center>
					</div>
				</div>

			</div>
			
			<? } ?>
			
		</div>
	</form>
</div>
<script language="javascript">
	function validarCaracteres(e)
	{
		var key;
		if(window.event) // IE
			{
				key = e.keyCode;
			}
			else if(e.which) // Netscape/Firefox/Opera
			{
				key = e.which;
			}
			if (key < 48 || key > 57) // valida números
			{
				if(key < 97 || key > 122) // valida a-z
				{
					if(key == 8 || key == 95) // backspace (retroceso) y guión bajo
						{ return true; }
					else 
						{ return false; }
				}
			}
		return true;
	}
</script>

<script language="javascript">
	function validarSoloNumero(e)
	{
		var key;
		if(window.event) // IE
			{
				key = e.keyCode;
			}
			else if(e.which) // Netscape/Firefox/Opera
			{
				key = e.which;
			}
			if (key < 48 || key > 57) // valida números
			{
				if(key == 8) // backspace (retroceso) y guión bajo
					{ return true; }
				else 
					{ return false; }
		
			}
		return true;
	}
</script>