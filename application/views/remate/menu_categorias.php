<div class="col-md-2" id="leftnav">
	<ul class="nav nav-tabs" role="tablist">
		<div class="row" align="left">
			<div class="col-md-6" align="left">
				<div class="categorias" align="center"><small><i class="fa fa-tags"></i> CATEGORÍAS</small></div>
			</div>
				<div class="col-md-6">
					<p align="center">Lotes en este remate</p>
					<?php $numero_remate = $this->uri->segment(3); ?>
					<p align="center"><strong><?php echo $this->remate_model->obtener_lotes_totales_del_remate($numero_remate); ?></strong></p>
				</div>
		</div>
    </ul>
	
	<br>
	<form class="form" action="#" method="POST">
		<ul class="nav nav-sidebar" id="subcat">
			<div class="col-md-11" align="center">
				<p>Elija opciones y luego filtre</p>
				<button type="submit" class="btn btn-info btn-sm"><i class="fa fa-filter"></i> Filtrar</button>
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
									<input type="checkbox" id="marcar_tipo" value="" onclick="marcar_desmarcar_tipo();">
										<b>Todos</b>
								</label>
							</div>
						</td>
						<td class="col-md-1"><span class="label label-success"><?php echo $this->remate_model->obtener_totales_de_todos_los_tipos_del_remate($numero_remate) ?></span></td>
					</li>
				</tr>
				
				<?php  $tipos = $this->remate_model->obtener_tipos_por_remate($numero_remate); ?>
				<?php  if ( $tipos): ?>
				<?php  foreach ( $tipos->result() as $t): ?>
				
				<tr>
					<li>
						<td class="col-md-11">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="tipo_lote[]" value="<?php echo $t->tipo_id; ?>">
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
									<input type="checkbox" id="marcar_marca" value="" onclick="marcar_desmarcar_marca();">
										<b>Todos</b>
								</label>
							</div>
						</td>
						<td class="col-md-1"><span class="label label-success"><?php echo $this->remate_model->obtener_totales_de_todas_las_marcas_del_remate($numero_remate) ?></span></td>
					</li>
				</tr>
				
				<?php  $marcas = $this->remate_model->obtener_marcas_de_este_remate($numero_remate); ?>
				<?php  if ( $marcas): ?>
				<?php  foreach ( $marcas->result() as $m): ?>
				
				<tr>
					<li>
						<td class="col-md-11 ">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="marca_lote[]" value="<?php echo $m->marca_id; ?>">
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