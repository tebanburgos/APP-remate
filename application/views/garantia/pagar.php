<div class="col-md-10">

	<div class="row">
	<h1>Garantía Remate <?=$remate->remate_nombre?></h1>
	
	<form action="" method="POST" enctype="multipart/form-data">
	
	<input type="hidden" name="remate_id" value="<?=$remate_id?>" />
	<input type="hidden" name="ofertante_id" value="<?=$ofertante_id?>" />
	<p>La garantía a pagar para este remate es : $ <?=formatear_numero($remate->remate_precio_garantia)?></p>
	

	<div class="row">
	
	<p>Depositar a la siguiente cuente</p>
	&nbsp;<br />
	Banco: BBVA<br />
	Tipo de Cuenta: Corriente<br />
	Numero de Cuenta: 32546541-7<br />
	Nombre Empresa: San Isidro Remates<br />
	Rut Empresa: 74.549.178-K<br />
	Correo Empresa: garantias@rsiauctions.com<br />
	&nbsp;
	
	<p>
	  <?=$mensaje?>
	</p>
	
	<p>
	
	<?=$boton?>
	
	</form>
</div>

<div class="clearfix"></div>
			

								
