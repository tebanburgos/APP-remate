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
                                                    <h3>Antecedentes del sistema</h3>
                                                    <p>Estimado(a)  <?php echo $rematador_nombre_responsable; ?>&nbsp;<?php echo $rematador_apellido_responsable; ?></p>
													<p>Gracias por su interés y por inscribirse en Re-Remate</p>
													<br>
													<br>
													<p>Nombre de la Empresa: <?php echo $rematador_nombre_empresa; ?></p>
													<p>Razón Social: <?php echo $rematador_razon_social; ?></p>
													<p>Rut de la Empresa: <?php echo $rematador_rut_empresa; ?></p>
													<p>Nombre del Representante: <?php echo $rematador_nombre_responsable; ?>&nbsp;<?php echo $rematador_apellido_responsable; ?></p>
													<p>Rut del Representante: <?php echo $rematador_rut_responsable; ?></p>
													<p>Teléfono fijo: <?php echo $rematador_telefono; ?></p>
													<p>Teléfono móvil: <?php echo $rematador_movil; ?></p>
													<br>
													<br>
													<p>Email (Login): <?php echo $rematador_correo; ?></p>
													<p>Contraseña: <?php echo $rematador_password; ?></p>
													<br>
													<br>

<p>Para confirmar el registro por favor ingrese al siguiente enlace: <?php echo site_url('rematador/activacion/'.$rematador_token_activacion); ?></p>
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