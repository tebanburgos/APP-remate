 	

<div class="col-md-8">
    
    <!-- Slider -->
<div id="slider">
    <img src="/uploads/pictures/slider/slider-01.jpg" alt="..." style="width: 100%;">
</div>
        
 	<!-- Slider -->
    
    <ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#subastas_disponibles" id="boton-disponible" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-gavel"></i> SUBASTAS DISPONIBLES</a></li>
		<li role="presentation"><a href="#subastas_finalizadas" id="botom-finalizado" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-reply-all"></i> SUBASTAS FINALIZADAS</a></li>
    </ul>

	<!-- Tab panes -->
	<div class="tab-content">	
		<div role="tabpanel" class="tab-pane active" id="subastas_disponibles">
			<?php $this->load->view('gadgets/subastas_disponibles'); ?>
			<?php // echo Modules::run('gadgets/subastas_disponibles'); ?>
		</div>
	
		<div role="tabpanel" class="tab-pane fade" id="subastas_finalizadas">	
			<?php $this->load->view('gadgets/subastas_finalizadas'); ?>
			<?php // echo Modules::run('gadgets/subastas_finalizadas'); ?>
		</div>
	</div>
</div>


<div class="col-md-2">
<div id="banner">
    <a href="http://www.rematesanisidro.cl/"><img src="/uploads/pictures/banner/rsi.jpg" alt="..." style="width: 100%;"></a>
</div> 
<div id="banner">
    <a href="#"><img src="/uploads/pictures/banner/como-subastar.jpg" alt="..." style="width: 100%;"></a>
</div>   
    <div id="banner">
    <a href="#"><img src="/uploads/pictures/banner/condiciones.jpg" alt="..." style="width: 100%;"></a>
</div> 
</div>