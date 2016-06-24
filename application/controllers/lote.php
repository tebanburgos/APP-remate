<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');
class Lote extends CI_Controller
{
	private $es_correcto_subida_foto;
	private $es_correcto_subida_archivo;
	private $nombre_archivo_adjunto;
	private $nombre_foto_adjunta_1;
	private $nombre_foto_adjunta_2;
	private $nombre_foto_adjunta_3;
	private $nombre_foto_adjunta_4;
	private $nombre_foto_adjunta_5;
	private $nombre_csv;
	
	public function __construct()
	{
		parent::__construct();
		$this->CI =& get_instance();
		$this->load->library(array('form_validation'));
		$this->load->model(array('remate_model', 'rematador_model', 'categoria_model', 'lote_model', 'garantia_model'));
		$this->load->library(array('auth'));
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>','</div>');
		$this->load->helper('url');
		$this->load->library('session');
		set_time_zone();
	}
	
	public function index()
	{
		// Nada por defecto
	}
	
	public function mensaje_por_pantalla($insert_data)
	{
		if (! $insert_data)
		{
			$this->session->set_flashdata('mensaje', 'Lote ingresado satisfactoriamente.');
			$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
		}
		else
		{
			$this->session->set_flashdata('mensaje', 'Ocurrió un error al ingresar el lote.');
			$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
		}
		redirect('rematador/panel_de_control');
	}
	

	public function subir_adjunto_archivo($ubicacion)
	{
		$config['upload_path'] = $ubicacion;
		$config['allowed_types'] = 'csv|gif|jpg|png|pdf|docx|doc|rtf|txt';
		$config['overwrite'] = false;
		$config['max_size'] = '8196';
		$config['remove_spaces'] = true;
		$this->load->library('upload', $config);
		
		$this->upload->initialize($config);
			
		$registro = $this->quitaAcentos("lote_documento_adjunto");
					
		if ( ! $this->upload->do_upload($registro))
			{
				$errores = $this->upload->display_errors();
				$this->session->set_flashdata('mensaje', 'Error al subir el archivo: '.$errores);
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			}
		else
			{
				$archivo = $this->upload->data();
				$this->nombre_archivo_adjunto = $archivo['file_name'];
				$this->es_correcto_subida_archivo = TRUE;
			}					
	}
	
	public function subir_adjunto_foto_1($ubicacion)
	{
		$config1['upload_path'] = $ubicacion;
		$config1['allowed_types'] = 'gif|jpg|jpeg|png|tif|tiff|bmp';
		$config1['overwrite'] = false;
		$config1['max_size'] = '3072';
		$config1['remove_spaces'] = true;
		$this->load->library('upload', $config1);
		
		$this->upload->initialize($config1);
				
		$registro = $this->quitaAcentos("lote_adjuntar_foto_1");
					
		if ( ! $this->upload->do_upload($registro))
			{
				$errores = $this->upload->display_errors();
				$this->session->set_flashdata('mensaje', 'Error al subir la fotografía: '.$errores);
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			}
		else
			{
				$archivo = $this->upload->data();
				$this->nombre_foto_adjunta_1 = $archivo['file_name'];
				$this->es_correcto_subida_foto = TRUE;
			}					
	}
	
	public function subir_adjunto_foto_2($ubicacion)
	{
		$config2['upload_path'] = $ubicacion;
		$config2['allowed_types'] = 'gif|jpg|jpeg|png|tif|tiff|bmp';
		$config2['overwrite'] = false;
		$config2['max_size'] = '3072';
		$config2['remove_spaces'] = true;
		$this->load->library('upload', $config2);
		
		$this->upload->initialize($config2);
				
		$registro = $this->quitaAcentos("lote_adjuntar_foto_2");
					
		if ( ! $this->upload->do_upload($registro))
			{
				$errores = $this->upload->display_errors();
				$this->session->set_flashdata('mensaje', 'Error al subir la fotografía: '.$errores);
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			}
		else
			{
				$archivo = $this->upload->data();
				$this->nombre_foto_adjunta_2 = $archivo['file_name'];
			}					
	}
	
	public function subir_adjunto_foto_3($ubicacion)
	{
		$config3['upload_path'] = $ubicacion;
		$config3['allowed_types'] = 'gif|jpg|jpeg|png|tif|tiff|bmp';
		$config3['overwrite'] = false;
		$config3['max_size'] = '3072';
		$config3['remove_spaces'] = true;
		$this->load->library('upload', $config3);
		
		$this->upload->initialize($config3);
				
		$registro = $this->quitaAcentos("lote_adjuntar_foto_3");
					
		if ( ! $this->upload->do_upload($registro))
			{
				$errores = $this->upload->display_errors();
				$this->session->set_flashdata('mensaje', 'Error al subir la fotografía: '.$errores);
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			}
		else
			{
				$archivo = $this->upload->data();
				$this->nombre_foto_adjunta_3 = $archivo['file_name'];
			}					
	}
	
	public function subir_adjunto_foto_4($ubicacion)
	{
		$config4['upload_path'] = $ubicacion;
		$config4['allowed_types'] = 'gif|jpg|jpeg|png|tif|tiff|bmp';
		$config4['overwrite'] = false;
		$config4['max_size'] = '3072';
		$config4['remove_spaces'] = true;
		$this->load->library('upload', $config4);
		
		$this->upload->initialize($config4);
				
		$registro = $this->quitaAcentos("lote_adjuntar_foto_4");
					
		if ( ! $this->upload->do_upload($registro))
			{
				$errores = $this->upload->display_errors();
				$this->session->set_flashdata('mensaje', 'Error al subir la fotografía: '.$errores);
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			}
		else
			{
				$archivo = $this->upload->data();
				$this->nombre_foto_adjunta_2 = $archivo['file_name'];
			}					
	}
	
	public function subir_adjunto_foto_5($ubicacion)
	{
		$config5['upload_path'] = $ubicacion;
		$config5['allowed_types'] = 'gif|jpg|jpeg|png|tif|tiff|bmp';
		$config5['overwrite'] = false;
		$config5['max_size'] = '3072';
		$config5['remove_spaces'] = true;
		$this->load->library('upload', $config5);
		
		$this->upload->initialize($config5);
				
		$registro = $this->quitaAcentos("lote_adjuntar_foto_5");
					
		if ( ! $this->upload->do_upload($registro))
			{
				$errores = $this->upload->display_errors();
				$this->session->set_flashdata('mensaje', 'Error al subir la fotografía: '.$errores);
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			}
		else
			{
				$archivo = $this->upload->data();
				$this->nombre_foto_adjunta_2 = $archivo['file_name'];
			}					
	}
	
	public function quitaAcentos($cadena)
	{
		$p = array('á','é','í','ó','ú','Á','É','Í','Ó','Ú','ñ','Ñ',' ');
		$r = array('a','e','i','o','u','A','E','I','O','U','n','N','_');
		return str_replace($p, $r, $cadena);
	}
	
	public function ingresar()
	{
	//	$this->output->enable_profiler(TRUE);
		if ($this->session->userdata('tipo') == "rematador" and $this->session->userdata('estado') == "activo")
		{
			$this->load->view('header');	
			$this->load->view('lote/ingresar');	
			$this->load->view('footer');	
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function seleccionar()
	{
	
		if ($this->session->userdata('tipo') == "rematador" and $this->session->userdata('estado') == "activo")
		{
			$this->load->view('header');	
			$this->load->view('lote/seleccionar');	
			$this->load->view('footer');	
		}
		else
		{
			redirect(base_url());
		}
	}
	
	
	public function capturar_numero_remate()
	{
		if ($this->session->userdata('tipo') == "rematador" and $this->session->userdata('estado') == "activo")
		{
			if ($_POST)
			{
			//	$rematador_id = $_POST['rematador'];
				$remate_id= $_POST['remate_lista'];
				
			redirect('lote/ingresar'.'/'.$remate_id);
			
			}
		}
		else
		{
			redirect(base_url());
		}
	}
 	
	public function seleccionar_importacion()
	{
	
		if ($this->session->userdata('tipo') == "rematador" and $this->session->userdata('estado') == "activo")
		{
			$this->load->view('header');	
			$this->load->view('lote/seleccionar_importacion');	
			$this->load->view('footer');	
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function capturar_numero_remate_masivo()
	{
		if ($this->session->userdata('tipo') == "rematador" and $this->session->userdata('estado') == "activo")
		{
			if ($_POST)
			{
			//	$rematador_id = $_POST['rematador'];
				$remate_id= $_POST['remate_lista'];
				
			redirect('lote/ingresar_masivo'.'/'.$remate_id);
			
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function subir_csv()
	{
		$config['upload_path'] = './uploads/csv';
		$config['allowed_types'] = '*';
		$config['file_name'] = "temporal.csv";
		$config['overwrite'] = true;
		$config['max_size'] = '8196';
		$config['remove_spaces'] = true;
		$this->load->library('upload', $config);
		
		$this->upload->initialize($config);
			
		$registro = $this->quitaAcentos("lote_documento_adjunto");
					
		if ( ! $this->upload->do_upload($registro))
			{
				$errores = $this->upload->display_errors();
				$this->session->set_flashdata('mensaje', 'Error al subir el archivo: '.$errores);
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			}
		else
			{
				$archivo = $this->upload->data();
				$this->nombre_archivo_adjunto = $archivo['file_name'];
				$this->es_correcto_subida_archivo = TRUE;
			}	
			
	}
	

	public function ingresar_masivo()
	{
	//	$this->output->enable_profiler(TRUE);
		if ($this->session->userdata('tipo') == "rematador" and $this->session->userdata('estado') == "activo")
		{
			$rematador_codigo = $_POST['rematador'];
			$remate_codigo = $_POST['remate_lista'];
			$this->load->view('header');	
			$this->load->view('lote/ingresar_masivo', array('rematador_codigo' => $rematador_codigo, 'remate_codigo' => $remate_codigo));	
			$this->load->view('footer');	
		}
		else
		{
			redirect(base_url());
		} 
	}
	
	public function ingresar_lote_masivo()
	{
	//$this->output->enable_profiler(TRUE);
	
	if ($_POST)
	{
	$this->subir_csv();
			if($this->nombre_archivo_adjunto == true)
				{
				$this->load->library('csvreader');
				$result = $this->csvreader->parse_file('http://re-remate2.s2.imacom.cl/uploads/csv/temporal.csv');
				$nombre_CC = "";
				
				$this->lote_model->insertar_lote_masivo($result,$_POST['remate_id']);
				
				//$this->load->view('view_csv', array('data' => $result, 'nombre_CC' => $nombre_CC));
				echo "CSV subido correctamente<br />";
				echo "<a href='http://re-remate2.s2.imacom.cl/index.php/remate/ver/$_POST[remate_id]'>Ver el remate</a>";
				
				}
				else{
					echo "no se subio el archivo";
				}
	}
	}
	
	public function ingresar_lote()
	{
	//	$this->output->enable_profiler(TRUE);
		if ($this->session->userdata('tipo') == "rematador" and $this->session->userdata('estado') == "activo")
		{
			if ($_POST)
			{
				$remate_id = $this->uri->segment(4);
			
				$this->subir_adjunto_archivo("./uploads/files/");
				$this->subir_adjunto_foto_1("./uploads/pictures/");
				$this->subir_adjunto_foto_2("./uploads/pictures/");
				$this->subir_adjunto_foto_3("./uploads/pictures/");
				$this->subir_adjunto_foto_4("./uploads/pictures/");
				
					$this->subir_adjunto_foto_5("./uploads/pictures/");
					if($this->es_correcto_subida_foto == true and $this->es_correcto_subida_archivo == true)
					{
						$datetime_inicio = $_POST['lote_fecha_inicio'];
						$datetime_termino = $_POST['lote_fecha_termino'];
						
						$puja_minima = str_replace ( ".", "", $_POST['lote_puja_minima']);
						$incremento = str_replace ( ".", "", $_POST['lote_incremento']);
						
						$fyh_inicio = date('Y-m-d H:i', strtotime($datetime_inicio));
						$fyh_termino = date('Y-m-d H:i', strtotime($datetime_termino));
						
						$fecha_inicio_remate = date('Y-m-d H:i', strtotime($this->lote_model->consultar_fechas_del_remate($remate_id, 'inicio')));
						$fecha_termino_remate = date('Y-m-d H:i', strtotime($this->lote_model->consultar_fechas_del_remate($remate_id, 'final')));
						
						if ($fyh_inicio >= $fecha_inicio_remate and $fyh_inicio < $fyh_termino and $fyh_inicio < $fecha_termino_remate)
						{
							if($fyh_termino > $fecha_inicio_remate and $fyh_termino > $fyh_inicio and $fyh_termino <= $fecha_termino_remate)
							{
								$insert_data = $this->lote_model->insert_lote($remate_id, $_POST['lote_tipo'], $_POST['lote_marca'], $_POST['lote_modelo'], $_POST['lote_descripcion'], $fyh_inicio, $fyh_termino, $puja_minima, $incremento, $this->nombre_archivo_adjunto, $_POST['lote_link_video'], $this->nombre_foto_adjunta_1, $this->nombre_foto_adjunta_2, $this->nombre_foto_adjunta_3, $this->nombre_foto_adjunta_4, $this->nombre_foto_adjunta_5);
								$this->mensaje_por_pantalla($insert_data);	
							}
							else
							{
								$this->session->set_flashdata('mensaje', 'La fecha de término del lote debe ser menor a la fecha de término del remate y mayor que las demás. <br>Inténtelo nuevamente.');
								$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
							}
						}
						else
						{
							$this->session->set_flashdata('mensaje', 'La fecha de inicio del lote debe ser mayor a la inicio del remate y menor que las demás. <br>Inténtelo nuevamente.');
							$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
						}
					}
			}
		redirect('rematador/panel_de_control');
		}
		else
		{
			redirect(base_url());
		}
		
	}
	
	public function editar()
	{
	//	$this->output->enable_profiler(TRUE);
		$lote_id = $this->uri->segment(3);
		if ( is_numeric($lote_id))
		{
			if ($this->session->userdata('tipo') == "rematador" and $this->session->userdata('estado') == "activo")
			{
				$lote = $this->lote_model->obtener($lote_id);
				
				$this->load->view('header');
				$this->load->view('lote/editar', array('lote' => $lote));
				$this->load->view('footer');
			}
			else
			{
				$this->session->set_flashdata('mensaje', 'El usuario no tiene los permisos para editar este lote o su tiempo de sesión dentro del sistema a expirado. <br> Por favor, inténtelo nuevamente. Si el problema persiste contántese con Soporte Técnico');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
				redirect(base_url());
			}
		}
		else
		{
			$this->session->set_flashdata('mensaje', 'Usuario no válido');
			$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			redirect(base_url());
		}
	}
	
		public function editar_lote()
	{
	//	$this->output->enable_profiler(TRUE);
	
		if ($_POST)
		{
			$rematador_id = $this->uri->segment(3);
			$lote_id = $this->uri->segment(4);
			
			$datos_lote = $this->lote_model->obtener($lote_id);
			
			if ($_FILES['lote_documento_adjunto']['name'] == null)
			{
				$archivo_adjunto = $_POST['lote_documento_adjunto_sin_editar'];
			}
			else
			{
				$this->subir_adjunto_archivo("./uploads/files/");
				$archivo_adjunto = $this->nombre_archivo_adjunto;
			}
			
			if ($_FILES['lote_adjuntar_foto_1']['name'] == null)
			{
				$foto_1 = $_POST['lote_adjuntar_foto_antigua_1'];
			}
			else
			{
				$this->subir_adjunto_foto_1("./uploads/pictures/");
				$foto_1 = $this->nombre_foto_adjunta_1;
			}
			
			if ($_FILES['lote_adjuntar_foto_2']['name'] == null)
			{
				$foto_2 = $_POST['lote_adjuntar_foto_antigua_2'];
			}
			else
			{
				$this->subir_adjunto_foto_2("./uploads/pictures/");
				$foto_2 = $this->nombre_foto_adjunta_2;
			}
			
			if ($_FILES['lote_adjuntar_foto_3']['name'] == null)
			{
				$foto_3 = $_POST['lote_adjuntar_foto_antigua_3'];
			}
			else
			{
				$this->subir_adjunto_foto_3("./uploads/pictures/");
				$foto_3 = $this->nombre_foto_adjunta_3;
			}
			
			if ($_FILES['lote_adjuntar_foto_4']['name'] == null)
			{
				$foto_4 = $_POST['lote_adjuntar_foto_antigua_4'];
			}
			else
			{
				$this->subir_adjunto_foto_4("./uploads/pictures/");
				$foto_4 = $this->nombre_foto_adjunta_4;
			}
			
			if ($_FILES['lote_adjuntar_foto_5']['name'] == null)
			{
				$foto_5 = $_POST['lote_adjuntar_foto_antigua_5'];
			}
			else
			{
				$this->subir_adjunto_foto_5("./uploads/pictures/");
				$foto_5 = $this->nombre_foto_adjunta_5;
			}
			
			$lote_puja_minima = str_replace ( ".", "", $_POST['lote_puja_minima']);
			$lote_incremento = str_replace ( ".", "", $_POST['lote_incremento']);
			
			$update_data = $this->lote_model->update_lote($lote_id, $_POST['lote_tipo'] ,$_POST['lote_marca'], $_POST['lote_modelo'], $_POST['lote_descripcion'], $lote_puja_minima, $lote_incremento, $archivo_adjunto, $_POST['lote_link_video']);
			
			$this->lote_model->update_foto($foto_1, $_POST['foto_id_1']);
			$this->lote_model->update_foto($foto_2, $_POST['foto_id_2']);
			$this->lote_model->update_foto($foto_3, $_POST['foto_id_3']);
			$this->lote_model->update_foto($foto_4, $_POST['foto_id_4']);
			$this->lote_model->update_foto($foto_5, $_POST['foto_id_5']);
			
			if ($update_data)
			{
				$this->session->set_flashdata('mensaje', 'Los datos del lote <strong>'.$datos_lote->lote_nombre.'</strong> fueron editados satisfactoriamente.');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
			}
			else
			{
				$this->session->set_flashdata('mensaje', 'Ocurrió un error al editar el lote. <br> Por favor, inténtelo nuevamente.');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			}
			redirect('/remate/ver_lotes'.'/'.$datos_lote->remate_id);
		}
	}
	

	private function _view($view = 'usuario/administrar', $data = NULL, $layout = TRUE)
	{
		$data['mensaje'] = $this->session->flashdata('mensaje');
		$data['mensaje_clase'] = $this->session->flashdata('mensaje_clase');
		if ( $layout)
		{
			$this->load->view('header');
			$this->load->view($view, $data);
			$this->load->view('footer');
		}
		else
		{
			$this->load->view($view, $data);
		}		
	}
	
	public function ver_lote_actualizado()
	{
		//$this->output->enable_profiler(TRUE);
		$lote_id = $_GET['lote_id'];
		$este_lote = $this->lote_model->consultar_lote($lote_id);
		$this->load->view('lote/div1', array('lote' => $este_lote));
	}
	
	public function ver_pujas_actualizadas()
	{
		//$this->output->enable_profiler(TRUE);
		$lote_id = $_GET['lote_id'];
		$esta_subasta = $this->lote_model->obtener_total_subastas_por_lote($lote_id);
		$this->load->view('lote/div2', array('subasta' => $esta_subasta));
	}
	
	public function ver_php()
	{
		//$this->load->view('lote/div1');
	}
	
	public function ver(){
		
	//	$this->output->enable_profiler(TRUE);
		
		$lote_id = $this->uri->segment(3);
		$este_lote = $this->lote_model->consultar_lote($lote_id);
		$fotos_lote = $this->lote_model->obtener_fotos_lote($lote_id);
		$este_remate = $this->lote_model->obtener_remate_por_lote($este_lote->remate_id);
		$esta_subasta = $this->lote_model->obtener_total_subastas_por_lote($lote_id);
		$contador_actualizado = $this->lote_model->actualizar_contador_visitas($lote_id);
		$visitas = $this->lote_model->obtener_visitas_del_lote($lote_id);
		$ofertas = $this->lote_model->obtener_ofertas_del_lote($lote_id);
		
		$this->lote_model->actualizar_contador_visitas_del_remate($este_lote->remate_id);
		$this->lote_model->actualizar_contador_ofertas_del_remate($este_lote->remate_id);
		
		if($this->garantia_model->consultar_garantia_pagada($este_lote->remate_id, $this->session->userdata('id')) == "Pagada")
		{
			$estado_garantia = "Pagada";
		}
		else if($this->garantia_model->consultar_garantia_revisando($este_lote->remate_id, $this->session->userdata('id')) == "Revisando")
		{
			$estado_garantia = "Revisando";
		}
		else
		{
			$estado_garantia = "Pendiente";
		}
		
		$hoyDia = date("Y-m-d H:i:s");
		
		$this->load->view('header');
		$this->load->view('left');	
		$this->load->view('lote/ver', array('lote' => $este_lote, 'remate' => $este_remate, 'subasta' => $esta_subasta, 'hoyDia' => $hoyDia, 'fotos' => $fotos_lote, 'visitas' => $visitas, 'ofertas' => $ofertas, 'estado_garantia' => $estado_garantia));
		$this->load->view('footer');	
	}
	
	public function pujar(){
		
		$lote_id = $_POST['lote_id'];
		$ofertante_id = $this->session->userdata('id');
		$monto = (int)$_POST['cantidad']*(int)$_POST['incremento'];
		
		$this->lote_model->subastar($lote_id,$ofertante_id,$monto);
		
		$this->enviar_datos_de_subasta_ofertante_ganador($lote_id, $ofertante_id);
		$this->enviar_datos_de_subasta_rematador($lote_id, $ofertante_id);
		
		$listado_ofertantes_perdiendo = $this->lote_model->consultar_ofertantes_perdiendo_este_lote($lote_id, $ofertante_id);
		if (is_object($listado_ofertantes_perdiendo))
		{
			foreach ( $listado_ofertantes_perdiendo->result() as $lop):
				$this->enviar_datos_de_subasta_ofertantes_perdedores($lote_id, $lop->ofertante_id);
			endforeach;
		}
	
		
	//	header('location: http://re-remate.s2.imacom.cl/index.php/lote/ver/'.$lote_id.'');
		redirect('lote/ver/'.$lote_id);
	}
	
	public function enviar_datos_de_subasta_rematador($lote_id, $ofertante_id)
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		$datos_ofertante = $this->lote_model->obtener_datos_ofertante($ofertante_id);
		$datos_lote = $this->lote_model->obtener($lote_id);
		$datos_remate = $this->lote_model->obtener_datos_remate($datos_lote->remate_id);
		$subasta_fecha = $this->lote_model->obtener_fecha_subasta($lote_id, $ofertante_id, $datos_lote->lote_valor_actual);
		$datos_rematador = $this->lote_model->obtener_datos_rematador($datos_remate->rematador_id);
		
		$email = $datos_rematador->rematador_correo;
		
		if ( $email != null )
		{
			$datos = array(
				'rematador_correo' => $datos_rematador->rematador_correo,
				'rematador_nombre_responsable' => $datos_rematador->rematador_nombre_responsable,
				'rematador_apellido_responsable' => $datos_rematador->rematador_apellido_responsable,
				'ofertante_nombre' => $datos_ofertante->ofertante_nombre,
				'ofertante_apellido' => $datos_ofertante->ofertante_apellido,
				'ofertante_correo' => $datos_ofertante->ofertante_correo,
				'ofertante_nickname' => $datos_ofertante->ofertante_nickname,
				'ofertante_fono' => $datos_ofertante->ofertante_fono,
				'ofertante_movil' => $datos_ofertante->ofertante_movil,
				'ofertante_ciudad' => $datos_ofertante->ofertante_ciudad,
				'remate_nombre' => $datos_remate->remate_nombre,
				'lote_nombre' => $datos_lote->lote_nombre,
				'lote_estado' => $datos_lote->lote_estado,
				'lote_fecha_inicio' => $datos_lote->lote_fecha_inicio,
				'lote_fecha_cierre' => $datos_lote->lote_fecha_cierre,
				'lote_contador_visita' => $datos_lote->lote_contador_visita,
				'lote_contador_puja' => $datos_lote->lote_contador_puja,
				'monto' => $datos_lote->lote_valor_actual,
				'subasta_fecha' => $subasta_fecha
			);
			
			$this->CI->email->from('soporte@remate.rsiauctions.com', 'Registro en rsiauctions.com');
			$this->CI->email->to($datos_rematador->rematador_correo);
			$this->CI->email->bcc('soporte@imacom.cl'); 
			$this->CI->email->subject('Actualización de la subasta -¡Alguien a ofertado en su lote! - rsiauctions.com');
			$plantilla = $this->CI->load->view('mail/envio_datos_lote_rematador_oferta', $datos, true);
			$this->CI->email->message($plantilla);
			$this->CI->email->send();
			return true;	

		}
		else return false;
	}
	
	public function enviar_datos_de_subasta_ofertantes_perdedores($lote_id, $ofertante_id)
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		$datos_ofertante = $this->lote_model->obtener_datos_ofertante($ofertante_id);
		$datos_lote = $this->lote_model->obtener($lote_id);
		$datos_remate = $this->lote_model->obtener_datos_remate($datos_lote->remate_id);
		$subasta_fecha = $this->lote_model->obtener_fecha_subasta($lote_id, $ofertante_id, $datos_lote->lote_valor_actual);
		
		$email = $datos_ofertante->ofertante_correo;
		
		if ( $email != null )
		{
			$datos = array(
				'ofertante_nombre' => $datos_ofertante->ofertante_nombre,
				'ofertante_apellido' => $datos_ofertante->ofertante_apellido,
				'remate_nombre' => $datos_remate->remate_nombre,
				'lote_nombre' => $datos_lote->lote_nombre,
				'lote_estado' => $datos_lote->lote_estado,
				'lote_descripcion' => $datos_lote->lote_descripcion,
				'monto' => $datos_lote->lote_valor_actual,
				'subasta_fecha' => $subasta_fecha
			);
			
			$this->CI->email->from('soporte@remate.rsiauctions.com', 'Registro en rsiauctions.com');
			$this->CI->email->to($datos_ofertante->ofertante_correo);
			$this->CI->email->bcc('soporte@imacom.cl'); 
			$this->CI->email->subject('Actualización de la subasta - ¡Oferta superada! - rsiauctions.com');
			$plantilla = $this->CI->load->view('mail/envio_datos_lote_ofertantes_superados', $datos, true);
			$this->CI->email->message($plantilla);
			$this->CI->email->send();
			return true;	

		}
		else return false;
	}
	
	public function enviar_datos_de_subasta_ofertante_ganador($lote_id, $ofertante_id)
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		$datos_ofertante = $this->lote_model->obtener_datos_ofertante($ofertante_id);
		$datos_lote = $this->lote_model->obtener($lote_id);
		$datos_remate = $this->lote_model->obtener_datos_remate($datos_lote->remate_id);
		$subasta_fecha = $this->lote_model->obtener_fecha_subasta($lote_id, $ofertante_id, $datos_lote->lote_valor_actual);
		
		$email = $datos_ofertante->ofertante_correo;
		
		if ( $email != null )
		{
			$datos = array(
				'ofertante_nombre' => $datos_ofertante->ofertante_nombre,
				'ofertante_apellido' => $datos_ofertante->ofertante_apellido,
				'remate_nombre' => $datos_remate->remate_nombre,
				'lote_nombre' => $datos_lote->lote_nombre,
				'lote_estado' => $datos_lote->lote_estado,
				'monto' => $datos_lote->lote_valor_actual,
				'subasta_fecha' => $subasta_fecha
			);
			
			$this->CI->email->from('soporte@remate.rsiauctions.com', 'Registro en rsiauctions.com');
			$this->CI->email->to($datos_ofertante->ofertante_correo);
			$this->CI->email->bcc('soporte@imacom.cl'); 
			$this->CI->email->subject('Actualización de la subasta -¡Ud. va ganando! - rsiauctions.com');
			$plantilla = $this->CI->load->view('mail/envio_datos_lote_ofertante_ganador', $datos, true);
			$this->CI->email->message($plantilla);
			$this->CI->email->send();
			return true;	

		}
		else return false;
	}
	
	
	
}	