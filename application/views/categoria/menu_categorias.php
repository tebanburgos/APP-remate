<div class="col-md-2" id="leftnav">
	<ul class="nav nav-tabs" role="tablist">
		<div class="row">
			<div class="col-md-6" align="left">
				<div class="categorias" align="center"><small><i class="fa fa-tags"></i> CATEGORÍAS</small></div>
			</div>
				<div class="col-md-6">
					<p align="center">Lotes en esta categoria</p>
					<?php $numero_categoria = $this->uri->segment(3); ?>
					<p align="center"><strong><?php echo $this->categoria_model->obtener_lotes_totales_por_categoria($numero_categoria); ?></strong></p>
				</div>
		</div>
    </ul>
	
	<br>
	<form class="form" name="menu_categoria" action="<?php echo site_url('categoria/ver/'.$numero_categoria.'/'.$this->uri->segment(4)); ?>" method="POST">
		<ul class="nav nav-sidebar" id="subcat">
			<div class="col-md-11" align="center">
				<p>Elija opciones y luego filtre</p>
				<div class ="row">
					<button type="submit" class="btn btn-info btn-xs"><i class="fa fa-filter"></i> Filtrar</button>
				</div>
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
						<td class="col-md-1"><span class="label label-success"><?php echo $this->categoria_model->obtener_totales_de_todos_los_tipos_del_remate($numero_categoria); ?></span></td>
					</li>
				</tr>
				
				<?php  $tipos = $this->categoria_model->obtener_tipos_de_los_remates_por_categoria($numero_categoria); ?>
				<?php  if ( $tipos): ?>
				<?php $tipo_categoria_checkeado = ""; ?>
				<?php  foreach ( $tipos->result() as $t): ?>
				
				<?php $array = explode(",", $f_tipo);?>
				<?php for ($i=0;$i<count($array);$i++) { ?>
					<?php if($array[$i] == $t->tipo_id ){$tipo_categoria_checkeado = "checked"; break 1;} else { $tipo_categoria_checkeado = "";} ?>
				<?php } ?>
				
				<tr>
					<li>
						<td class="col-md-11">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="tipo_remate[]" <?php echo $tipo_categoria_checkeado; ?> value="<?php echo $t->tipo_id; ?>">
										<?php echo $t->tipo_nombre; ?>
								</label>
							</div>
						</td>
						
						<td class="col-md-1"><span class="label label-success"><?php echo $this->categoria_model->obtener_totales_de_tipo_de_la_categoria($numero_categoria,$t->tipo_id) ?></span></td>
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
						<td class="col-md-1"><span class="label label-success"><?php echo $this->categoria_model->obtener_totales_de_todas_las_marcas_de_la_categoria($numero_categoria); ?></span></td>
					</li>
				</tr>
				
				<?php  $marcas = $this->categoria_model->obtener_marcas_por_categorias($numero_categoria); ?>
				<?php  if ( $marcas): ?>
				<?php $marca_categoria_checkeado = ""; ?>
				<?php  foreach ( $marcas->result() as $m): ?>
				
				<?php $array = explode(",", $f_marca);?>
				<?php for ($i=0;$i<count($array);$i++) { ?>
					<?php if($array[$i] == $m->marca_id ){$marca_categoria_checkeado = "checked"; break 1;} else { $marca_categoria_checkeado = "";} ?>
				<?php } ?>
	
				<tr>
					<li>
						<td class="col-md-11 ">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="marca_remate[]" <?php echo $marca_categoria_checkeado; ?> value="<?php echo $m->marca_id; ?>">
										<?php echo $m->marca_nombre; ?>
								</label>
							</div>
						</td>
						<td class="col-md-1"><span class="label label-success"><?php echo $this->categoria_model->obtener_totales_de_las_marcas_de_la_categoria($numero_categoria,$m->marca_id) ?></span></td>
					</li>
				</tr>
				
				<?php endforeach; ?>
				<?php else: ?>
				<tr>
					<td colspan="4"><p class="alert alert-warning">No hay marcas de categoría a mostrar</p></td>
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
var cb = document.getElementsByName('tipo_remate[]');
 
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
var cb = document.getElementsByName('marca_remate[]');
 
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