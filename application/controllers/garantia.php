<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');
class Garantia extends CI_Controller
{

	private $es_correcto_subido_adjunto;
	private $nombre_archivo_adjunto;
	private $directorio_remate;
	
	public function __construct()
	{
		parent::__construct();
	//	if ( ! $this->auth->check()) redirect('/index.php');
		$this->CI =& get_instance();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form'));
		$this->load->helper(array('imacom_helper'));
		$this->load->helper(array('imacom'));
		$this->load->model(array('remate_model', 'rematador_model', 'ofertante_model', 'categoria_model', 'garantia_model'));
		$this->load->library(array('auth'));
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>','</div>');
		$this->load->helper('url');
		$this->load->helper('imacom');
		$this->load->library('session');
	}
	
	public function subir_adjunto_garantia($remate_id)
	{
		$this->load->helper('path');  
		$dir=set_realpath('./uploads/garantias/'.$remate_id."/");  

		if (!is_dir($dir)) {
			mkdir($dir , 0777, TRUE);
		}
		
		$config['upload_path'] = $dir;
		$config['allowed_types'] = 'gif|jpg|jpeg|png|tif|tiff|bmp|pdf|doc|docx|xls|xlsx|txt';
		$config['overwrite'] = false;
		$config['max_size'] = '4096';
		$config['remove_spaces'] = true;
		$this->load->library('upload', $config);
		
		$this->upload->initialize($config);
				
		$registro = quitarAcentos("garantia_adjunto");
					
		if ( ! $this->upload->do_upload($registro))
			{
				$errores = $this->upload->display_errors();
				$this->session->set_flashdata('mensaje', 'Error al subir el adjunto: '.$errores);
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			}
		else
			{
				$archivo = $this->upload->data();
				$this->nombre_archivo_adjunto = $archivo['file_name'];
				$this->es_correcto_subido_adjunto = TRUE;
				$this->directorio_remate = $dir;
			}					
	}
	
	public function pagar()
	{
		$this->load->helper('date');
	//	$this->output->enable_profiler(TRUE);
		
		$remate_id = $this->uri->segment(3);
		$ofertante_id = $this->session->userdata('id');
		
		$mensaje = '<div class="alert alert-info"><strong>Info!</strong> Una vez hecha la transferencia sacale una captura a tu comprobante y súbelo como archivo adjunto en el siguiente campo<br />Para una mayo rapidez al momento de revisar nombra a tu archivo algo asi como : juan-perez.jpg</div>';
		
		$boton = '<input type="file" name="garantia_adjunto" /></p>&nbsp;<br /><input type="submit" value="Enviar Comprobante" class="btn btn-primary"/></div>';
		
		if($_POST)
		{
			$this->subir_adjunto_garantia($remate_id);
			
			if($this->es_correcto_subido_adjunto)
			{
				$mensaje = '<div class="alert alert-success"><strong>¡Gracias!</strong>, recibimos tu comprobante. Una vez revisado por nuestro equipo y confirmado el deposito te activaremos<br />Y podras participar en todos los lotes de este remate. Dentro de un plazo de 8 horas, la garantía estara validada en caso de ser correcta</div>';
				
				$boton = '</p>&nbsp;<br /><a href="'.base_url('index.php/remate/ver/'.$remate_id).'" class="btn btn-primary">VOLER AL REMATE</a></div>';
				
				$data['ofertante_id'] = $ofertante_id;
				$data['remate_id'] = $remate_id;
				$data['garantia_estado'] = "Revisando";
				$data['garantia_tipo_pago'] = "Transferencia";
				$data['garantia_numero_pago'] = 1;
				$data['garantia_devolucion'] = "Pendiente";
				$data['garantia_fecha_ingreso'] = gmdate('Y-m-d H:i:s', time() + (3600*-4));
				$data['garantia_archivo_adjunto'] = base_url('uploads/garantias/'.$remate_id.'/'.$this->nombre_archivo_adjunto);
				
				$this->garantia_model->ingresar_garantia($data);
				$this->enviar_datos_por_correo($data);
				$this->enviar_datos_por_correo_rematador($data);
			}
		}
		
		$este_remate = $this->remate_model->obtener_remate_por_id($remate_id);
		
		
		$this->load->view('header');
		$this->load->view('left');	
		$this->load->view('garantia/pagar', array('remate_id' => $remate_id, 'ofertante_id' => $ofertante_id, 'remate' => $este_remate, 'mensaje' => $mensaje, 'boton' => $boton));
		$this->load->view('footer');
		
	}
	
	public function enviar_datos_por_correo($data)
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		$datos_ofertante = $this->garantia_model->obtener_datos_ofertante($data['ofertante_id']);
		$datos_remate = $this->garantia_model->obtener_datos_remate($data['remate_id']);
		
		$email = $datos_ofertante->ofertante_correo;
		
		if ( $email != null )
		{
			$datos = array(
				'ofertante_nombre' => $datos_ofertante->ofertante_nombre,
				'ofertante_apellido' => $datos_ofertante->ofertante_apellido,
				'remate_nombre' => $datos_remate->remate_nombre,
				'remate_nombre_mandante' => $datos_remate->remate_nombre_mandante,
				'remate_precio_garantia' => $datos_remate->remate_precio_garantia,
				'garantia_estado' => $data['garantia_estado'],
				'garantia_tipo_pago' => $data['garantia_tipo_pago'],
				'garantia_fecha_ingreso' => $data['garantia_fecha_ingreso']
			);
			
			$this->CI->email->from('soporte@remate.rsiauctions.com', 'Registro en rsiauctions.com');
			$this->CI->email->to($datos_ofertante->ofertante_correo);
			$this->CI->email->bcc('soporte@imacom.cl'); 
			$this->CI->email->subject('Registro de garantía - Estado: pendiente - rsiauctions.com');
			$plantilla = $this->CI->load->view('mail/envio_garantia_pendiente', $datos, true);
			$this->CI->email->message($plantilla);
			$this->CI->email->send();
			return true;	

		}
		else return false;
	}
	
	public function enviar_datos_por_correo_rematador($data)
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		$datos_ofertante = $this->garantia_model->obtener_datos_ofertante($data['ofertante_id']);
		$datos_remate = $this->garantia_model->obtener_datos_remate($data['remate_id']);
		$datos_rematador = $this->garantia_model->obtener_datos_rematador($data['remate_id']);
		
		$email = $datos_rematador->rematador_correo;
		
		if ( $email != null )
		{
			$datos = array(
				'ofertante_nombre' => $datos_ofertante->ofertante_nombre,
				'ofertante_apellido' => $datos_ofertante->ofertante_apellido,
				'ofertante_nickname' => $datos_ofertante->ofertante_nickname,
				'ofertante_rut' => $datos_ofertante->ofertante_rut,
				'ofertante_correo' => $datos_ofertante->ofertante_correo,
				'ofertante_fono' => $datos_ofertante->ofertante_fono,
				'ofertante_movil' => $datos_ofertante->ofertante_movil,
				'ofertante_ciudad' => $datos_ofertante->ofertante_ciudad,
				'remate_nombre' => $datos_remate->remate_nombre,
				'remate_nombre_mandante' => $datos_remate->remate_nombre_mandante,
				'remate_precio_garantia' => $datos_remate->remate_precio_garantia,
				'garantia_estado' => $data['garantia_estado'],
				'garantia_tipo_pago' => $data['garantia_tipo_pago'],
				'garantia_fecha_ingreso' => $data['garantia_fecha_ingreso']
			);
			
			$this->CI->email->from('soporte@remate.rsiauctions.com', 'Registro en rsiauctions.com');
			$this->CI->email->to($datos_rematador->rematador_correo);
			$this->CI->email->bcc('soporte@imacom.cl'); 
			$this->CI->email->subject('Registro de garantía - Una garantía pendiente en su remate - rsiauctions.com');
			$plantilla = $this->CI->load->view('mail/envio_garantia_pendiente_rematador', $datos, true);
			$this->CI->email->message($plantilla);
			$this->CI->email->send();
			return true;	

		}
		else return false;
	}
	
	function panel()
	{
		if ($this->session->userdata('tipo') == "rematador")
		{
			
		$mis_garantias = $this->garantia_model->obtener_todas_las_garantias();
			
		$this->load->view('header');	
		$this->load->view('left');	
		$this->load->view('garantia/panel', array('garantia' => $mis_garantias));	
		$this->load->view('footer');	
		}
		else
		{
			redirect(base_url());
		}
	}
	
	function activar_ofertante()
	{
		if ($this->session->userdata('tipo') == "rematador")
		{
		$garantia_id = $this->uri->segment(3);
		$this->garantia_model->activar_ofertante($garantia_id);
		$this->enviar_datos_por_correo_garantia_activada($garantia_id);
		redirect('garantia/panel');
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function enviar_datos_por_correo_garantia_activada($garantia_id)
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		$datos_garantia = $this->garantia_model->obtener_datos_garantia($garantia_id);
		$ofertante_id = $datos_garantia->ofertante_id;
		$remate_id = $datos_garantia->remate_id;
		
		$datos_ofertante = $this->garantia_model->obtener_datos_ofertante($ofertante_id);
		$datos_remate = $this->garantia_model->obtener_datos_remate($remate_id);
		
		$email = $datos_ofertante->ofertante_correo;
		
		if ( $email != null )
		{
			$datos = array(
				'ofertante_nombre' => $datos_ofertante->ofertante_nombre,
				'ofertante_apellido' => $datos_ofertante->ofertante_apellido,
				'remate_nombre' => $datos_remate->remate_nombre,
				'remate_precio_garantia' => $datos_remate->remate_precio_garantia,
				'garantia_estado' => $datos_garantia->garantia_estado,
				'garantia_tipo_pago' => $datos_garantia->garantia_tipo_pago,
				'garantia_fecha_ingreso' => $datos_garantia->garantia_fecha_ingreso
			);
			
			$this->CI->email->from('soporte@remate.rsiauctions.com', 'Registro en rsiauctions.com');
			$this->CI->email->to($datos_ofertante->ofertante_correo);
			$this->CI->email->bcc('soporte@imacom.cl'); 
			$this->CI->email->subject('Registro de garantía - Estado: pagada - rsiauctions.com');
			$plantilla = $this->CI->load->view('mail/envio_garantia_pagada', $datos, true);
			$this->CI->email->message($plantilla);
			$this->CI->email->send();
			return true;	

		}
		else return false;
	}
	
}	