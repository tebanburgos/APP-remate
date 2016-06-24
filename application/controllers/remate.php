<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');
class Remate extends CI_Controller
{
	private $es_correcto_subida_foto;
	private $nombre_foto_adjunta;
	
	public function __construct()
	{
		parent::__construct();
	//	if ( ! $this->auth->check()) redirect('/index.php');
		$this->CI =& get_instance();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form'));
		$this->load->helper(array('imacom_helper'));
		$this->load->helper(array('imacom'));
		$this->load->model(array('remate_model', 'rematador_model', 'categoria_model'));
		$this->load->library(array('auth'));
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>','</div>');
		$this->load->helper('url');
		$this->load->helper('imacom');
		$this->load->library('session');
	}
	
	public function index()
	{
		// Nada por defecto
	}
	
	public function condiciones()
	{	
		$this->load->view('remate/condiciones');

	}
	
	public function catalogo()
	{	
		$this->load->view('remate/catalogo');

	}
	
	
	
	public function mensaje_por_pantalla($insert_data)
	{
		if (! $insert_data)
		{
			$this->session->set_flashdata('mensaje', 'Remate ingresado satisfactoriamente.');
			$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
		}
		else
		{
			$this->session->set_flashdata('mensaje', 'Ocurrió un error al ingresar el remate.');
			$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
		}
	//	redirect('remate/ingresar');
	}
	
	public function subir_adjunto_foto()
	{
		$config['upload_path'] = "./uploads/pictures/rematadores/";
		$config['allowed_types'] = 'gif|jpg|jpeg|png|tif|tiff|bmp';
		$config['overwrite'] = false;
		$config['max_size'] = '3072';
		$config['remove_spaces'] = true;
		$this->load->library('upload', $config);
		
		$this->upload->initialize($config);
				
		$registro = $this->quitaAcentos("remate_imagen");
					
		if ( ! $this->upload->do_upload($registro))
			{
				$errores = $this->upload->display_errors();
				$this->session->set_flashdata('mensaje', 'Error al subir la fotografía: '.$errores);
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			}
		else
			{
				$archivo = $this->upload->data();
				$this->nombre_foto_adjunta = $archivo['file_name'];
				$this->es_correcto_subida_foto = TRUE;
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
			$this->load->view('remate/ingresar');	
			$this->load->view('footer');	
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function ingresar_remate()
	{
	//		$this->output->enable_profiler(true);
	
	if ($this->session->userdata('tipo') == "rematador" and $this->session->userdata('estado') == "activo")
		{
			if ($_POST)
			{				
				$this->subir_adjunto_foto();
				if($this->es_correcto_subida_foto == true)
				{
					$datetime_inicio = $_POST['remate_fecha_inicio'];
					$datetime_termino = $_POST['remate_fecha_termino'];
					
					$fyh_inicio = date('Y-m-d H:i', strtotime($datetime_inicio));
					$fyh_termino = date('Y-m-d H:i', strtotime($datetime_termino));
					
					$precio_garantia = str_replace ( ".", "", $_POST['remate_precio_garantia']);
			
					$insert_data = $this->remate_model->insert_remate($_POST['categoria'] ,$_POST['rematador'], $_POST['remate_nombre'], $_POST['remate_comuna'], $_POST['remate_direccion'], $_POST['remate_nombre_mandante'], $this->nombre_foto_adjunta, $_POST['remate_fecha_creacion'], $fyh_inicio, $fyh_termino, $_POST['remate_plazo_garantia'], $precio_garantia, $_POST['remate_descripcion']);
					$this->mensaje_por_pantalla($insert_data);
					if (! $insert_data)
					{
						$this->load->view('header');
						$this->load->view('remate/exito');
						$this->load->view('footer');
					}
					else
					{
						$this->load->view('header');
						$this->load->view('remate/ingresar');
						$this->load->view('footer');
					}
				}
			}
		}
		else
		{
			redirect(base_url());
		}	 
		
	}
	
	public function editar()
	{
	//	$this->output->enable_profiler(TRUE);
		$remate_id = $this->uri->segment(3);
		if ( is_numeric($remate_id))
		{
			if ($this->session->userdata('tipo') == "rematador" and $this->session->userdata('estado') == "activo")
			{
				$remate = $this->remate_model->obtener($remate_id);
				
				$this->load->view('header');
				$this->load->view('remate/editar', array('remate' => $remate));
				$this->load->view('footer');
			}
			else
			{
				$this->session->set_flashdata('mensaje', 'El usuario no tiene los permisos para editar este remate o su tiempo de sesión dentro del sistema a expirado. <br> Por favor, inténtelo nuevamente. Si el problema persiste contántese con Soporte Técnico');
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
	
		public function editar_remate()
	{
	//	$this->output->enable_profiler(TRUE);
		if ($_POST)
		{
			$remate_id = $this->uri->segment(3);
			
			if ($_FILES['remate_imagen']['name'] == null)
			{
				$foto_caluga = $this->remate_model->obtener_foto_del_remate($remate_id);
			}
			else
			{
				$this->subir_adjunto_foto();
				$foto_caluga = $this->nombre_foto_adjunta;
			}
			
			$remate_nombre = $_POST['remate_nombre'];
			
			$precio_garantia = str_replace ( ".", "", $_POST['remate_precio_garantia']);
			
			$update_data = $this->remate_model->update_remate($_POST['categoria'] ,$_POST['rematador'], $remate_nombre, $_POST['remate_comuna'], $_POST['remate_direccion'], $_POST['remate_nombre_mandante'], $foto_caluga, $precio_garantia, $_POST['remate_descripcion'], $remate_id);
			
			if ($update_data)
			{
				$this->session->set_flashdata('mensaje', 'Información del remate <strong>'.$remate_nombre.'</strong> fue editada satisfactoriamente.');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
			}
			else
			{
				$this->session->set_flashdata('mensaje', 'Ocurrió un error al editar el remate. <br> Por favor, inténtelo nuevamente.');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			}
			redirect('rematador/panel_de_control');
		}
	}
	
	public function finalizar_remate()
	{
			$remate_id = $this->uri->segment(3);
			$this->remate_model->fin_remate($remate_id);
			$this->remate_model->fin_lotes($remate_id);
			
			$listado_lotes_del_remate = $this->remate_model->consultar_lotes_de_remate($remate_id);
			if (is_object($listado_lotes_del_remate))
			{
				foreach ( $listado_lotes_del_remate->result() as $llr):
					$this->enviar_datos_lote_finalizado_ofertante($llr->lote_id);
					$this->enviar_datos_lote_finalizado_rematador($llr->lote_id);
				endforeach;
			}
			
			$this->mensaje_fin_de_remate($remate_id);
	}
	
	public function mensaje_fin_de_remate($remate_id)
	{
		$nombre_del_remate = $this->remate_model->obtener_nombre_del_remate($remate_id);
		
		$this->session->set_flashdata('mensaje', 'El remate '.$nombre_del_remate.' ha finalizado.<br> Todos los lotes en él también fueron finalizados');
		$this->session->set_flashdata('mensaje_clase', 'alert alert-info');
		redirect('/rematador/panel_de_control');
	}
	
	public function ver()
	{	
        
	//	$this->output->enable_profiler(TRUE);
		
		$numero_remate = $this->uri->segment(3);
		
		if ($_POST)
		{
			if(isset($_POST['ordenamiento']))
			{
				$data['ordenar'] = $_POST['ordenamiento'];
			}
			else
			{
				$data['ordenar'] = null;
			}
			if(isset($_POST['tipo_lote']))
			{
				// captura de los check list en un arreglo y separarlos con una coma
				$filtro_tipo = "";
				for($i = 0; $i< count($_POST['tipo_lote']); $i++){
				$filtro_tipo = $filtro_tipo.$_POST['tipo_lote'][$i] . ",";
					}
				// se borra la última coma
				$filtro_tipo = rtrim($filtro_tipo, ',');
				
				$data['filtro_tipo'] = $filtro_tipo;
			}
			else
			{
				$data['filtro_tipo'] = null;
			}
			if(isset($_POST['marca_lote']))
			{
				// captura de los check list en un arreglo y separarlos con una coma
				$filtro_marca = "";
				for($i = 0; $i< count($_POST['marca_lote']); $i++){
				$filtro_marca = $filtro_marca.$_POST['marca_lote'][$i] . ",";
					}
				// se borra la última coma
				$filtro_marca = rtrim($filtro_marca, ',');
				
				$data['filtro_marca'] = $filtro_marca;
			}
			else
			{
				$data['filtro_marca'] = null;
			}
		}
		else
		{
			$data['ordenar'] = null;
			$data['filtro_tipo'] = null;
			$data['filtro_marca'] = null;
		}

		$data['categoria_id'] = $this->remate_model->obtener_datos_de_la_categoria($numero_remate, 'categoria_id');
		$data['nombre_categoria'] = $this->remate_model->obtener_datos_de_la_categoria($numero_remate, 'categoria_nombre');
		$data['nombre_remate'] = $this->remate_model->obtener_nombre_del_remate($numero_remate);
	//	$data['nombre_rematador'] = $this->remate_model->obtener_datos_del_rematador($numero_remate, 'rematador_nombre_empresa');
		$data['nombre_rematador'] = $this->remate_model->obtener_nombre_del_mandante($numero_remate);
	//	$data['foto_rematador'] = $this->remate_model->obtener_datos_del_rematador($numero_remate, 'rematador_foto');
		$data['foto_rematador'] = $this->remate_model->obtener_foto_del_remate($numero_remate);
		
			$this->load->view('header');
			$this->load->view('remate/ver', $data);
			$this->load->view('footer');
		
	/* 	if ($_POST)
		{
			$this->load->view('header');
			$this->load->view('remate/ver/'.$_POST['id_remate'].'', $data);
			$this->load->view('footer');
		}
		else
		{
			$this->load->view('header');
			$this->load->view('remate/ver', $data);
			$this->load->view('footer');
		}
	 */
	}
	
	public function ver_lotes()
	{
		if ($this->session->userdata('tipo') == "rematador" and $this->session->userdata('estado') == "activo")
		{
		//	$this->output->enable_profiler(TRUE);
			$this->load->view('header');	
			$this->load->view('remate/ver_lotes');	
			$this->load->view('footer');	
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function finalizar_lote()
	{
		$lote_id = $this->uri->segment(3);
		$this->remate_model->fin_lotes_por_id($lote_id);
		$this->enviar_datos_lote_finalizado_ofertante($lote_id);
		$this->enviar_datos_lote_finalizado_rematador($lote_id);
		$this->mensaje_fin_de_lote($lote_id);
	}
	
	public function mensaje_fin_de_lote($lote_id)
	{
		$nombre_del_lote = $this->remate_model->obtener_nombre_del_lote($lote_id);
		$remate_id = $this->remate_model->obtener_id_del_remate_por_lote($lote_id);
		
		$this->session->set_flashdata('mensaje', 'El lote '.$nombre_del_lote.' ha finalizado.');
		$this->session->set_flashdata('mensaje_clase', 'alert alert-info');
		redirect('/remate/ver_lotes'.'/'.$remate_id);
	}
	
	public function enviar_datos_lote_finalizado_rematador($lote_id)
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		$datos_lote = $this->remate_model->obtener_datos_lote($lote_id);
		$datos_remate = $this->remate_model->obtener_datos_remate($datos_lote->remate_id);
		$datos_rematador = $this->remate_model->obtener_datos_rematador($datos_remate->rematador_id);
		
		if($datos_lote->lote_ganador_id != -1)
		{
			$datos_ofertante = $this->remate_model->obtener_datos_ofertante($datos_lote->lote_ganador_id);
			
			$email = $datos_rematador->rematador_correo;
			
			if ( $email != null )
			{
				$datos = array(
					'rematador_correo' => $datos_rematador->rematador_correo,
					'rematador_nombre_responsable' => $datos_rematador->rematador_nombre_responsable,
					'rematador_apellido_responsable' => $datos_rematador->rematador_apellido_responsable,
					'remate_nombre' => $datos_remate->remate_nombre,
					'remate_nombre_mandante' => $datos_remate->remate_nombre_mandante,
					'lote_nombre' => $datos_lote->lote_nombre,
					'lote_descripcion' => $datos_lote->lote_descripcion,
					'lote_fecha_inicio' => $datos_lote->lote_fecha_inicio,
					'lote_fecha_cierre' => $datos_lote->lote_fecha_cierre,
					'lote_contador_visita' => $datos_lote->lote_contador_visita,
					'lote_contador_puja' => $datos_lote->lote_contador_puja,
					'monto' => $datos_lote->lote_valor_actual,
					'ofertante_nombre' => $datos_ofertante->ofertante_nombre,
					'ofertante_apellido' => $datos_ofertante->ofertante_apellido,
					'ofertante_rut' => $datos_ofertante->ofertante_rut,
					'ofertante_correo' => $datos_ofertante->ofertante_correo,
					'ofertante_nickname' => $datos_ofertante->ofertante_nickname,
					'ofertante_fono' => $datos_ofertante->ofertante_fono,
					'ofertante_movil' => $datos_ofertante->ofertante_movil,
					'ofertante_ciudad' => $datos_ofertante->ofertante_ciudad
				);
				
				$this->CI->email->from('soporte@remate.rsiauctions.com', 'Registro en rsiauctions.com');
				$this->CI->email->to($datos_rematador->rematador_correo);
				$this->CI->email->bcc('soporte@imacom.cl'); 
				$this->CI->email->subject('Lote finalizado - rsiauctions.com');
				$plantilla = $this->CI->load->view('mail/enviar_datos_lote_finalizado_rematador_con_datos_ofertante', $datos, true);
				$this->CI->email->message($plantilla);
				$this->CI->email->send();
				return true;	

			}
			else return false;
		}
		else
		{
			$email = $datos_rematador->rematador_correo;
			
			if ( $email != null )
			{
				$datos = array(
					'rematador_correo' => $datos_rematador->rematador_correo,
					'rematador_nombre_responsable' => $datos_rematador->rematador_nombre_responsable,
					'rematador_apellido_responsable' => $datos_rematador->rematador_apellido_responsable,
					'remate_nombre' => $datos_remate->remate_nombre,
					'remate_nombre_mandante' => $datos_remate->remate_nombre_mandante,
					'lote_nombre' => $datos_lote->lote_nombre,
					'lote_descripcion' => $datos_lote->lote_descripcion,
					'lote_fecha_inicio' => $datos_lote->lote_fecha_inicio,
					'lote_fecha_cierre' => $datos_lote->lote_fecha_cierre,
					'lote_contador_visita' => $datos_lote->lote_contador_visita,
					'lote_contador_puja' => $datos_lote->lote_contador_puja,
					'monto' => $datos_lote->lote_valor_actual
				);
				
				$this->CI->email->from('soporte@remate.rsiauctions.com', 'Registro en rsiauctions.com');
				$this->CI->email->to($datos_rematador->rematador_correo);
				$this->CI->email->bcc('soporte@imacom.cl'); 
				$this->CI->email->subject('Lote finalizado - rsiauctions.com');
				$plantilla = $this->CI->load->view('mail/enviar_datos_lote_finalizado_rematador', $datos, true);
				$this->CI->email->message($plantilla);
				$this->CI->email->send();
				return true;	

			}
			else return false;
		}
	}
	
	public function enviar_datos_lote_finalizado_ofertante($lote_id)
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		$datos_lote = $this->remate_model->obtener_datos_lote($lote_id);
		$datos_remate = $this->remate_model->obtener_datos_remate($datos_lote->remate_id);
		$datos_ofertante = $this->remate_model->obtener_datos_ofertante($datos_lote->lote_ganador_id);
		
		$email = $datos_ofertante->ofertante_correo;
		
		if ( $email != null )
		{
			$datos = array(
				'ofertante_correo' => $datos_ofertante->ofertante_correo,
				'ofertante_nombre' => $datos_ofertante->ofertante_nombre,
				'ofertante_apellido' => $datos_ofertante->ofertante_apellido,
				'remate_nombre' => $datos_remate->remate_nombre,
				'remate_nombre_mandante' => $datos_remate->remate_nombre_mandante,
				'lote_nombre' => $datos_lote->lote_nombre,
				'lote_descripcion' => $datos_lote->lote_descripcion,
				'monto' => $datos_lote->lote_valor_actual
			);
			
			$this->CI->email->from('soporte@remate.rsiauctions.com', 'Registro en rsiauctions.com');
			$this->CI->email->to($datos_ofertante->ofertante_correo);
			$this->CI->email->bcc('soporte@imacom.cl'); 
			$this->CI->email->subject('¡Felicidades, el lote ha finalizado! ¡Ud. es el acreedor! - rsiauctions.com');
			$plantilla = $this->CI->load->view('mail/enviar_datos_lote_finalizado_ofertante', $datos, true);
			$this->CI->email->message($plantilla);
			$this->CI->email->send();
			return true;	

		}
		else return false;
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
}	