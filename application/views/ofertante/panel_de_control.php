<div class="col-md-10">
	<div class="panel-body">
        <div class="row">		
            <div class="col-md-12">
			<div class='<?=$this->session->flashdata('mensaje_clase'); ?>'> <?=$this->session->flashdata('mensaje'); ?> </div>
                <h3 style="margin-top: 0;">Bienvenido a tu cuenta, <?php echo $this->session->userdata('nombre') ?></h3>
                <div class="panel-group">
					<div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Historial</h3>
                        </div>
                         <div class="panel-body">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>Remate</th>
											<th>Lote</th>
											<th>Fecha de cierre</th>
											<th>Valor ofrecido</th>
											<th>Fecha y hora de la acción</th>
											<th>Estado del lote</th>
											<th>Su posición actual</th>
										</tr>
									</thead>
									<tbody>
										<?php $listado_subastas = $this->ofertante_model->consultar_subastas_del_ofertante($this->session->userdata('id')); ?>
										<?php if ( $listado_subastas): ?>
										<?php foreach ( $listado_subastas->result() as $ls): ?>
										<tr>
											<td> <a href="<?php echo site_url('remate/ver/'.$this->ofertante_model->obtener_datos_del_remate_a_traves_del_lote($ls->lote_id, 'remate_id')); ?>"> <?php echo $this->ofertante_model->obtener_datos_del_remate_a_traves_del_lote($ls->lote_id, 'remate_nombre'); ?> </a> </td>
											<td> <a href="<?php echo site_url('lote/ver/'.$ls->lote_id); ?>"> <?php echo $this->ofertante_model->obtener_datos_del_lote($ls->lote_id, 'lote_nombre'); ?> </a> </td>
											<td><?php echo date('d-m-Y H:i', strtotime($this->ofertante_model->obtener_datos_del_lote($ls->lote_id, 'lote_fecha_cierre'))); ?></td>
											<td><?php echo $ls->subasta_total; ?></td>
											<td><?php echo date('d-m-Y H:i', strtotime($ls->subasta_fecha)); ?></td>
											<td><?php echo $this->ofertante_model->obtener_datos_del_lote($ls->lote_id, 'lote_estado'); ?></td>
											<?php $id_ganador = $this->ofertante_model->obtener_datos_del_lote($ls->lote_id, 'lote_ganador_id'); ?>
											<?php if ($id_ganador == $this->session->userdata('id')) { ?>
											<td>Ud. es la máxima oferta</td>
											<?php
											}
											else
											{
											?>
											<td>Oferta superada</td>
											<? } ?>
										</tr>
										<?php endforeach; ?>
										<?php else: ?>
										<tr>
											<td colspan="12"><p class="alert alert-warning" align="center">No hay remates creados</p></td>
										</tr>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
                        </div>
                    </div>

                    <div class="panel panel-success">

                        <div class="panel-heading">
                            <h3 class="panel-title">Configuración</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <ul>
                                    <li><a href="<?php echo site_url('/ofertante/recuperar_clave/'); ?>">Cambiar Contraseña</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
					


                </div>

                <div align="center">
                    #
                </div>

            </div>

        </div>

    </div>

</div>
	      



        


