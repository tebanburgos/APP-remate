<?php if ( ! defined('BASEPATH')) exit('Acceso Directo no Permitido');
Class Rematador extends CI_Controller
{
	private $nombre_foto_adjunta;
	private $password_no_encriptada;
	public $CI;
	
	public function __construct()
	{
		parent::__construct();
		$this->CI =& get_instance();	
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form'));
		$this->load->model(array('rematador_model'));
		$this->load->library(array('auth'));
		$this->load->helper('url');
		$this->load->library('session');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>','</div>');
	}

	public function subir_foto_adjunta()
	{
		$config['upload_path'] = "./uploads/pictures/rematadores/";
		$config['allowed_types'] = 'gif|jpg|jpeg|png|tif|tiff|bmp';
		$config['overwrite'] = false;
		$config['max_size'] = '3072';
		$config['remove_spaces'] = true;
		$this->load->library('upload', $config);
		
		$this->upload->initialize($config);
				
		$registro = $this->quitaAcentos("rematador_foto");
					
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
			}					
	}
	
	public function quitaAcentos($cadena)
	{
		$p = array('á','é','í','ó','ú','Á','É','Í','Ó','Ú','ñ','Ñ',' ');
		$r = array('a','e','i','o','u','A','E','I','O','U','n','N','_');
		return str_replace($p, $r, $cadena);
	}
	
	//Metodo que carga vista del registro del usuario rematador
	public function registrar()
	{
		$mensaje = "Ingrese Todos Los Campos Requeridos";
		$this_correo = "";
		
		// Reglas de validacion
	
        $this->form_validation->set_rules('rematador_correo','Correo','required|valid_email');
        $this->form_validation->set_rules('rematador_password','Contraseña','required|matches[rematador_password_2]');
        $this->form_validation->set_rules('rematador_password_2','Repetir Contraseña','required');
        $this->form_validation->set_rules('rematador_razon_social','Razon Social','required');
		$this->form_validation->set_rules('rematador_nombre_empresa','Nombre Empresa','required');
		$this->form_validation->set_rules('rematador_rut_empresa','Rut Empresa','required');
		$this->form_validation->set_rules('rematador_nombre_empresa','Nombre Empresa','required');
		$this->form_validation->set_rules('rematador_nombre_responsable','Nombre Responsable','required');
		$this->form_validation->set_rules('rematador_apellido_responsable','Apellido Responsable','required');
		$this->form_validation->set_rules('rematador_rut_responsable','Rut Responsable','required');
		$this->form_validation->set_rules('rematador_direccion','Direccion','required');
		$this->form_validation->set_rules('rematador_ciudad','Ciudad','required');
		$this->form_validation->set_rules('rematador_telefono','Telefono Fijo');
		$this->form_validation->set_rules('rematador_movil','Telefono Movil');
		$this->form_validation->set_rules('rematador_descripcion_activos','Descripción Activos');
		$this->form_validation->set_rules('rematador_contrato','Aceptar Terminos del Contrato','required');
		
		if ($_POST){
			
			$this_correo = "no_existe";
			
			if ($this->rematador_model->consultar_correo_existente($_POST['rematador_correo'])){
					$this_correo = "existe";
				}
				
			$this->subir_foto_adjunta();
			$this->password_no_encriptada = $_POST['rematador_password'];
			
			$datos_registro['rematador_correo'] = $_POST['rematador_correo'];
			$datos_registro['rematador_password'] = md5($_POST['rematador_password']);
			$datos_registro['rematador_razon_social'] = $_POST['rematador_razon_social'];
			$datos_registro['rematador_nombre_empresa'] = $_POST['rematador_nombre_empresa'];
			$datos_registro['rematador_rut_empresa'] = $_POST['rematador_rut_empresa'];
			$datos_registro['rematador_nombre_responsable'] = $_POST['rematador_nombre_responsable'];
			$datos_registro['rematador_apellido_responsable'] = $_POST['rematador_apellido_responsable'];
			$datos_registro['rematador_rut_responsable'] = $_POST['rematador_rut_responsable'];
			//editar esta linea de código para que capture la foto
		//	$datos_registro['rematador_foto'] = $_POST['rematador_foto'];
		if($this->nombre_foto_adjunta == NULL)
		{
			$datos_registro['rematador_foto'] = 'sinfoto.jpg';
		}
		else
		{
			$datos_registro['rematador_foto'] = $this->nombre_foto_adjunta;
		}
			$datos_registro['rematador_direccion'] = $_POST['rematador_direccion'];
			$datos_registro['rematador_ciudad'] = $_POST['rematador_ciudad'];
			$datos_registro['rematador_region'] = $_POST['rematador_region'];
			$datos_registro['rematador_pais'] = $_POST['rematador_pais'];
			$datos_registro['rematador_telefono'] = $_POST['rematador_telefono'];
			$datos_registro['rematador_movil'] = $_POST['rematador_movil'];
			$datos_registro['rematador_descripcion_activos'] = $_POST['rematador_descripcion_activos'];
			//editar esta línea de código para que el estado no siempre sea activo
			$datos_registro['rematador_estado'] = $_POST['rematador_estado'];
		
			// Verificar validacion correcta
			if ($this->form_validation->run() == FALSE or $this_correo == "existe"){
				// Retornar errores de validacion
				$mensaje = validation_errors();
			}else{
				$mensaje = "correcto";
				$this->rematador_model->registrar($datos_registro);
				$this->enviar_datos_por_correo($datos_registro, $this->password_no_encriptada);
				
			}        
		}
		else {
			$datos_registro['rematador_correo'] = "";
			$datos_registro['rematador_password'] = "";
			$datos_registro['rematador_razon_social'] = "";
			$datos_registro['rematador_nombre_empresa'] = "";
			$datos_registro['rematador_rut_empresa'] = "";
			$datos_registro['rematador_nombre_responsable'] = "";
			$datos_registro['rematador_apellido_responsable'] = "";
			$datos_registro['rematador_rut_responsable'] = "";
			$datos_registro['rematador_foto'] = "";
			$datos_registro['rematador_direccion'] = "";
			$datos_registro['rematador_ciudad'] = "";
			$datos_registro['rematador_region'] = "";
			$datos_registro['rematador_pais'] = "";
			$datos_registro['rematador_telefono'] = "";
			$datos_registro['rematador_movil'] = "";
			$datos_registro['rematador_descripcion_activos'] = "";
			$datos_registro['rematador_estado'] = "";
		}

				
		$this->load->view('header');	
		$this->load->view('left');	
		$this->load->view('rematador/registrar', array('mensaje_error' => $mensaje, 'datos' => $datos_registro, 'correo' => $this_correo));	
	//	$this->load->view('right');	
		$this->load->view('footer');	
	}	

	//Metodo que carga la vista del panel de control del usuario rematador
	public function panel_de_control()
	{
		if ($this->session->userdata('tipo') == "rematador")
		{
			$this->load->view('header');
			$this->load->view('left');	
			$this->load->view('rematador/panel_de_control');	
		//	$this->load->view('right');	
			$this->load->view('footer');	
		}
		else
		{
		//	header('location: http://re-remate.s2.imacom.cl/');
			redirect(base_url());
		}
	}	

   	//Carga la vista Login de usuarios rematadores
	public function acceso()
	{
		// Recupera los datos de la sesión
		$session_set_value = $this->session->all_userdata();
		
		// Verifica si hay datos en el "Recuérdame" para poder recuperar la sesión anterior
		if (isset($session_set_value['remember_me']) && $session_set_value['remember_me'] == "1") {
		redirect(base_url());
		} else
		{
		$this->load->view('header');	
		$this->load->view('left');	
		$this->load->view('rematador/acceso');
	//	$this->load->view('right');	
		$this->load->view('footer');	
		}
	}	
	
	public function enviar_datos_por_correo($datos_registro, $password_no_encriptada)
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		$email = $datos_registro['rematador_correo'];
		
		$rematador = $this->CI->db->get_where('rematadores', array('rematador_correo' => $email))->row();
		if ( count($rematador) > 0 )
		{
			$rematador_token_activacion = sha1(uniqid(mt_rand(), true));
			$this->CI->db
				->where(array('rematador_correo' => $email))
				->update('rematadores', array('rematador_token_activacion' => $rematador_token_activacion));
			$datos = array(
				'rematador_nombre_responsable' => $rematador->rematador_nombre_responsable,
				'rematador_apellido_responsable' => $rematador->rematador_apellido_responsable,
				'rematador_nombre_empresa' => $rematador->rematador_nombre_empresa,
				'rematador_razon_social' => $rematador->rematador_razon_social,
				'rematador_rut_empresa' => $rematador->rematador_rut_empresa,
				'rematador_password' => $password_no_encriptada,
				'rematador_rut_responsable' => $rematador->rematador_rut_responsable,
				'rematador_telefono' => $rematador->rematador_telefono,
				'rematador_movil' => $rematador->rematador_movil,
				'rematador_correo' => $rematador->rematador_correo,
				'rematador_token_activacion' => $rematador_token_activacion
			);
			
			$this->CI->email->from('soporte@re-rsiauctions.com', 'Registro en rsiauctions.com');
			$this->CI->email->to($rematador->rematador_correo);
			$this->CI->email->bcc('soporte@imacom.cl'); 
			$this->CI->email->subject('Registro de Rematadores - rsiauctions.com');
			$plantilla = $this->CI->load->view('mail/envio_datos_rematador', $datos, true);
			$this->CI->email->message($plantilla);
			$this->CI->email->send();
			return true;	

		}
		else return false;
	}
	
	
	function activacion()
	{
		$rematador_token_activacion = $this->uri->segment(3);
		$rematador_id = $this->rematador_model->obtener_id_del_rematador_por_token_activacion($rematador_token_activacion);
		if ($_POST)
			{
				$insert_data = $this->rematador_model->actualizar_activacion($rematador_id, $_POST['rematador_estado']);
				$this->session->set_flashdata('mensaje', 'Su cuenta ha sido activada exitosamente');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
				$this->enviar_datos_confirmados_por_correo($rematador_id);
				redirect('rematador/acceso');
			}
		$this->_view('rematador/activacion');
	}
	
	public function enviar_datos_confirmados_por_correo($rematador_id)
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		$rematador = $this->CI->db->get_where('rematadores', array('rematador_id' => $rematador_id))->row();
		if ( count($rematador) > 0 )
		{
			$datos = array(
				'rematador_nombre_responsable' => $rematador->rematador_nombre_responsable,
				'rematador_apellido_responsable' => $rematador->rematador_apellido_responsable,
				'rematador_correo' => $rematador->rematador_correo,
			);
			
			$this->CI->email->from('soporte@rsiauctions.com', 'Registro en rsiauctions.com');
			$this->CI->email->to($rematador->rematador_correo);
			$this->CI->email->bcc('soporte@imacom.cl'); 
			$this->CI->email->subject('Registro confirmado de Rematadores - rsiauctions.com');
			$plantilla = $this->CI->load->view('mail/envio_datos_confirmados_rematador', $datos, true);
			$this->CI->email->message($plantilla);
			$this->CI->email->send();
			return true;
		}
		else return false;
	}

	
	public function recuperar_clave()
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		if ( $this->form_validation->run('recuperar_clave') == false )
		{			
			$this->load->view('header');
			$this->_view('rematador/recuperar_clave', NULL, FALSE);
			$this->load->view('footer');			
		}
		else
		{
			if ( $this->auth->recuperar_clave_rematador($this->input->post('email')) )
			{
				$this->session->set_flashdata('mensaje', 'Hemos enviado un correo electrónico con las instruciones para recuperar su contraseña');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-info');
				redirect('rematador/acceso');
			}
			else
			{
				$this->session->set_flashdata('mensaje', 'Este email no se encuentra registrado');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-info');
				$this->load->view('header');
				$this->_view('rematador/recuperar_clave', NULL, FALSE);
				$this->load->view('footer');
			}
		}		
	}
	
		function cambiar_clave()
	{
		$rematador_token_recuperar_clave = $this->uri->segment(3);
		$rematador_id = $this->rematador_model->obtener_id_del_rematador_por_token($rematador_token_recuperar_clave);
		if ($_POST)
			{
				$clave_encriptada = md5($_POST['clave']);
				$insert_data = $this->rematador_model->actualizar_nueva_password($rematador_id, $clave_encriptada);
				$this->session->set_flashdata('mensaje', 'Contraseña cambiada exitosamente');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
				redirect('rematador/acceso');
			}
		$this->_view('rematador/cambiar_clave');
	}

	//Metodo del Login, consulta en la base de datos por el nombre de usuario y password ingresados para su validación
	public function accesar(){
		
		// Recupera los datos de la sesión
		$session_set_value = $this->session->all_userdata();
		
		// Verifica si hay datos en el "Recuérdame" para poder recuperar la sesión anterior
		if (isset($session_set_value['remember_me']) && $session_set_value['remember_me'] == "1") {
		redirect(base_url());
		} else
		{
		
		$datos_usuario['rematador_correo'] = $_POST['rematador_correo'];
		$datos_usuario['rematador_password'] = md5($_POST['rematador_password']);
		$remember =  $this->input->post('remember_me');
		$validacion = $this->rematador_model->consultar_password($datos_usuario);
		
		if ($remember) 
		{
			// Captura del "recuérdame" si el usuario desea que la sesión sea recordada
			$this->session->set_userdata('remember_me', TRUE);
		}
		
		//Crea la session del usuario logeado	
		if ($validacion) {
			
			$datos_session = array(
				'id'  => $validacion->rematador_id,
				'email'     => $validacion->rematador_correo,
				'nombre'  => $validacion->rematador_nombre_empresa,
				'rut'  => $validacion->rematador_rut_empresa,
				'tipo' => "rematador",
				'estado' => $validacion->rematador_estado,
				'ingresado' => TRUE
			);

			$this->session->set_userdata($datos_session);
			
			if($this->session->userdata('estado') == "activo")
			{
			//	header('location: http://re-remate.s2.imacom.cl/');
				redirect(base_url());
			}
			else
			{
				$this->session->set_flashdata('mensaje', 'El usuario no está activo.<br> Revise su correo para confirmar su usuario dentro del Portal');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
				redirect('rematador/acceso');
			}
		}
		else
		{
			$this->session->set_flashdata('mensaje', 'Usuario y/o contraseña inválida.<br> Intente de nuevo o contáctese con el administrador del sitio');
			$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			//header('location: http://re-remate.s2.imacom.cl/index.php/rematador/acceso');
			redirect('rematador/acceso');
		}
		}
		
	}
	
	//Función que destruye la session deslogueando al usuario actual
	public function salir(){
		$this->session->sess_destroy();
		redirect(base_url());
	//	header('location: http://re-remate.s2.imacom.cl/');	
	}
	
	public function administrar()
	{
		if ($this->session->userdata('tipo') == "rematador")
		{
			$remate = $this->rematador_model->obtener();
			$this->load->view('header');
			$this->load->view('rematador/administrar');
			$this->load->view('footer');
		}
		else
		{
		//	header('location: http://re-remate.s2.imacom.cl/');
			redirect(base_url());
		}
	}
	
	private function _view($view = 'admin/administrar', $data = NULL, $layout = TRUE)
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

?>