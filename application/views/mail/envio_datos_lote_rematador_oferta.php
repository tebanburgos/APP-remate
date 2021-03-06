<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Proyecto Re-Remate</title>
		<style type="text/css"></style>
	</head>
<body>
	<center>
	<table style="width: 700px;">
		<tbody>
            <tr>
              <td style="background-color:#f5f5f5; text-align: center;">
                <table style="width: 700px;">
                    <tbody>
                        <tr>
                           <td colspan="3" style="text-align:left;"><img src="<?php echo base_url('assets/img/logo.png'); ?>" style="margin-left:6px;"></td>
                        </tr>
                        <tr>
                            <td style="width: 10px;">&nbsp;&nbsp;</td>
                            <td style="background-color: white;">
                                
                                <table>
                                    <tbody>                                        
                                        <tr>
                                            <td width="695" style="font-family: Tahoma, Arial, sans-serif; text-align:left; font-size: 12px; color: #000000; padding: 20px;">
                                                <h1 style="font-size: 26px; color:#0d4c93; margin-top:10px;">
                                                    Proyecto Re-Remate
                                                </h1>

                                                <strong style="color:#666;">
                                                    <h3>¡ATENCIÓN! Alguien a ofertado en su subasta</h3>
                                                    <p>Estimado(a)  <?php echo $rematador_nombre_responsable; ?>&nbsp;<?php echo $rematador_apellido_responsable; ?></p>
													<br>
													<p>Hay un interesado que ha pujado en el siguiente lote:</p>
													<br>
													<br>
													<p>Nombre del remate: <?php echo $remate_nombre; ?></p>
													<p>Nombre del lote: <?php echo $lote_nombre; ?></p>
													<p>Estado del lote: <?php echo $lote_estado; ?></p>
													<p>Fecha de inicio de la subasta: <?php echo $lote_fecha_inicio; ?></p>
													<p>Fecha de cierre de la subasta: <?php echo $lote_fecha_cierre; ?></p>
													<p>Número de visitas de la subasta: <?php echo $lote_contador_visita; ?></p>
													<p>Número de ofertas de la subasta: <?php echo $lote_contador_puja; ?></p>
													<h3><p>Monto ofertado: <?php echo $monto; ?></p></h3>
													<p>Fecha y hora: <?php echo date('d-m-Y H:i', strtotime($subasta_fecha)); ?></p>
													<br>
													<br>
													<p>Para hacerle seguimiento a este lote puede verlo accediendo al portal, introduciendo su usuario y contraseña, y en el panel de control de su cuenta podrá ver los lotes que ha ofertado.</p>
                                                    <br><br>
                                                    <p>Atentamente,</p>
                                                    <p>El Equipo Re-Remate.</p> 
                                                </strong>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>						
                            </td>
                            <td style="width: 10px;">&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="height: 10px;"></td>
                        </tr>
                    </tbody>
                  </table>
               </td>
            </tr>
        </tbody>
    </table>
    </center>
</body>
</html>