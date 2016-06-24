<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<link href="http://www.jasny.net/bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet">
 <script src="<?php echo base_url('js/fileinput.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/fileinput_locale_es.js'); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap-filestyle.min.js'); ?>"> </script>


<div class="col-md-8">
	<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
	<form id="contactForm1" class="form-horizontal" action="<?php echo site_url('rematador/registrar'); ?>" method="POST" enctype="multipart/form-data">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-edit"></i> Registro Rematador</h3>
			</div>
			
			<?php if($mensaje_error == "correcto"){ ?>
				
			<div class="alert alert-success">
				Registro Exitoso, le  hemos enviado un correo para que confirme su registro. <br />
				Una vez activado su usuario podra empezar a publicar remates.
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
				<?=$mensaje_error;?>
			</div>
			
			<div class="panel-body">

				<div class="row">
					<div class="col-md-5 col-md-offset-1">
						<div class="bg-primary titlereg">
							Informaci&oacute;n de la Empresa
						</div>

						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="rematador_razon_social"><small>*Raz&oacute;n Social</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="rematador_razon_social" name="rematador_razon_social" value="<?=$datos['rematador_razon_social'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="rematador_nombre_empresa"><small>*Nombre Comercial</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="rematador_nombre_empresa" name="rematador_nombre_empresa" value="<?=$datos['rematador_nombre_empresa'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="rematador_rut_empresa"><small>*Rut de la empresa</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="rematador_rut_empresa" name="rematador_rut_empresa" placeholder="ej: 12345678-9" value="<?=$datos['rematador_rut_empresa'];?>">
							</div>
						</div>

						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="rematador_nombre_responsable"><small>*Nombre Responsable</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="rematador_nombre_responsable" name="rematador_nombre_responsable" value="<?=$datos['rematador_nombre_responsable'];?>">
							</div>
						</div>
						
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="rematador_apellido_responsable"><small>*Apellido Responsable</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="rematador_apellido_responsable" name="rematador_apellido_responsable" value="<?=$datos['rematador_apellido_responsable'];?>">
							</div>
						</div>
						
						<div class="form-group form-group-sm">
						<label class="col-sm-5" for="rematador_rut_responsable"><small>*Rut Responsable</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="rematador_rut_responsable" name="rematador_rut_responsable" value="<?=$datos['rematador_rut_responsable'];?>">
							</div>
						</div>
						<input type="hidden" id="rematador_estado" name="rematador_estado" value="esperando">

					</div>
					<div class="col-md-5">
						<div class="bg-primary titlereg">Direcci&oacute;n Comercial</div>

						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="rematador_direccion"><small>*Direcci&oacute;n</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="rematador_direccion" name="rematador_direccion" placeholder="Direcci&oacute;n..." value="<?=$datos['rematador_direccion'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="rematador_ciudad"><small>*Ciudad</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="rematador_ciudad" name="rematador_ciudad" value="<?=$datos['rematador_ciudad'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="rematador_region"><small>*Regi&oacute;n</small></label>
							<div class="col-sm-6">
								<select class="form-horizontal input-sm" name="rematador_region" id="rematador_region" value="<?=$datos['rematador_region'];?>">
									<option value="">Seleccione una región</option>
									<?php $listado_regiones = $this->rematador_model->consultar_regiones(); ?>
									<?php foreach ( $listado_regiones->result() as $lg): ?>
									<option value="<?php echo $lg->region_id; ?>"><?php echo $lg->region_nombre; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="rematador_pais"><small>*Pa&iacute;s</small></label>
							<div class="col-sm-6">
								<input type="text" class="form-horizontal" id="rematador_pais" name="rematador_pais" value="Chile" value="<?=$datos['rematador_pais'];?>" readonly>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="rematador_telefono"><small>Tel&eacute;fono fijo</small></label>
							<div class="col-sm-4">
								<input type="text" class="form-horizontal" id="rematador_telefono" name="rematador_telefono" placeholder="ej: 221987654" value="<?=$datos['rematador_telefono'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="rematador_movil"><small>T&eacute;lefono Movil</small></label>
							<div class="col-sm-4">
								<input type="text" class="form-horizontal" id="rematador_movil" name="rematador_movil" placeholder="ej: 221987654" value="<?=$datos['rematador_movil'];?>">
							</div>
						</div>
						
						 <div class="form-group form-group-sm">
						 
							<label class="col-sm-5" for="rematador_foto"><small>Logo Empresa</small> <i class="glyphicon glyphicon-info-sign" id="col-md-5" data-toggle="tooltip" data-placement="right" title="Si no ingresa una fotografía el sistema le asignará una por defecto"></i> </label>
							<div class="col-sm-4">
								<input type="file" class="filestyle" data-input="false" name="rematador_foto">
							</div>
						</div>
						
					</div>



					</div>
				</div>
				<div class="row">
					<div class="col-md-5 col-md-offset-1">
						<div class="bg-primary titlereg">
							Registro de Usuario para ingresar a remates
						</div>

						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="rematador_correo"><small>*Email</small></label>
							<div class="col-sm-7">
								<input type="text" class="form-horizontal" id="rematador_correo" name="rematador_correo" placeholder="ej: email@gmail.com" value="<?=$datos['rematador_correo'];?>">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="rematador_password"><small>*Contrase&ntilde;a</small></label>
							<div class="col-sm-7">
								<input type="password" class="form-horizontal" id="rematador_password" name="rematador_password">
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label class="col-sm-5" for="rematador_password_2"><small>*Repetir Contrase&ntilde;a</small></label>
							<div class="col-sm-7">
								<input type="password" class="form-horizontal" id="rematador_password_2" name="rematador_password_2">
							</div>
						</div>



					</div>
					<div class="col-md-5">
						<div class="bg-primary titlereg">
							Informaci&oacute;n Adicional
						</div>

						<div class="form-group form-group-sm">
							<label class="col-sm-12" for="rematador_descripcion_activos"><small>Descripci&oacute;n Activos</small></label><br />
							<div class="col-sm-12">
								<textarea id="rematador_descripcion_activos" name="rematador_descripcion_activos" rows="4" class="form-horizontal col-md-10">
								<?=$datos['rematador_descripcion_activos'];?>
								</textarea>
   
							</div>
						</div>

					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">

						<div class="bg-primary titlereg">
							Terminos del Contrato
						</div>

						<label for="exampleInputEmail1">Favor leer el contrato, si est&aacute; de acuerdo seleccione <b>"Acepto"</b></small>
						</label>
						<div style="overflow: auto;">
						<textarea name="message" rows="8"  class="col-md-12"  readonly>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas quis aliquam est. Curabitur ac magna bibendum, mollis lectus sollicitudin, luctus justo. Aliquam nec venenatis justo. Duis tortor nulla, egestas et metus eget, fermentum ultrices lectus. Vestibulum et ornare lorem. Cras efficitur neque at convallis posuere. Donec interdum enim ac ultrices condimentum. Sed viverra, nisl in lacinia euismod, sapien augue laoreet velit, id mollis nisi erat at velit. Suspendisse potenti. Maecenas luctus interdum dapibus. Donec ac dolor id magna egestas rutrum. Aenean laoreet tellus quis purus accumsan, et accumsan neque pulvinar. Vivamus porta augue in mauris gravida vestibulum. Praesent viverra et nulla sit amet posuere. Fusce a purus maximus, laoreet mi at, fringilla nulla. Suspendisse vitae lectus pharetra, consectetur purus vitae, porta dui. Integer condimentum ultricies nibh nec euismod. In lectus dui, facilisis ut ex eu, vulputate laoreet lorem. Vivamus feugiat hendrerit sem dictum iaculis. Nunc laoreet, massa nec tempus mattis, tellus arcu porttitor nunc, nec placerat lorem diam id sem. Mauris odio lacus, tincidunt nec sollicitudin non, malesuada at ligula. Nunc aliquam nunc vitae eros tincidunt, in cursus nisl porttitor. Nulla facilisi. Pellentesque sem nulla, laoreet egestas sollicitudin sed, condimentum sit amet turpis. Cras suscipit nisi sed sapien ultricies ultrices. Aliquam erat volutpat. Nullam consequat metus sed eros faucibus laoreet. Fusce commodo id velit nec porta. Nulla pulvinar dui et mauris euismod, eu pellentesque diam luctus. Nulla sollicitudin lobortis dui a sodales. Suspendisse potenti. Etiam quis aliquet neque. Phasellus at nibh vitae nibh ornare malesuada. Aliquam consequat nunc sit amet nisi accumsan auctor. Morbi fermentum justo sed pellentesque pharetra. Fusce erat ante, eleifend sit amet dui in, viverra luctus velit. Vivamus semper sem in mi posuere ornare. In arcu ante, commodo ac augue et, ornare semper tellus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce vel viverra massa. Duis ac diam viverra, hendrerit augue ac, suscipit mauris. Curabitur tincidunt massa ut tortor dignissim finibus. Phasellus maximus vestibulum rhoncus. Donec feugiat, mauris sed iaculis convallis, purus quam commodo magna, non porttitor ligula massa et purus. Maecenas urna mi, lobortis ac lectus vitae, cursus mattis eros. Mauris eu purus eget risus pharetra cursus eget vel nisl. Aenean at tempus libero, eu ullamcorper leo. Integer pellentesque nibh vel tempor dignissim. Donec mi erat, luctus nec sem ut, viverra condimentum dui. Nulla accumsan luctus orci, vitae aliquam nisl tristique quis. Pellentesque interdum mauris augue. Cras dapibus feugiat condimentum. Praesent posuere elit id arcu pulvinar, in sollicitudin ligula pharetra. Cras et tellus sagittis eros iaculis cursus at quis massa. Morbi ultricies fringilla enim at posuere. Maecenas varius mollis viverra. Nam pulvinar luctus quam in luctus. Vestibulum id leo vitae elit eleifend pellentesque. Nunc eget finibus sem. Aenean nisi dui, faucibus nec nisl sed, sodales congue nunc. Morbi nisl est, dignissim ut quam at, sodales pellentesque est.
						</textarea>
						</div>
						<div class="checkbox">
							<label>
								<input name="rematador_contrato" type="checkbox" value="1"> Acepto las condiciones</small>
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
	</form>
</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<script>
$(":file").filestyle({input: false});
</script>