<!-- Include Bootstrap Datepicker -->
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>        
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.4.0/lang/en-gb.js"></script>                
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.0.0/js/bootstrap-datetimepicker.min.js"></script>`

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
<script>
  webshims.setOptions('waitReady', false);
  webshims.setOptions('forms-ext', {types: 'date'});
  webshims.polyfill('forms forms-ext');
</script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

<style type="text/css">
/**
 * Override feedback icon position
 * See http://formvalidation.io/examples/adjusting-feedback-icon-position/
 */
#dateRangeForm .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>				
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-edit"></i> Ingresar lote a un remate</h3>
			</div>
			<div class="panel-body">
			<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
				<?php echo validation_errors(); ?>
				<?php $rematador_id = $this->session->userdata('id'); ?>
				<form class="form" action="<?php echo site_url('lote/ingresar_masivo'); ?>" method="POST">
					<div class="col-md-12" align="center">
						
							<div class="col-md-6 col-md-offset-3">
							<?php $listado_remates = $this->lote_model->consultar_remates_del_rematador($rematador_id); ?>
							<?php if($listado_remates == NULL){ ?>
								<div class="alert alert-info">
									Ud. no ha creado ningún remate aún o los que tiene han expirado.
								</div>
							<div class="col-md-6 col-md-offset-5">
								<a href="<?php echo site_url('rematador/panel_de_control/'); ?>"><button type="button" class="btn btn-default btn-lg pull-left"> Volver</button></a>
							</div>
							<?php
							}
							else {
							?>
								
								<div class="form-group">
									<label for="tipo_Remate">Seleccione un remate</label>
									<input type="hidden" id="rematador" name="rematador" value="<?php echo $rematador_id ?>" />
									<select class="form-control" id="remate_lista" name="remate_lista" required>
										<option value="">Seleccione un remate</option>
										<?php foreach ( $listado_remates->result() as $lr): ?>
										<option value="<?php echo $lr->remate_id; ?>"><?php echo $lr->remate_nombre; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>	
								
								
							<div class="col-md-6 col-md-offset-3">
								<a href="<?php echo site_url('rematador/panel_de_control/'); ?>"><button type="button" class="btn btn-default btn-lg pull-left" id="volver-pc"> Volver</button></a>
								<button type="submit" class="btn btn-success btn-lg pull-right" id="ingresar-lote-a-ese-remate-l"> Ingresar lote a ese remate</button>
							</div>
							
							<? } ?>
						
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
						jQuery.datepicker.setDefaults( $.datepicker.regional[ "es" ] );
						jQuery(document).ready(function(){
						jQuery('.datepicker').datepicker({dateFormat: "yy-mm-dd"});
						});
					</script>
				
					
					
					
					
					<script>

						$(document).ready(function() {
							$('#dateRangePicker')
								.datepicker({
									format: 'dd/mm/yyyy',
									startDate: '01/01/2010',
									endDate: '12/30/2020'
								})
								.on('changeDate', function(e) {
									// Revalidate the date field
									$('#dateRangeForm').formValidation('revalidateField', 'date');
								});

								$('#dateRangeForm').formValidation({
									framework: 'bootstrap',
									icon: {
											valid: 'glyphicon glyphicon-ok',
											invalid: 'glyphicon glyphicon-remove',
											validating: 'glyphicon glyphicon-refresh'
											},
									fields: {
											date: {
												validators: {
													notEmpty: {
														message: 'The date is required'
													},
													date: {
														format: 'MM/DD/YYYY',
														min: '01/01/2010',
														max: '12/30/2020',
														message: 'The date is not a valid'
													}
												}
											}
										}
									});
							});
					</script>
					
<script>

jQuery(function () {
    jQuery('#startDate').datetimepicker({ format: 'dd/MM/yyyy hh:mm:ss' });
    jQuery('#endDate').datetimepicker({ format: 'dd/MM/yyyy hh:mm:ss' });
    jQuery("#startDate").on("dp.change",function (e) {
        jQuery('#endDate').data("DateTimePicker").setMinDate(e.date);
    });
    jQuery("#endDate").on("dp.change",function (e) {
        jQuery('#startDate').data("DateTimePicker").setMaxDate(e.date);
    });
});

</script>