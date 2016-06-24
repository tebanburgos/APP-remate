<div class="col-md-2" id="leftnav">
	<ul class="nav nav-tabs" role="tablist">
		<div class="row">
			<div class="col-md-12" align="left" id="titulo-categorias">
				<div class="categorias" align="center"><small><i class="fa fa-tags"></i> CATEGORÍAS</small></div>
			</div>
				<div class="col-md-12" id="titulo-lotes-totales">
					<p align="left" class="lotes-totales">Lotes totales: <span><strong><?php echo $this->gadget_model->obtener_lotes_totales(); ?></strong></span></p>
				</div>
		</div>
    </ul>
	<ul class="nav nav-sidebar">
		<table>
			<?php $categorias = $this->gadget_model->obtener_categorias(); ?>
			<?php if ( $categorias): ?>
			<?php foreach ( $categorias->result() as $c): ?>
			<tr>
				<li class="active">
					<td class="col-md-11 categ"><a href="<?php echo site_url('categoria/ver/'.$c->categoria_id); ?>"><?php echo $c->categoria_nombre; ?></a></td>
					<?php $numero_categorias = $this->gadget_model->obtener_remates_totales_por_categoria($c->categoria_id); ?>
					<td class="col-md-1"><span class="label label-success"><?php echo $numero_categorias; ?></span></td>
				</li>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="4"><p class="alert alert-warning">No hay categorías a mostrar</p></td>
			</tr>
			<?php endif; ?>
		</table>
	</ul>
</div>