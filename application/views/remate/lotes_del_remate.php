<?php $remate_codigo = $this->uri->segment(3); ?>
<?php $ordenar = $this->uri->segment(4); ?>
<div class="row">
	<?php $lotes_del_remate = $this->remate_model->obtener_lotes_del_remate($remate_codigo, $ordenar); ?>
	<?php if ( $lotes_del_remate): ?>
	<?php foreach ( $lotes_del_remate->result() as $lr): ?>
	
	<div class="col-sm-6 col-md-6">
		<div class="col-sm-6 col-md-4 info2img">
		
			<?php $lote_foto = $this->remate_model->obtener_primera_foto_del_lote($lr->lote_id); ?>
			
			<a href="<?php echo site_url('lote/ver/'.$lr->lote_id); ?>"><img src="<?php echo base_url('uploads/pictures/'.$lote_foto); ?>" class="img-responsive" alt="..." alt="..." width="185" height="146"></a>
		</div>

		<div class="col-sm-6 col-md-8 info2">
			<div class="infotop">
				<div class="col-sm-3 col-md-4">
					<div class="lote"><i class="fa fa-angle-right"></i> <?php echo $lr->lote_nombre; ?></div>
				</div>
				<div class="col-sm-3 col-md-8">
					<div class="fecha3"><i class="fa fa-calendar-check-o"></i> <?php echo date('d-m-Y H:i', strtotime($lr->lote_fecha_cierre)); ?></div>
				</div>
			</div>
			<div class="infolote">
				<div class="col-sm-3 col-md-7 infolote">
					<div class="sublotes3"><?php echo $this->remate_model->truncar_texto($lr->lote_descripcion); ?></div>
				</div>
				<div class="col-sm-3 col-md-5">
						<a href ="<?php echo site_url('lote/ver/'.$lr->lote_id); ?>"><button type="button" class="btn btn-success btn-xs btn-block"><i class="fa fa-legal"></i> Ir a la Subasta</button></a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="infobottom2">
				<div class="row">
					<div class="col-sm-3 col-md-12">
						<div class="valor">
							Valor Actual: $ <?php echo $lr->lote_valor_actual; ?> <small>(CLP)</small>
						</div>
					</div>
				</div>
			</div>
			<div class="infobottom">
				<div class="row">
					<div class="col-sm-3 col-md-4">
						<center><i class="fa fa-user"></i> Visitas: <?php echo $lr->lote_contador_visita; ?></center>
					</div>
					
					<div class="col-sm-3 col-md-4">
						<center><i class="fa fa-hand-paper-o"></i> Ofertas: <?php echo $this->remate_model->obtener_ofertas_del_lote($lr->lote_id); ?></center>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-md-12">
					<div class="disponible3"><i class="fa fa-check"></i> Disponible - Abierto para Ofertas</div>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	<?php else: ?>
	<div class="col-sm-6 col-md-2">
		<p class="alert alert-warning"> No hay remates disponibles en esta categoría</p>
	</div>
	<?php endif; ?>
</div>
                    <div class="row">
                        <div class="col-md-12">
                                <nav>
                                    <ul class="pagination">
                                        <li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                        <li><a href="#">1</a></li>
                                <!--        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li> -->
                                        <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                    </ul>    
                                </nav>
                        </div>
                    </div>