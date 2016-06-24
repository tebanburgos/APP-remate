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
				<h3 class="panel-title"><i class="fa fa-edit"></i> Ingresar Lote Masivo</h3>
			</div>
			<div class="panel-body">
				<?php echo validation_errors(); ?>
				<?php $remate_existencia = $this->remate_model->existe($remate_codigo); ?>
				
				<?php if($remate_codigo == NULL){ ?>
				<div class="col-md-6 col-md-offset-3">
					<div class="alert alert-info" align="center">
						Este remate no existe
						<br>
						Por favor, inténtelo nuevamente
					</div>
					<div class="col-md-6 col-md-offset-5">
						<a href="<?php echo site_url('rematador/panel_de_control/'); ?>"><button type="button" class="btn btn-default btn-lg pull-left" id="volver-pc"> Volver</button></a>
					</div>
				</div>
				<?php
				}
				else
				{
				?>
				
				<form method="POST" enctype="multipart/form-data" action="<?php echo site_url('lote/ingresar_lote_masivo');?>" >
					<div class="col-md-12">
						<div class="row">
							<input type="hidden" id="remate_id" name="remate_id" value="<?=$remate_codigo?>" />
							<input type="file" id="lote_documento_adjunto" name="lote_documento_adjunto" required>
						</div>
					</div>
					<p>&nbsp;</p>
					<div class="col-md-12">
						<div class="row">
							<input type="submit" class="btn btn-success" id="enviar-lm" />
						</div>
					</div>
				</form>
				
				<?
				}
				?>
				
			</div>
		</div>
	</div>
</div>
				
<script>
	$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip(); 
	});
</script>


<script type="text/javascript">
    $(function () {
        $('#fecha_inicio').datetimepicker();
        $('#fecha_termino').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#fecha_inicio").on("dp.change", function (e) {
            $('#fecha_termino').data("DateTimePicker").minDate(e.date);
        });
        $("#fecha_termino").on("dp.change", function (e) {
            $('#fecha_inicio').data("DateTimePicker").maxDate(e.date);
        });
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