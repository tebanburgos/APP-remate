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
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-edit"></i> Editar Lote</h3>
			</div>
			<div class="panel-body">
				<?php echo validation_errors(); ?>
				<?php $remate_codigo = $this->lote_model->consultar_id_del_remate_del_lote($this->uri->segment(3)); ?>
				
				<?php $rematador_codigo = $this->session->userdata('id'); ?>
				
				<?php $fecha_inicio_remate = date('d-m-Y H:i', strtotime($this->lote_model->consultar_fechas_del_remate($remate_codigo, 'inicio'))); ?>
				<?php $fecha_termino_remate = date('d-m-Y H:i', strtotime($this->lote_model->consultar_fechas_del_remate($remate_codigo, 'final'))); ?>
				
				<form class="form" action="<?php echo site_url('lote/editar_lote').'/'.$rematador_codigo.'/'.$remate_codigo; ?>" method="POST"  enctype="multipart/form-data">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
															
								<div class="form-group">
									
									<p class="help-block">Ud. está editando un lote en el remate <b><?php echo $this->lote_model->consultar_nombre_del_remate($remate_codigo);?></b></p>
									<p class="help-block">Este corresponde a la categoría <b><?php echo $this->lote_model->consultar_categoria_del_remate($remate_codigo, "nombre");?></b></p>
									<p class="help-block">En este remate está en el rango entre las fechas <h4><b style="color: red;"><?php echo $fecha_inicio_remate;?></b> y el <b style="color: red;"><?php echo $fecha_termino_remate;?></b></h4>.</p>
									<?php $categoria_codigo = $this->lote_model->consultar_categoria_del_remate($remate_codigo, "id"); ?>
									<?php $seleccionado = ""; ?>
									<?php $desactivado = ""; ?>
									<?php if($categoria_codigo == 8 or $categoria_codigo == 12) { ?>
										<?php $desactivado = "disabled"; ?>
									<?php } ?>
								</div>
								
								<div class="form-group">
									<label for="tipo_Remate">Seleccione tipo de lote</label>
									<select class="form-control" id="lote_tipo" name="lote_tipo" <?php echo $desactivado;?> required>
										<?php if ($desactivado == "") { ?>
										<?php echo ' <option value="">Seleccione un tipo de lote</option> ' ?>
										<?php } ?>
										<?php $listado_tipos = $this->lote_model->consultar_tipo_del_lote($remate_codigo); ?>
										<?php foreach ( $listado_tipos->result() as $lt): ?>
										<?php $checkado_tipo = ""; ?>
										<?php if($lote->tipo_id == $lt->tipo_id) $checkado_tipo = "selected"; ?>
										<option value="<?php echo $lt->tipo_id; ?>" <?php echo $checkado_tipo; ?>><?php echo $lt->tipo_nombre; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								
								<div class="form-group">
									<label for="tipo_Remate">Seleccione tipo de marca</label>
									<select class="form-control" id="lote_marca" name="lote_marca" <?php echo $desactivado;?> required>
										<?php if ($desactivado == "") { ?>
										<?php echo ' <option value="">Seleccione una marca de lote</option> ' ?>
										<?php } ?>
										<?php $listado_marca = $this->lote_model->consultar_marca_del_lote($remate_codigo); ?>
										<?php foreach ( $listado_marca->result() as $lm): ?>
										<?php $checkado_marca = ""; ?>
										<?php if($lote->marca_id == $lm->marca_id) $checkado_marca = "selected"; ?>
										<option value="<?php echo $lm->marca_id; ?>" <?php echo $checkado_marca; ?>><?php echo $lm->marca_nombre; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							
								<div class="form-group">
									<label for="tipo_Remate"> Modelo</label>
									<input type="text" class="form-control" name="lote_modelo" id="lote_modelo" value="<?php echo $lote->lote_modelo; ?>" />
								</div>
																
								<div class="form-group">
									<label for="lote_descripcion">Descripción</label>
									<textarea class="form-control" rows="4" id="lote_descripcion" name="lote_descripcion" required><?php echo $lote->lote_descripcion; ?></textarea>
								</div>
										
								<div class="form-group">
									<label for="lote_fecha_inicio">Fecha y hora de inicio del lote</label>
									<div class='input-group date' id='fecha_inicio'>
										<input type='text' name="lote_fecha_inicio" class="form-control" value="<?php echo date('d-m-Y H:i', strtotime($lote->lote_fecha_inicio)); ?>" disabled>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
									
								</div>
										
								<div class="form-group">
									<label for="lote_fecha_termino">Fecha y hora de término del lote</label>
									<div class='input-group date' id='fecha_termino'>
										<input type='text' name="lote_fecha_termino" class="form-control" value="<?php echo date('d-m-Y H:i', strtotime($lote->lote_fecha_cierre)); ?>" disabled>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
									
							<div class="col-md-6">									
							
								<div class="form-group">
									<label for="lote_puja_minima">Puja mínima</label> <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="El mínimo que consideraría para subastar este producto"></i>
									<input type="text" class="form-control" name="lote_puja_minima" id="lote_puja_minima" value="<?php echo number_format($lote->lote_puja_minima, 0, '', '.'); ?>" onkeypress="javascript:return validarSoloNumero(event)" onchange="separadorDeMiles(this)" required/>
								</div>
										
								<div class="form-group">
									<label for="lote_incremento">Incremento</label> <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="El aumento mínimo para ofertar este producto"></i>
									<input type="text" class="form-control" name="lote_incremento" id="lote_incremento" value="<?php echo number_format($lote->lote_incremento, 0, '', '.'); ?>" onkeypress="javascript:return validarSoloNumero(event)" onchange="separadorDeMiles(this)" required/>
								</div>
										
								<div class="form-group">
									<label for="lote_documento_adjunto">Adjuntar archivo de información adicional</label> <i class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Documento que valida la integridad de artículo que se está ofertando"></i>
									<input type="file" id="lote_documento_adjunto" name="lote_documento_adjunto" required>
									<p class="help-block">Los documentos permitidos son PNG, JPG, DOC, PDF. y no debe pesar más de 7MB</p>
								</div>
								
								<div class="form-group">
									<label for="remate_imagen">Documento previo del archivo adjunto</label>
									<br>
									<p><a href="<?php echo base_url('uploads/files').'/'.$lote->lote_documento_adjunto; ?>" target="_blank">Click para ver el archivo adjunto</a></p>
								</div>

								<div class="form-group">
									<label for="lote_link_video">Video promocional</label>
									<input type="text" class="form-control" name="lote_link_video" id="lote_link_video" value="<?php echo $lote->lote_link_video; ?>" />
								</div>
										
								<div class="form-group">
									<label for="lote_adjuntar_foto">Adjuntar fotografía</label>
									<input type="file" id="lote_adjuntar_foto" name="lote_adjuntar_foto_1" required>
									<input type="file" id="lote_adjuntar_foto" name="lote_adjuntar_foto_2" >
									<input type="file" id="lote_adjuntar_foto" name="lote_adjuntar_foto_3" >
									<input type="file" id="lote_adjuntar_foto" name="lote_adjuntar_foto_4" >
									<input type="file" id="lote_adjuntar_foto" name="lote_adjuntar_foto_5" >
									<p class="help-block">Debe adjuntar al menos una foto. Los documentos permitidos son .PNG y .JPG y no debe pesar más de 2MB</p>
								</div>
								
								<div class="form-group">
									<label for="lote_foto_adjuntada">Imágenes previas adjuntadas</label>
									<div>
									<?php $listado_fotos = $this->lote_model->obtener_fotos_lote($this->uri->segment(3)) ?>
									<?php foreach ( $listado_fotos as $lf): ?>
									<?php if($lf['foto_url'] != null) { ?>
									<a href="<?php echo base_url('uploads/pictures').'/'.$lf['foto_url']; ?>" target="_blank"><img src="<?php echo base_url('uploads/pictures').'/'.$lf['foto_url']; ?>" style="width: 170px;height: 90px;"></a>
									<?php } ?>
									<?php endforeach; ?>
									</div>
								</div>
								
							</div>
									
							<div class="col-md-12">
								<button type="submit" class="btn btn-success btn-lg pull-right"><i class="fa fa-plus"></i> Editar lote</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
				
<script>
	$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip(); 
	});
</script>

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
				if(key == 8) // backspace (retroceso) y guión bajo
					{ return true; }
				else 
					{ return false; }
		
			}
		return true;
	}
</script>