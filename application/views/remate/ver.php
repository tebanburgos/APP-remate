<body>
	<div class="container-fluid">
		<div class="row" id="ruta-remate">
			<div class="col-md-12">
				<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
				<div class="row">
					<div class="col-md-9">
						<div class="form-group">
							<ol class="breadcrumb">
								<li class="active"><a href="<?php echo base_url() ?>">Inicio</a></li>
								<?php $numero_remate = $this->uri->segment(3); ?>
								<li><a href="<?php echo site_url('categoria/ver').'/'; ?><?=$categoria_id?>"><?=$nombre_categoria?></a></li>
								<li><a href="<?php echo site_url('remate/ver/'.$numero_remate); ?>"><?=$nombre_remate?></a></li>
						<!--	 aquí debe cargar la fotografía del rematador -->
						<!--	<li><a href="<?php // echo site_url('remate/ver/'.$numero_remate); ?>"><img src="<? // =$rematador_foto?>" class="img-responsive" alt="..."></a></li> -->
							</ol>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<form class="form" name="menu_remate" action="<?php echo site_url('remate/ver/'.$numero_remate.'/'.$this->uri->segment(4)); ?>" method="POST">
							<input type="hidden" name="id_remate" id="id_remate" value="<?php echo $numero_remate;?>">
								<select class="form-control" id="ordenamiento" name="ordenamiento" onchange="this.form.submit()">
									<option value="">Ordenar por:</option>
									<option value="cierre">Fecha de cierre</option>
									<option value="mayor_valor">Mayor valor</option>
									<option value="menor_valor">Menor valor</option>
									<option value="mas_visitado">Más visitado</option>
								</select>
						</div>
					</div>
				</div>
		<!--	<div class="row">		
					<div class="col-md-9">
						<div class="form-group">
							<ol class="breadcrumb">
								<div class="row">
									<p>Este remate pertenece a <strong> <?=$nombre_rematador?></strong></p>
								</div>
							</ol>
						</div>
					</div>
					
				</div> -->
			</div>
		</div>
		<div class="row">
			<?php // $this->load->view('remate/menu_categorias'); ?>
			
			<div class="col-md-2" id="leftnav">
				<div class="col-md-12" id="foto-caluga-remate">
					<div class="form-group" align="center">
					<img src="<?php echo base_url('uploads/pictures/rematadores').'/'; ?><?=$foto_rematador?>" alt="..." width="170" height="90">
					</div>
				</div>
				<ul class="nav nav-tabs" role="tablist">
					<div class="row" align="left">
						<div class="col-md-12" align="left">
							<div class="categorias" align="center"><small><i class="fa fa-tags"></i> CATEGORÍAS</small></div>
						</div>
							<div class="col-md-12">
								<p align="center">Lotes en este remate</p>
								<p align="center"><strong><?php echo $this->remate_model->obtener_lotes_totales_del_remate($numero_remate); ?></strong></p>
							</div>
					</div>
				</ul>
				
				<br>
					<ul class="nav nav-sidebar" id="subcat">
						<div class="col-md-11" align="center">
							<p>Elija opciones y luego filtre</p>
							<button type="submit" class="btn btn-info btn-sm" id="filtrar-r"><i class="fa fa-filter"></i> Filtrar</button>
						</div>
					</ul>
					<br>
					<ul class="nav nav-sidebar" id="subcat">
						<span class="label label-default subcattitle"><i class="fa fa-angle-double-right"></i> TIPO</span>
						<table>
							<tr>
								<li>
									<td class="col-md-11">
										<div class="checkbox">
											<label>
												<input type="checkbox" id="marcar_tipo" onclick="marcar_desmarcar_tipo();">
													<b>Todos</b>
											</label>
										</div>
									</td>
									<td class="col-md-1"><span class="label label-success"><?php echo $this->remate_model->obtener_totales_de_todos_los_tipos_del_remate($numero_remate) ?></span></td>
								</li>
							</tr>
							
							<?php  $tipos = $this->remate_model->obtener_tipos_por_remate($numero_remate); ?>
							<?php  if ( $tipos): ?>
							<?php $tipo_remate_checkeado = ""; ?>
							<?php  foreach ( $tipos->result() as $t): ?>
							
							<?php $array = explode(",", $filtro_tipo);?>
							<?php for ($i=0;$i<count($array);$i++) { ?>
								<?php if($array[$i] == $t->tipo_id ){$tipo_remate_checkeado = "checked"; break 1;} else { $tipo_remate_checkeado = "";} ?>
							<?php } ?>
							
							<tr>
								<li>
									<td class="col-md-11">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="tipo_lote[]" <?php echo $tipo_remate_checkeado ?> value="<?php echo $t->tipo_id; ?>">
													<?php echo $t->tipo_nombre; ?>
											</label>
										</div>
									</td>
								
									<td class="col-md-1"><span class="label label-success"><?php echo $this->remate_model->obtener_totales_de_tipo_del_remate($numero_remate,$t->tipo_id) ?></span></td>
								</li>
							</tr>
							<?php endforeach; ?>
							<?php else: ?>
							<tr>
								<td colspan="4"><p class="alert alert-warning">No hay tipos de categoría a mostrar</p></td>
							</tr>
							<?php  endif; ?>
							</tbody>
							
						</table>                        
					</ul>
					
					<br>
					<ul class="nav nav-sidebar" id="subcat">
						<span class="label label-default subcattitle"><i class="fa fa-angle-double-right"></i> MARCA</span>
						<table>
							<tr>
								<li>
									<td class="col-md-11">
										<div class="checkbox">
											<label>
												<input type="checkbox" id="marcar_marca" onclick="marcar_desmarcar_marca();">
													<b>Todos</b>
											</label>
										</div>
									</td>
									<td class="col-md-1"><span class="label label-success"><?php echo $this->remate_model->obtener_totales_de_todas_las_marcas_del_remate($numero_remate) ?></span></td>
								</li>
							</tr>
							
							<?php  $marcas = $this->remate_model->obtener_marcas_de_este_remate($numero_remate); ?>
							<?php  if ( $marcas): ?>
							<?php $marca_remate_checkeado = ""; ?>
							<?php  foreach ( $marcas->result() as $m): ?>
							
							<?php $array = explode(",", $filtro_marca);?>
							<?php for ($i=0;$i<count($array);$i++) { ?>
								<?php if($array[$i] == $m->marca_id ){$marca_remate_checkeado = "checked"; break 1;} else { $marca_remate_checkeado = "";} ?>
							<?php } ?>
							
							<tr>
								<li>
									<td class="col-md-11 ">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="marca_lote[]" <?php echo $marca_remate_checkeado; ?> value="<?php echo $m->marca_id; ?>">
													<?php echo $m->marca_nombre; ?>
											</label>
										</div>
									</td>
									<td class="col-md-1"><span class="label label-success"><?php echo $this->remate_model->obtener_totales_de_las_marcas_del_remate($numero_remate,$m->marca_id) ?></span></td>
								</li>
							</tr>
							
							<?php endforeach; ?>
							<?php else: ?>
							<tr>
								<td colspan="4"><p class="alert alert-warning">No hay marcas asociadas a este remate a mostrar</p></td>
							</tr>
							<?php  endif; ?>
							
						</table>
					</ul>
					<br>
				</form>
			</div>

			
			<div class="col-md-10">
			
				<div class="row">		
					<div class="col-md-4 pull-right text-right" id="acciones-remate-r">
						<div class="form-group">
							<ol class="breadcrumb">
								<div class="row">
									<div class="btn-group btn-group-justified btn-group-xs" role="group" aria-label="...">
										<div class="btn-group" role="group">
											<a href="<?php echo site_url('/ayuda/solucion/como_participar'); ?>" target="_blank"><button type="button" class="btn btn-primary btninfoficha" id="como-participo"><i class="fa fa-info-circle"></i> Cómo Participo</button></a>
										</div>
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-primary btninfoficha" id="condiciones" data-toggle="modal" data-target=".ficha_condiciones"><i class="fa fa-file-text"></i> Condiciones</button>
										</div>
									 <div class="modal fade ficha_condiciones" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog modal-m" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" align="center">
                                                    Revise las <a href="<?php echo site_url('/remate/condiciones/'.$numero_remate); ?>" target="_blank">Condiciones de Oferta y Pago</a> de este remate para poder participar.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <a href="<?php echo site_url('/remate/catalogo/'.$numero_remate); ?>" target="_blank"><button type="button" class="btn btn-primary btninfoficha" id="imprimir-fecha"><i class="fa fa-print"></i> Imprimir Ficha</button></a>
                                    </div>
                                </div>
									
									
								</div>
							</ol>
						</div>
					</div>
				</div>
			
			
			<br>
				<div class="row" id="contener-lote">
				
				<?php if ( $filtro_tipo == null and $filtro_marca == null) { ?>
					<?php $lotes_del_remate = $this->remate_model->obtener_lotes_del_remate($numero_remate, $ordenar); ?>
				<?php } elseif ( $filtro_tipo == true and $filtro_marca == null) { ?>
					<?php $lotes_del_remate = $this->remate_model->obtener_lotes_del_remate_filtrado($numero_remate, $ordenar, $filtro_tipo, null); ?>
				<?php } elseif ( $filtro_tipo == null and $filtro_marca == true) { ?>
					<?php $lotes_del_remate = $this->remate_model->obtener_lotes_del_remate_filtrado($numero_remate, $ordenar, null, $filtro_marca); ?>
				<?php } elseif ( $filtro_tipo == true and $filtro_marca == true) { ?>
					<?php $lotes_del_remate = $this->remate_model->obtener_lotes_del_remate_filtrado($numero_remate, $ordenar, $filtro_tipo, $filtro_marca); ?>
				<?php } ?>
				
					<?php // $lotes_del_remate = $this->remate_model->obtener_lotes_del_remate($numero_remate, $ordenar); ?>
					<?php if ( $lotes_del_remate): ?>
					<?php foreach ( $lotes_del_remate->result() as $lr): ?>
					
					<div class="col-sm-4 col-md-4" id="ficha_producto">
						
						<div class="col-sm-12 info2">
							<div class="infotop">
								<div class="col-sm-6">
									<div class="lote"><i class="fa fa-angle-right"></i> <?php echo $lr->lote_nombre; ?></div>
								</div>
								<div class="col-sm-6">
									<div class="fecha3"><i class="fa fa-calendar-check-o"></i> <?php echo date('d-m-Y H:i', strtotime($lr->lote_fecha_cierre)); ?></div>
								</div>
							</div>
							<div class="col-sm-12 info2img">
							
								<?php $lote_foto = $this->remate_model->obtener_primera_foto_del_lote($lr->lote_id); ?>
								
								<a href="<?php echo site_url('lote/ver/'.$lr->lote_id); ?>"><img src="<?php echo base_url('uploads/pictures/'.$lote_foto); ?>" class="img-responsive" id="foto-lote" width="185" height="140"></a>
							</div>
							
							<div class="infolote">
								<div class="col-sm-12 infolote">
									<div class="sublotes3"><?php echo $this->remate_model->truncar_texto($lr->lote_descripcion); ?></div>
								</div>
								<div class="col-sm-12" id="boton-subasta">
										<a href ="<?php echo site_url('lote/ver/'.$lr->lote_id); ?>"><button type="button" class="btn btn-success btn-xs btn-block" id="ver-lote"><i class="fa fa-legal"></i> Ir a la Subasta</button></a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="infobottom2">
								<div class="row">
									<div class="col-sm-12">
										<div class="valor">
											Valor Actual: $ <?php echo number_format($lr->lote_valor_actual, 0, '', '.'); ?> <small>(CLP)</small>
										</div>
									</div>
								</div>
							</div>
							<div class="infobottom">
								<div class="row">
									<div class="col-sm-6">
										<center><i class="fa fa-user"></i> Visitas: <?php echo number_format($lr->lote_contador_visita, 0, '', '.'); ?></center>
									</div>
									
									<div class="col-sm-6">
										<center><i class="fa fa-hand-paper-o"></i> Ofertas: <?php echo number_format($this->remate_model->obtener_ofertas_del_lote($lr->lote_id), 0, '', '.'); ?></center>
									</div>
								</div>
							</div>
							<div class="row" id="estado-disponible">
								<div class="col-sm-12">
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
			</div>
		</div>					
	</div><!-- /.container -->

	<script type="text/javascript">
	//<![CDATA[
		function marcar_desmarcar_tipo(){
			var marca = document.getElementById('marcar_tipo');
			var cb = document.getElementsByName('tipo_lote[]');
			 
			for (i=0; i<cb.length; i++){
				if(marca.checked == true){
				cb[i].checked = true
				}else{
				cb[i].checked = false;
				}
			}
		 
		}
	//]]>
	</script>

	<script type="text/javascript">
	//<![CDATA[
		function marcar_desmarcar_marca(){
			var marca = document.getElementById('marcar_marca');
			var cb = document.getElementsByName('marca_lote[]');
			 
			for (i=0; i<cb.length; i++){
				if(marca.checked == true){
				cb[i].checked = true
				}else{
				cb[i].checked = false;
				}
			} 
		}
	//]]>
	</script>

</body>