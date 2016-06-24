<script type="text/javascript" language="javascript">
function refreshDivs(divid,secs,url)
{

// define our vars
var divid,secs,url,fetch_unix_timestamp;

// The XMLHttpRequest object

var xmlHttp;
try{
xmlHttp=new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
}
catch (e){
try{
xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
}
catch (e){
try{
xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e){
alert("Tu explorador no soporta AJAX.");
return false;
}
}
}

// Timestamp para evitar que se cachee el array GET

fetch_unix_timestamp = function()
{
return parseInt(new Date().getTime().toString().substring(0, 10))
}

var timestamp = fetch_unix_timestamp();
var nocacheurl = url+"?t="+timestamp;

// the ajax call
xmlHttp.onreadystatechange=function(){
if(xmlHttp.readyState == 4 && xmlHttp.status == 200){
document.getElementById(divid).innerHTML=xmlHttp.responseText;
setTimeout(function(){refreshDivs(divid,secs,url);},secs*1000);
}
}
xmlHttp.open("GET",nocacheurl,true);
xmlHttp.send(null);
}

// LLamamos las funciones con los repectivos parametros de los DIVs que queremos refrescar.
window.onload = function startrefresh(){
refreshDivs('div1',15,'http://re-remate2.s2.imacom.cl/index.php/lote/ver_lote_actualizado?puja_minima=<?=number_format($lote->lote_puja_minima, 0, "", ".")?>&valor_actual=<?=number_format($lote->lote_valor_actual, 0, "", ".")?>&incremento=<?=number_format($lote->lote_incremento, 0, "", ".")?>&lote_id=<?=number_format($lote->lote_id, 0, "", ".")?>&url=<?php echo site_url('lote/pujar'); ?>');
refreshDivs('div2',3,'http://re-remate2.s2.imacom.cl/index.php/lote/ver_pujas_actualizadas?lote_id=<?=number_format($lote->lote_id, 0, "", ".")?>');
//refreshDivs('div3',10,'div3.php');
}
</script>
<style type="text/css">
#defaultCountdown { width: 240px; height: 45px; }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?php echo base_url('js/jquery.plugin.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.countdown.js'); ?>"></script>

<?php
//echo "Cierre :".$lote->lote_fecha_cierre;
//echo "<br />Hoy :".$hoyDia;
if ($hoyDia < $lote->lote_fecha_cierre){
		$estado_lote = "abierto";
	}
	else{
		$estado_lote = "cerrado";
	}
$fecha_remate = explode(" ", $lote->lote_fecha_cierre);

$fecha = $fecha_remate[0];
$fecha_truncada = explode("-", $fecha);
$anio = $fecha_truncada[0];
$mes = $fecha_truncada[1];
$dia =$fecha_truncada[2];

$hora = $fecha_remate[1];
$hora_truncada = explode(":", $hora);
$horas = $hora_truncada[0];
$minutos = $hora_truncada[1];
$segundos = $hora_truncada[2];
?>


<script type="text/javascript">
 
year = <?php echo $anio; ?>; month = <?php echo $mes; ?>; day = <?php echo $dia; ?>;hour= <?php echo $horas; ?>; min= <?php echo $minutos; ?>; sec= <?php echo $segundos; ?>;
 
$(function(){
	countProcess();
});
 
 
var timezone = new Date()
var gmtHours = -timezone.getTimezoneOffset()/60;
month		 = --month;
dateFuture   = new Date(year,month,day,hour-gmtHours,min,sec);
 
function countProcess(){
 
        dateNow = new Date();                                                            
        amount  = dateFuture.getTime() - dateNow.getTime()+5;               
        delete dateNow;
 
        /* time is already past */
        if(amount < 0){
                output ="<div id='days'><span></span>0<div id='days_text'></div></div>" + 
						"<div id='hours'><span></span>0<div id='hours_text'></div></div>" + 
						"<div id='mins'><span></span>0<div id='mins_text'></div></div>" + 
						"<div id='secs'><span></span>0<div id='secs_text'></div></div>" ;
                $('#countbox').html(output);    
        }
        /* date is still good */
        else{
                days=0; hours=0; mins=0; secs=0; output="";
 
                amount = Math.floor(amount/1000); /* kill the milliseconds */
 
                days   = Math.floor(amount/86400); /* days */
                amount = amount%86400;
 
                hours  = Math.floor(amount/3600); /* hours */
                amount = amount%3600;
 
                mins   = Math.floor(amount/60); /* minutes */
                amount = amount%60;
 
                
                secs   = Math.floor(amount); /* seconds */
 
 
                output="<center>" + days +" Días " + " " + hours +" Hrs " + " " + mins +" Min " + " " + secs +" Seg" ;
						
				$('#countbox').html(output);
			
 
                setTimeout("countProcess()", 1000);
        }
		
}

   

</script>
<script>
     
  function changeImage(imgName)
  {
     image = document.getElementById('imgDisp');
     image.src = imgName;
  }
 
</script>



                <div class="col-md-10">

                    <div class="row">
					<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="col-sm-6 col-md-12 info1img">
                                <div class="well well-sm wellazul">
                                    <b>Subasta Licitación <?php echo $lote->lote_nombre ?></b>
                                </div>
								
								

										
										
								<?php if ($fotos) { ?>	
									<?php $i = 0; ?>
									
									<div class="row">
									<?php foreach ($fotos as $item): ?>
										<?php $i++; ?>
										<?php if ($i == 1) { ?>
										<div class="col-md-12">
											<img id="imgDisp" class="img-responsive thumb_img" style="width:100%;" src="<?php echo base_url('uploads/pictures'); ?>/<?=$item['foto_url']?>">
										</div>
										&nbsp;
										<br />	
										<?php } ?>
										
										<div class="col-md-2">
										<?php if ($item['foto_url'] == null) { ?>
										<img class="img-responsive thumb_img" src="<?php echo base_url('uploads/pictures/sinfoto.jpg'); ?>" onclick="changeImage('<?php echo base_url('uploads/pictures/sinfoto.jpg'); ?>');" />
										
										<?php } else { ?>
										
											<img class="img-responsive thumb_img" src="<?php echo base_url('uploads/pictures'); ?>/<?=$item['foto_url']?>" onclick="changeImage('<?php echo base_url('uploads/pictures'); ?>/<?=$item['foto_url']?>');" />
										
										<?php } ?>
										
										</div>
	
									<?php endforeach; ?>
									</div>
									
									
										
																
										
								<?php } ?>


								
								
								
								
								
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="col-sm-6 col-md-12 info1img">
                                
                                <div class="btn-group btn-group-justified btn-group-xs" role="group" aria-label="...">
                                    <div class="btn-group" role="group">
                                        <a href="<?php echo site_url('/ayuda/solucion/como_participar'); ?>" target="_blank"><button type="button" class="btn btn-primary btninfoficha" id="como-participo"><i class="fa fa-info-circle"></i> Cómo Participo</button></a>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary btninfoficha" id="condiciones" data-toggle="modal" data-target=".ficha_condiciones"><i class="fa fa-file-text"></i> Condiciones</button>
                                    </div>
									
									 <div class="modal fade ficha_condiciones" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog modal-m" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" align="center">
                                                    Revise las <a href="<?php echo site_url('/remate/condiciones/'.$remate->remate_id); ?>" target="_blank">Condiciones de Oferta y Pago</a> de este remate para poder participar.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									
									
									
                                    <div class="btn-group" role="group">
                                        <a href="<?php echo site_url('/remate/catalogo/'.$remate->remate_id); ?>" target="_blank"><button type="button" class="btn btn-primary btninfoficha" id="imprimir-fecha"><i class="fa fa-print"></i> Imprimir Ficha</button></a>
                                    </div>
                                </div>  

<div class="clearfix"></div>
							&nbsp;<br />
							<div class="col-md-12">
							<div class="alert alert-warning">

							<div class="row">
							
							<?php if ($estado_lote == "abierto"){ ?>
							<center>
							<h4 class="modal-title" id="myModalLabel">Este lote se cerrara en: </h4>
									<div id="countbox"></div>
							</center>
							<? } 
							else {
							?>
							<h4 class="modal-title" id="myModalLabel">Este lote se encuentra cerrado </h4>
							<? } ?>
							</div>
							</div>
							</div>



								
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-8 info2">
                            <div class="fondoinfoficha">
                            
                                <div class="col-sm-6 col-md-6 info2">
                                    <div class="infotop">
                                        <div class="col-sm-6">
                                            <div class="lote"><i class="fa fa-angle-right"></i> Información del Remate</div>
                                        </div>
                                                                      </div>
                                    <div class="infolote">
                                        <div class="col-sm-3 col-md-12 infolote">
                                            <div class="infoficha"><b><i class="fa fa-user"></i> Remate:</b> <?php echo $remate->remate_nombre ?></div>
                                            <div class="infoficha"><b><i class="fa fa-calendar-check-o"></i> Fecha Apertura Lote:</b> <?php echo date('d-m-Y H:i', strtotime(format_fecha($lote->lote_fecha_inicio))) ?></div>
                                            <div class="infoficha"><b><i class="fa fa-hourglass-half"></i> Fecha Cierre Lote:</b> <?php echo date('d-m-Y H:i', strtotime(format_fecha($lote->lote_fecha_cierre))) ?></div>

                                            <div class="btn-group btn-group-justified btn-group-xs" role="group" aria-label="...">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ficha_mas_info"><i class="fa fa-file-o fa-lg"></i> Más Info</button>
                                                </div>
												
											  <div class="modal fade" id="ficha_mas_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Archivo Adjunto</h4>
                                                        </div>
                                                        <div class="modal-body" align="center">
                                                            <img src="<?php echo base_url('/uploads/files'); ?>/<?php echo $lote->lote_documento_adjunto ?>" class="img-responsive">
                                                        </div>
														<?=$item['foto_url']?>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>	
											
                                                <div class="btn-group" role="group">
													<a href="<?php echo $lote->lote_link_video; ?>" target="_blank"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ficha_video"><i class="fa fa-youtube-play fa-lg"></i> Ver Video</button></a>
                                                </div>
												
												
                                            </div>
                                        </div>
                                    </div>
									

                                      
									
									
                                    <br>
                                    <div class="infobajoficha">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-4" align="center">
                                                <i class="fa fa-user"></i> Visitas: <?=number_format($visitas, 0, '', '.');?>
                                            </div>
                                            
                                            <div class="col-sm-3 col-md-4" align="center">
                                                <i class="fa fa-hand-paper-o"></i> Ofertas: <?=number_format($ofertas, 0, '', '.');?>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
									
									 <div class="modal fade ficha_favorito" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog modal-m" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
												
												<?php if ($this->session->userdata('tipo') == "ofertante") { ?>
												
                                                <div class="modal-body" align="center">
                                                    Se ha añadido el <?=$lote->lote_nombre?> como favorito.
                                                </div>
												
												<? } 
												else { ?>
												<div class="modal-body" align="center">
                                                    Debe estar registrado como <strong>ofertante</strong> para poder seguir este lote.
													<br>
													<a href="<?php echo site_url('/ofertante/acceso'); ?>">Acceda a su cuenta</a>, o en caso de no tenerla, <a href="<?php echo site_url('/ofertante/registrar'); ?>">regístrese</a>.
													
                                                </div>
												
												<? } ?>	
												
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-primary btn-md btn-block" id="ver-descripcion" data-toggle="modal" data-target=".modalDescrip">
                                        <i class="fa fa-file"></i> Ver Descripción Detallada
                                    </button>
                                    <div class="modal fade modalDescrip" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Descripción Detallada <?php echo $lote->lote_nombre ?></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo $lote->lote_descripcion?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
								<!--<? echo $this->session->userdata('tipo')." == ofertante<br />"; ?>
								<? echo (int)$lote->lote_ganador_id." == ".(int)$this->session->userdata('id')."<br />"; ?>
								<? echo $estado_lote." == abierto <br />"; ?>
								<? echo $estado_garantia." == Pagada<br />"; ?>-->
								
								<?php if ($this->session->userdata('tipo') == "ofertante" && $estado_lote == "abierto" && $estado_garantia == "Pagada") { ?>
								
								
								
								<div id="div1"></div>
									
								
									
								<? } else if ($estado_lote == "cerrado") { ?>
								
                                    <div class="row">
                                         <div class="col-sm-3 col-md-12">   
                                            <div class="alert alert-info alertas" role="alert">
											    
                                                <i class="fa fa-info-circle"></i> No se admiten nuevas pujas en este Lote.
                                            </div>
                                             
                                         </div>
                                    </div>
								<?
								} else if ($estado_garantia == "Revisando") { ?>
								
                                    <div class="row">
                                         <div class="col-sm-3 col-md-12">   
                                            <div class="alert alert-info alertas" role="alert">
                                                <i class="fa fa-info-circle"></i> Nuestros registros indican que usted ya envio un comprobante de pago de garantía. Dentro del día su garantia sera activada para poder pujar en este lote y los demas del remate.
                                            </div>
                                             
                                         </div>
                                    </div>
								
								

								<?
								} else if ($this->session->userdata('tipo') == "rematador") { ?>
								
                                    <div class="row">
                                         <div class="col-sm-3 col-md-12">   
                                            <div class="alert alert-info alertas" role="alert">
											    La información aquí solo aparece para ofertantes
                                            </div>
                                             
                                         </div>
                                    </div>
								 	
								<?
								} else if (!$this->session->userdata('tipo')) { ?>
								
                                    <div class="row">
                                         <div class="col-sm-3 col-md-12">   
                                            <div class="alert alert-info alertas" role="alert">
											    Debes estar registrado para participar
                                            </div>
                                             
                                         </div>
                                    </div>	
								
								<?
								} else if ($estado_garantia != "Pagada") { ?>
								
								
                                    <div class="row">
                                         <div class="col-sm-3 col-md-12">   
                                            <div class="alert alert-info alertas" role="alert">
											    <a href="<?php echo site_url('garantia/pagar/'.$remate->remate_id); ?>" class="btn btn-info" role="button">PAGA LA GARANTIA</a><br />&nbsp;<br />
                                                <i class="fa fa-info-circle"></i> Para poder participar debes pagar la garantía
                                            </div>
                                             
                                         </div>
                                    </div>
								
								<? } ?>	

                                </div>
                            </div>
                            
                            
							
							
							<div id="div2"></div>
							
							
							
							
							
							
							
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>

					
					
					
                </div>
            </div>
            <div class="clearfix"></div>
			

								
