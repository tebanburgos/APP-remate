<? echo'<div class="col-sm-6 col-md-12 info1img">
	<hr>
	<div class="titleblue">
		<h4><i class="fa fa-thumb-tack"></i> Actividad del Lote en Remate</h4>
	</div>
									
	<br>
	<table class="table-bordered table-hover table-striped table-condensed" style="width:100%;">
		<thead class="wait">
			<th colspan="5"><i class="fa fa-caret-right"></i> LISTA DE OFERTAS:</th>
		</thead>
		<thead>
			<th>Usuario</th>
			<th>Fecha</th>
			<th>Incremento</th>
			<th>Valor Puja</th>
			<th>Comisión</th>
		</thead>';
?>
		<?php if ($subasta) { ?>						
		<?php foreach ($subasta as $item): ?>
		<? echo '<tr>
			<td>'.$item["ofertante_nickname"].'</td>
			<td>'.format_fecha($item["subasta_fecha"]).'</td>
			<td>'.number_format($item["subasta_valor"], 0, "", ".").'</td>
			<td>'.number_format($item["subasta_total"], 0, "", ".").'</td>
			<td>'.$item["lote_comision"].'</td>
		</tr>';?>
		<?php endforeach; ?>
		<?php } 
	echo '</table></div>';?>