<div class="row">
	<div class="col-md-12">
	<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-edit"></i> Remate ingresado</h3>
			</div>
			<div class="panel-body">
				<?php echo validation_errors(); ?>
				<?php $rematador_id = $this->session->userdata('id'); ?>
					<div class="col-md-12">
					Se ha ingresado el remate <label for="remate"><?php echo $this->remate_model->consultar_ultimo_remate_ingresado($rematador_id, 'nombre');?></label> satisfactoriamente.
					<br>
					A continuación, incorporé lotes a este remate, o bien, puede crear otro remate distinto.
						<div class="row">
							<div class="col-md-6">
								<a href="<?php echo site_url('remate/ingresar/'); ?>"><button type="button" class="btn btn-primary btn-lg pull-left" id="ingresar-otro-remate-distinto-o"> Ingresar otro remate distinto</button></a>
							<div class="col-md-6">
								<a href="<?php echo site_url('lote/ingresar/'.$this->remate_model->consultar_ultimo_remate_ingresado($rematador_id, 'id')); ?>"><button type="button" class="btn btn-success btn-lg pull-right" id="ingresar-un-lote-a-este-remate"> Ingresar un lote a este remate</button></a>
							</div>
							<br>
							<br>
							<div class="col-md-8">
							<?php if ($this->session->userdata('tipo') == "rematador"){ ?>
								O puede ir al <a href="<?php echo site_url('rematador/panel_de_control/'); ?>">Panel de Control</a>
							<? } ?>
							</div>
									
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
