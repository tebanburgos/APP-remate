<div class="col-md-10">

	<div class="row">
	<h1>Panel Garantías</h1>
	
	<table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Ofertante</th>
        <th>Remate</th>
		<th>Estado</th>
        <th>Tipo Pago</th>
        <th>Numero Pago</th>
		<th>Devolución</th>
        <th>Fecha Ingreso</th>
        <th>Adjunto</th>
		<th>Acción</th>
      </tr>
    </thead>
    <tbody>
	<?
	foreach ($garantia->result() as $row)
	{
	?>
	   <tr>
        <td><?=$row->garantia_id?></td>
        <td><?=$row->ofertante_nombre." ".$row->ofertante_apellido?></td>
        <td><?=$row->remate_id?></td>
		<td><?=$row->garantia_estado?></td>
        <td><?=$row->garantia_tipo_pago?></td>
        <td><?=$row->garantia_numero_pago?></td>
		<td><?=$row->garantia_devolucion?></td>
        <td><?=$row->garantia_fecha_ingreso?></td>
        <td><a class="btn btn-default" href="<?=$row->garantia_archivo_adjunto?>">Descargar</a></td>
		<td><?if($row->garantia_estado != "Pagada"){ ?><a class="btn btn-default" href="<?=site_url('/garantia/activar_ofertante/'.$row->garantia_id)?>">Activar</a><? } else {?>Garantía Pagada<? } ?></td>
      </tr>
	<?
	}
	?>
	


    </tbody>
  </table>

</div>

<div class="clearfix"></div>
			

								
