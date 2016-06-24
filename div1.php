<?php echo'
<form action="'.site_url("lote/pujar").'" method="POST">
<div class="inforemate">
<div class="col-sm-3 col-md-4">
	<div class="lote"><i class="fa fa-angle-right"></i> REMATE</div>
</div>
</div>
<div class="infoficharemate">
	<div class="col-md-12">
		<div class="infoficha">
			<div>
				<i class="fa fa-angle-double-right"></i> OFERTA INICIAL:<b> $'.number_format($lote->lote_puja_minima, 0, "", ".").'</b> 
			</div>
			<div class="ofertamayor">
				<i class="fa fa-arrow-right"></i> MAYOR OFERTA:<b> $'.number_format($lote->lote_valor_actual, 0, "", ".").'</b>
			</div>
			&nbsp;
			<div class="ganando">
				<i class="fa fa-money"></i> Incremento: $'.number_format($lote->lote_incremento, 0, "", ".").'
			</div>
			&nbsp;
		</div>
	</div>

</div>                                        
<div class="infobottom">
	<div class="row">                                            
		<ul class="donate-now">
			<li>
				<input type="radio" value="1" name="cantidad" id="x1" checked="checked" />
				<label for="x1">+1x</label>
			</li>
			<li>
				<input type="radio" value="2" name="cantidad" id="x2" />
				<label for="x2">+2x</label>
			</li>
			<li>
				<input type="radio" value="3" name="cantidad" id="x3" />
				<label for="x3">+3x</label>
			</li>
			<li>
				<input type="radio" value="4" name="cantidad" id="x4" />
				<label for="x4">+4x</label>
			</li>
				<input type="hidden" value="'.$lote->lote_incremento.'" name="incremento" />
				<input type="hidden" value="'.$lote->lote_id.'" name="lote_id" />
	</div>
</div>
<div class="row">                                            
	<div class="col-sm-3 col-md-12">
		<button type="button" class="btn-success btn-lg btn-block" data-toggle="modal" data-target="#pujar"><b>ENVIAR OFERTA</b> <i class="fa fa-check"></i></button>
		
		
		<div class="modal fade" tabindex="-1" role="dialog" id="pujar">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"></h4>
			  </div>
			  <div class="modal-body">
				<p>¿Esta seguro de que desea enviar su oferta?</p>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-primary" value="Enviar">
				
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
</div>

</form>
';?>