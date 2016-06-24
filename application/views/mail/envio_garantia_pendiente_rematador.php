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
                                                    <h3>Antecedentes del pago de la garantía</h3>
                                                    <p>Estimado(a)</p>
													<p>Se ha registrado una garantía pendiente en el remate <?php echo $remate_nombre;?></p>
													<p>Este remate está bajo el mandante <?php echo $remate_nombre_mandante;?></p>
													<br>
													<br>
													<p>Los datos del ofertante son los siguientes:</p>
													<p>Nombre: <?php echo $ofertante_nombre." ".$ofertante_apellido; ?></p>
													<p>Alias: <?php echo $ofertante_nickname; ?></p>
													<p>Rut: <?php echo $ofertante_rut; ?></p>
													<p>E-mail: <?php echo $ofertante_correo; ?></p>
													<p>Teléfono fijo: <?php echo $ofertante_fono; ?></p>
													<p>Teléfono móvil: <?php echo $ofertante_movil; ?></p>
													<p>Ciudad: <?php echo $ofertante_ciudad; ?></p>
													<br>
													<p>Esta garantía posee el siguiente estado:</p>
													<p>Estado de la garantía: <?php echo $garantia_estado; ?></p>
													<p>Tipo de pago: <?php echo $garantia_tipo_pago; ?></p>
													<p>Fecha de ingreso de la garantía: <?php echo date('d-m-Y H:i', strtotime($garantia_fecha_ingreso)); ?></p>
													<br>
													<p>Para activar y ver esta garantía debe acceder al Panel de control, y dentro de él al Administrador de Garantía</p>
													<p>Para más detalles de esta y de otras garantías acceda a su Panel de Control</p>
													<br>
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