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
                                                    <h3>¡ATENCIÓN!</h3>
													<br>
													<h3>Otro comprador superó tu oferta. No pierdas tiempo y oferta nuevamente más alto para seguir en la disputa.</h3>
                                                    <p>Estimado(a)  <?php echo $ofertante_nombre; ?>&nbsp;<?php echo $ofertante_apellido; ?></p>
													<p>Los datos actuales del lote son los siguientes</p>
													<br>
													<p>Nombre del remate: <?php echo $remate_nombre; ?></p>
													<p>Nombre del lote: <?php echo $lote_nombre; ?></p>
													<p>Estado del lote: <?php echo $lote_estado; ?></p>
													<p>Descripción del lote: <?php echo $lote_descripcion; ?></p>
													<h3><p>Oferta superada: <?php echo $monto; ?></p></h3>
													<p>Fecha y hora: <?php echo date('d-m-Y H:i', strtotime($subasta_fecha)); ?></p>
													<br>
													<br>
													<p>Para aumentar tu oferta  acceda al portal, introduce tu usuario y contraseña y en el panel de control selecciona la subasta correspondiente.</p>
													<p>Gracias por participar.</p>
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