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
                                                    <h3>El lote ha finalizado</h3>
                                                    <p>Estimado(a)  <?php echo $rematador_nombre_responsable; ?>&nbsp;<?php echo $rematador_apellido_responsable; ?></p>
													<br>
													<p>El siguiente lote ha sido cerrado. Los datos de este son los siguientes:</p>
													<br>
													<br>
													<p>Nombre del remate: <?php echo $remate_nombre; ?></p>
													<p>Nombre del mandante: <?php echo $remate_nombre_mandante; ?></p>
													<p>Nombre del lote: <?php echo $lote_nombre; ?></p>
													<p>Descripción del lote: <?php echo $lote_descripcion; ?></p>
													<p>Fecha de inicio de la subasta: <?php echo $lote_fecha_inicio; ?></p>
													<p>Fecha de cierre de la subasta: <?php echo $lote_fecha_cierre; ?></p>
													<p>Número de visitas de la subasta: <?php echo $lote_contador_visita; ?></p>
													<p>Número de ofertas de la subasta: <?php echo $lote_contador_puja; ?></p>
													<p>Monto del lote: <?php echo $monto; ?></p>
													<br>
													<br>
													<h3>¡Y hay un acreedor!</h3>
													<p>Nombre del ofertante: <?php echo $ofertante_nombre; ?>&nbsp; <?php echo $ofertante_apellido; ?></p>
													<p>RUT del ofertante: <?php echo $ofertante_rut; ?></p>
													<p>E-mail del ofertante: <?php echo $ofertante_correo; ?></p>
													<p>Alias: <?php echo $ofertante_nickname; ?></p>
													<p>Teléfono fijo: <?php echo $ofertante_fono; ?></p>
													<p>Teléfono móvil: <?php echo $ofertante_movil; ?></p>
													<p>Ciudad: <?php echo $ofertante_ciudad; ?></p>
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