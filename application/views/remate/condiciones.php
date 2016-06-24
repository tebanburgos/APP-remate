<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:center;line-height:normal'>
					<b>
						<u>
							<span style='font-size:12.0pt;font-family:"Verdana","sans-serif";color:black'>TÉRMINOS Y CONDICIONES DEL REMATE
								<br>
								Re-remate
							</span>
							
							
						</u>
					</b>
				</div>
				
				<?php $datos_remate = $this->remate_model->obtener_todos_los_datos_del_remate($this->uri->segment(3)); ?>
				<?php if ( $datos_remate): ?>
				<?php foreach ( $datos_remate->result() as $dr): ?>
				
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:justify;text-justify:inter-ideograph;line-height:normal'>
					<u>
						<span style='font-size:12.0pt;font-family:"Verdana","sans-serif"'>CATEGORÍA</span>
					</u>
					<span style='font-size:12.0pt;font-family:"Verdana","sans-serif"'>:&nbsp;<b><?php echo $this->remate_model->obtener_datos_de_la_categoria($dr->remate_id, 'categoria_nombre'); ?></b>
					</span>
				</p>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:justify;text-justify:inter-ideograph;line-height:normal'>
					<u>
						<span style='font-size:12.0pt;font-family:"Verdana","sans-serif"'>REMATADOR</span>
					</u>
					<span style='font-size:12.0pt;font-family:"Verdana","sans-serif"'>:&nbsp;<b><?php echo $this->remate_model->obtener_datos_del_rematador($dr->remate_id, 'rematador_nombre_empresa'); ?></b>
					</span>
				</p>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:justify;text-justify:inter-ideograph;line-height:normal'>
					<u>
						<span style='font-size:12.0pt;font-family:"Verdana","sans-serif"'>NOMBRE DEL REMATE</span>
					</u>
					<span style='font-size:12.0pt;font-family:"Verdana","sans-serif"'>:&nbsp;<b><?php echo $dr->remate_nombre; ?></b>
					</span>
				</p>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:justify;text-justify:inter-ideograph;line-height:normal'>
					<u>
						<span style='font-size:12.0pt;font-family:"Verdana","sans-serif"'>FECHA Y HORA DE CIERRE</span>
					</u>
					<span style='font-size:12.0pt;font-family:"Verdana","sans-serif"'>:&nbsp;<b><?php echo date('d-m-Y H:i', strtotime($dr->remate_fecha_termino)); ?></b>
					</span>
				</p>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:justify;text-justify:inter-ideograph;line-height:normal'>
					<u>
						<span style='font-size:12.0pt;font-family:"Verdana","sans-serif"'>COMUNA</span>
					</u>
					<span style='font-size:12.0pt;font-family:"Verdana","sans-serif"'>:&nbsp;<b><?php echo $dr->remate_comuna; ?></b>
					</span>
				</p>
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:justify;text-justify:inter-ideograph;line-height:normal'>
					<u>
						<span style='font-size:12.0pt;font-family:"Verdana","sans-serif"'>DIRECCIÓN</span>
					</u>
					<span style='font-size:12.0pt;font-family:"Verdana","sans-serif"'>:&nbsp;<b><?php echo $dr->remate_direccion; ?></b>
					</span>
				</p>
				
				<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;text-align:justify;text-justify:inter-ideograph;line-height:normal'>
					<span style='font-size:12.0pt;font-family:"Verdana","sans-serif";color:black'>
						1. El presente acuerdo contiene los términos y condiciones para los usuarios que deseen participar del remate electrónico de Rerremate.  Dicho proceso consiste en que Rerremate, mandatado por el Rematador, ofrece vender bienes y recibe ofertas de compra a través de este Portal.
						<br>
						<br>
						2. Para participar del proceso de remate electrónico de Rerremate, los usuarios deberán registrar sus datos en el Portal Rerremate y aceptar estos términos y condiciones en el mismo Portal Rerremate. Cumplido el procedimiento anterior, se le otorgará al usuario una clave de acceso al portal Rerremate, lo que habilita para participar del proceso y realizar ofertas de compra.
						<br>
						<br>
						3. Las ofertas de compra deberán efectuarse electrónicamente a través del Portal Rerremate, las que siempre quedarán sujetas a la aceptación del Rematador.
						<br>
						<br>
						4. El valor inicial de las ofertas o valor de apertura será un valor referencial fijado inicialmente por el Rematador y aumentando progresivamente según el algoritmo de Rerremate, que no obliga al Rematador a aceptar la oferta efectuada sobre el mismo. De esta manera, el valor final alcanzado sobre el monto referencial no obliga al Rematador a aceptar la oferta ni garantiza la celebración de un posible contrato de compraventa con el mejor ofertante.
						<br>
						<br>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam imperdiet massa non nibh eleifend, ac mollis purus volutpat. Phasellus posuere consectetur nunc pellentesque suscipit. Sed luctus tellus nec nunc eleifend, eu faucibus nisi pharetra. Aenean auctor mattis lorem, ut convallis metus eleifend a. Sed lacinia in mauris a tincidunt. Sed eleifend, dolor at malesuada aliquam, erat sapien sodales tortor, vitae sagittis ante urna id turpis. Vivamus sed laoreet elit. Morbi finibus commodo augue ac posuere. Fusce volutpat, ligula eget bibendum pharetra, erat lorem eleifend nisi, nec molestie lorem neque eget turpis. Nam ut tortor orci.
						<br>
						<br>
						Aliquam mauris velit, lacinia non velit eu, varius consectetur purus. Vivamus vestibulum enim at tristique accumsan. Maecenas vehicula lobortis erat tincidunt condimentum. Duis mollis elit eget porttitor sagittis. Etiam pulvinar justo nec dolor eleifend, id viverra lacus laoreet. Mauris posuere viverra diam, quis fringilla turpis. Nunc et maximus lectus. Mauris non tortor vitae lectus tincidunt vehicula ut sit amet est. Praesent congue, lorem in congue hendrerit, leo sapien pharetra magna, quis ornare nisi augue et mauris. Nunc tristique neque at lacinia auctor. In consequat vel sem non ornare. Nam blandit dolor urna, quis malesuada diam ultrices at. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque id mi urna. Nullam luctus, mauris ac ultrices dictum, tellus velit tempor ex, quis rutrum ipsum ante ac ligula.
						<br>
						<br>
						Sed non dolor ut leo faucibus consequat in vitae tellus. Phasellus non eros lorem. Quisque gravida neque sit amet orci scelerisque, ut ultricies diam maximus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vestibulum eget justo tincidunt, convallis turpis eget, mattis augue. Pellentesque non quam quam. Suspendisse lacinia efficitur nisl volutpat viverra. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus vulputate in mauris in fringilla. Donec metus tellus, tempor vel ex id, mollis dignissim orci. Aliquam vel pulvinar massa. In sit amet mauris in leo ultrices dapibus. Donec eleifend congue sapien a convallis. In iaculis viverra purus, at commodo metus gravida rutrum.
						<br>
						<br>
						Phasellus feugiat dui neque, eget imperdiet risus ultricies non. Praesent ornare, dui eget dapibus pellentesque, mauris arcu commodo est, nec vestibulum erat ligula quis lectus. Donec vitae cursus lorem. Maecenas scelerisque rutrum ultrices. Vivamus quis elit sit amet lectus hendrerit iaculis. Integer pretium ullamcorper convallis. Sed bibendum, nulla pretium sollicitudin porta, massa dui pulvinar dui, vitae tempus ligula quam eget nisi. Aenean vitae lacus at sem lacinia accumsan.
						<br>
						<br>
						Donec massa tellus, semper vitae varius venenatis, ultrices ut neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis non sollicitudin leo. Integer commodo elit ut erat volutpat fermentum. Integer tristique molestie euismod. Nam eu ipsum laoreet, tempor libero eget, tempus massa. Suspendisse luctus mi dui, a euismod metus pulvinar eget. Pellentesque vestibulum metus non purus porttitor, ac viverra lectus lobortis. Donec aliquam libero elit, id volutpat libero blandit congue. Suspendisse potenti. Ut lobortis vel elit sit amet condimentum. Nam et neque eget nisi sollicitudin dictum. In diam justo, iaculis et tortor vitae, faucibus malesuada orci. Aliquam semper egestas mauris in imperdiet. Nulla mollis felis porta dui tristique, non faucibus ex fringilla.
						<br>
						<br>
					</span>
				</p>
				
				<?php endforeach; ?>
				<?php else: ?>
				<div class="col-sm-6 col-md-2">
					<p class="alert alert-warning"> Condiciones abiertas a disponibilidad del vendedor y del Portal. <br> Para mayor información contáctese la administración del sitio</p>
				</div>
				<?php endif; ?>


			
			
			</div> <!-- /.row -->
		</div> <!-- /. container-fluid -->
	</body>
</html>