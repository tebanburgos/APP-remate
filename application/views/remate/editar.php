<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.js"></script><style type="text/css"></style>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
	<script type="text/javascript" src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css">
  <style type="text/css">
  </style>
  
</head>
	
<div class="row">
	<div class="col-md-12">
		<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-edit"></i> Editar Remate</h3>
			</div>
			<div class="panel-body">
				<?php echo validation_errors(); ?>
				<form class="form" action="<?php echo site_url('remate/editar_remate').'/'.$this->uri->segment(3); ?>" method="POST" enctype="multipart/form-data">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">

									<label for="categoria">Categoría</label>
									<select class="form-control" id="categoria" name="categoria" required>
										<option value="">Seleccione una categoría</option>
										<?php $listado_categorias = $this->categoria_model->obtener_categorias(); ?>
										<?php foreach ( $listado_categorias->result() as $lc): ?>
										<?php $checkado = ""; ?>
										<?php if($remate->categoria_id == $lc->categoria_id) $checkado = "selected"; ?>
										<option value="<?php echo $lc->categoria_id; ?>" <?php echo $checkado; ?>><?php echo $lc->categoria_nombre; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								
								<input type="hidden" id="rematador" name="rematador" value="<?php echo $this->session->userdata('id'); ?>" />
										
								<div class="form-group">
									<label for="remate_nombre">Nombre del remate</label>
									<input type="text" class="form-control" name="remate_nombre" id="remate_nombre" value="<?php echo $remate->remate_nombre; ?>" required/>
								</div>
								
								<div class="form-group">
									<label for="remate_comuna">Comuna en dónde se realizará el remate</label>
									<input type="text" class="form-control" name="remate_comuna" id="remate_comuna" value="<?php echo $remate->remate_comuna; ?>" required/>
								</div>
										
								<div class="form-group">
									<label for="remate_direccion">Dirección del remate</label>
									<input type="text" class="form-control" name="remate_direccion" id="remate_direccion" value="<?php echo $remate->remate_direccion; ?>" required/>
								</div>
								<div class="form-group">
									<label for="remate_nombre_mandante">Nombre de mandante</label>
									<input type="text" class="form-control" name="remate_nombre_mandante" id="remate_nombre_mandante" value="<?php echo $remate->remate_nombre_mandante; ?>" required/>
								</div>
								
								<div class="form-group">
									<label for="remate_imagen">Imagen de caluga</label> <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Imagen que representará el remate"></i>
									<input type="file" id="remate_imagen" name="remate_imagen">
									<p class="help-block">el archivo permitido debe ser PNG, JPG o JPEG. y no debe pesar más de 2MB</p>
								</div>
								<div class="form-group">
									<label for="remate_imagen">Imagen previa de caluga</label>
									<a class="navbar-brand" href="<?php echo base_url('uploads/pictures/rematadores').'/'.$remate->remate_imagen; ?>" target="_blank"><img src="<?php echo base_url('uploads/pictures/rematadores').'/'.$remate->remate_imagen; ?>" style="width: 170px;height: 90px;"></a>
								</div>
							</div>
								
							<div class="col-md-6">
								<div class="form-group">
									<label for="remate_fecha_inicio">Fecha y hora de inicio del remate</label>
									<div class='input-group date' id='fecha_inicio'>
										<input type='text' name="remate_fecha_inicio" class="form-control" value="<?php echo date('d-m-Y H:i', strtotime($remate->remate_fecha_inicio)); ?>" disabled>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
								
								<div class="form-group">
									<label for="remate_fecha_termino">Fecha y hora de término del remate</label>
									<div class='input-group date' id='fecha_termino'>
										<input type='text' name="remate_fecha_termino" class="form-control" value="<?php echo date('d-m-Y H:i', strtotime($remate->remate_fecha_termino)); ?>" disabled>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
								
								<div class="form-group">
									<label for="remate_plazo_garantia">Fecha plazo de garantía del remate</label>
									<div class='input-group date' id='fecha_plazo_garantia'>
										<input type='text' name="remate_plazo_garantia" class="form-control" value="<?php echo date('d-m-Y', strtotime($remate->remate_plazo_garantia)); ?>" disabled>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
								
								<div class="form-group">
									<label for="remate_precio_garantia">Precio de la garantía</label>
									<input type="text" class="form-control" name="remate_precio_garantia" id="remate_precio_garantia" value="<?php echo number_format($remate->remate_precio_garantia, 0, '', '.'); ?>" onkeypress="javascript:return validarSoloNumero(event)" onchange="separadorDeMiles(this)" required/>
								</div>
								
								<div class="form-group">
									<label for="remate_descripcion">Descripción del remate</label>
									<textarea class="form-control" rows="4" id="remate_descripcion" name="remate_descripcion" required><?php echo $remate->remate_descripcion; ?></textarea>
								</div>
								
							</div>
									
						</div>
					</div>
							
					<div class="col-md-12">
						<button type="submit" class="btn btn-success btn-lg pull-right" id="editar-lote-l"><i class="fa fa-plus"></i> Editar remate</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
function separadorDeMiles(input)
{
var num = input.value.replace(/\./g,'');
if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
input.value = num;
}
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
				if(key == 8) // backspace (retroceso)
					{ return true; }
				else 
					{ return false; }
		
			}
		return true;
	}
</script>