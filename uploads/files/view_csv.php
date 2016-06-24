<? echo "nombre: ".$nombre_CC."<br />";?>
<table cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td>TIPO ID</td>
        <td>MARCA ID</td>
        <td>LOTE MODELO</td>
        <td>LOTE NOMBRE</td>
        <td>LOTE DESCRIPCION</td>
        <td>LOTE ESTADO</td>
        <td>LOTE PUJA MINIMA</td>
        <td>LOTE INCREMENTO</td>
        <td>LOTE DOCUMENTO ADJUNTO</td>		
		<td>LOTE LINK VIDEO</td>
        <td>LOTE COMISIÓN</td>	
    </tr>
    <?php foreach ($data as $field) { ?>
        <tr>
            <td><?php echo $field['tipo_id'] ?></td>
            <td><?php echo $field['marca_id'] ?></td>
            <td><?php echo $field['lote_modelo'] ?></td>
            <td><?php echo $field['lote_nombre'] ?></td>
            <td><?php echo $field['lote_descripcion'] ?></td>
            <td><?php echo $field['lote_estado'] ?></td>
            <td><?php echo $field['lote_puja_minima'] ?></td>
            <td><?php echo $field['lote_incremento'] ?></td>
            <td><?php echo $field['lote_documento_adjunto'] ?></td>
            <td><?php echo $field['lote_link_video'] ?></td>
            <td><?php echo $field['lote_comision'] ?></td>			
        </tr>
    <?php } ?>
</table>