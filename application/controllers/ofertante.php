<?php if ( ! defined('BASEPATH')) exit('Acceso Directo no Permitido');
Class Ofertante extends CI_Controller
{
	private $password_no_encriptada;
	public $CI;
	
	public function __construct()
	{
		parent::__construct();
		$this->CI =& get_instance();	
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form'));
		$this->load->model(array('ofertante_model'));
		$this->load->library(array('auth'));
		$this->load->helper('url');
		$this->load->library('session');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>','</div>');
	}
	
	//Metodo que carga vista del registro del usuario ofertante
	public function registrar()
	{
		$mensaje = "Ingrese Todos Los Campos Requeridos";
		$this_correo = "";
		$this_nick = "";
		$this_rut = "";
			
		// Reglas de validacion
		$this->form_validation->set_rules('ofertante_nickname','Login','required');
        $this->form_validation->set_rules('ofertante_correo','Correo','required|valid_email');
        $this->form_validation->set_rules('ofertante_password','Contraseña','required|matches[ofertante_password_2]');
        $this->form_validation->set_rules('ofertante_password_2','Repetir Contraseña','required');
        $this->form_validation->set_rules('ofertante_apellido','Apellido','required');
		$this->form_validation->set_rules('ofertante_rut','Rut','required');
		$this->form_validation->set_rules('ofertante_fono','Telefono Fijo');
		$this->form_validation->set_rules('ofertante_movil','Telefono Movil');
		$this->form_validation->set_rules('ofertante_direccion','Dirección','required');
		$this->form_validation->set_rules('ofertante_ciudad','Ciudad','required');
		$this->form_validation->set_rules('ofertante_region','Región','required');
		$this->form_validation->set_rules('ofertante_pais','País','required');
		$this->form_validation->set_rules('ofertante_contrato','Aceptar Terminos del Contrato','required');
		
		if ($_POST){
			
			$this_correo = "no_existe";
			$this_nick = "no existe";
			$this_ = "no existe";
			
			
			if ($this->ofertante_model->consultar_correo_existente($_POST['ofertante_correo'])){
					$this_correo = "existe";
				}
			if ($this->ofertante_model->consultar_nick_existente($_POST['ofertante_nickname'])){
					$this_nick = "existe";
				}
			
			$this->password_no_encriptada = $_POST['ofertante_password'];
			
			$datos_registro['ofertante_nickname'] = $_POST['ofertante_nickname'];			
			$datos_registro['ofertante_correo'] = $_POST['ofertante_correo'];
			$datos_registro['ofertante_password'] = md5($_POST['ofertante_password']);
			$datos_registro['ofertante_nombre'] = $_POST['ofertante_nombre'];
			$datos_registro['ofertante_apellido'] = $_POST['ofertante_apellido'];
			$datos_registro['ofertante_rut'] = $_POST['ofertante_rut'];
			$datos_registro['ofertante_fono'] = $_POST['ofertante_fono'];
			$datos_registro['ofertante_movil'] = $_POST['ofertante_movil'];
			$datos_registro['ofertante_direccion'] = $_POST['ofertante_direccion'];
			$datos_registro['ofertante_ciudad'] = $_POST['ofertante_ciudad'];
			$datos_registro['ofertante_region'] = $_POST['ofertante_region'];
			$datos_registro['ofertante_pais'] = $_POST['ofertante_pais'];
			$datos_registro['ofertante_estado'] = $_POST['ofertante_estado'];
		
			// Verificar validacion correcta
			if ($this->form_validation->run() == FALSE or $this_correo == "existe" or $this_nick == "existe"){
				// Retornar errores de validacion
				$mensaje = validation_errors();
			}else{
				$mensaje = "correcto";
				$this->ofertante_model->registrar($datos_registro);
				$this->enviar_datos_por_correo($datos_registro, $this->password_no_encriptada);
			}        
		}
		else {
			$datos_registro['ofertante_nickname'] = "";
			$datos_registro['ofertante_correo'] = "";
			$datos_registro['ofertante_password'] = "";
			$datos_registro['ofertante_nombre'] = "";
			$datos_registro['ofertante_apellido'] = "";
			$datos_registro['ofertante_rut'] = "";
			$datos_registro['ofertante_fono'] = "";
			$datos_registro['ofertante_movil'] = "";
			$datos_registro['ofertante_direccion'] = "";
			$datos_registro['ofertante_ciudad'] = "";
			$datos_registro['ofertante_region'] = "";
			$datos_registro['ofertante_pais'] = "";
			$datos_registro['ofertante_estado'] = "";
		}

				
		$this->load->view('header');	
		$this->load->view('left');	
		$this->load->view('ofertante/registrar', array('mensaje_error' => $mensaje, 'datos' => $datos_registro, 'correo' => $this_correo, 'nickname' => $this_nick));	
		$this->load->view('right');	
		$this->load->view('footer');	
	}
	
	public function enviar_datos_por_correo($datos_registro, $password_no_encriptada)
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		$email = $datos_registro['ofertante_correo'];
		
		$ofertante = $this->CI->db->get_where('ofertantes', array('ofertante_correo' => $email))->row();
		if ( count($ofertante) > 0 )
		{
			$ofertante_token_activacion = sha1(uniqid(mt_rand(), true));
			$this->CI->db
				->where(array('ofertante_correo' => $email))
				->update('ofertantes', array('ofertante_token_activacion' => $ofertante_token_activacion));
			$datos = array(
				'ofertante_nombre' => $ofertante->ofertante_nombre,
				'ofertante_apellido' => $ofertante->ofertante_apellido,
				'ofertante_rut' => $ofertante->ofertante_rut,
				'ofertante_password' => $password_no_encriptada,
				'ofertante_fono' => $ofertante->ofertante_fono,
				'ofertante_movil' => $ofertante->ofertante_movil,
				'ofertante_nickname' => $ofertante->ofertante_nickname,
				'ofertante_correo' => $ofertante->ofertante_correo,
				'ofertante_token_activacion' => $ofertante_token_activacion
			);
			
			$this->CI->email->from('soporte@remate.rsiauctions.com', 'Registro en rsiauctions.com');
			$this->CI->email->to($ofertante->ofertante_correo);
			$this->CI->email->bcc('soporte@imacom.cl'); 
			$this->CI->email->subject('Registro de Ofertante - rsiauctions.com');
			$plantilla = $this->CI->load->view('mail/envio_datos_ofertante', $datos, true);
			$this->CI->email->message($plantilla);
			$this->CI->email->send();
			return true;	

		}
		else return false;
	}
	
		function activacion()
	{
		$ofertante_token_activacion = $this->uri->segment(3);
		$ofertante_id = $this->ofertante_model->obtener_id_del_ofertante_por_token_activacion($ofertante_token_activacion);
		if ($_POST)
			{
				$insert_data = $this->ofertante_model->actualizar_activacion($ofertante_id, $_POST['ofertante_estado']);
				$this->session->set_flashdata('mensaje', 'Su cuenta ha sido activada exitosamente');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
				$this->enviar_datos_confirmados_por_correo($ofertante_id);
				redirect('ofertante/acceso');
			}
		$this->_view('ofertante/activacion');
	}
	
	public function enviar_datos_confirmados_por_correo($ofertante_id)
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		$ofertante = $this->CI->db->get_where('ofertantes', array('ofertante_id' => $ofertante_id))->row();
		if ( count($ofertante) > 0 )
		{
			$datos = array(
				'ofertante_nombre' => $ofertante->ofertante_nombre,
				'ofertante_apellido' => $ofertante->ofertante_apellido,
				'ofertante_correo' => $ofertante->ofertante_correo,
			);
			
			$this->CI->email->from('soporte@rsiauctions.com', 'Registro en rsiauctions.com');
			$this->CI->email->to($ofertante->ofertante_correo);
			$this->CI->email->bcc('soporte@imacom.cl'); 
			$this->CI->email->subject('Registro confirmado de Ofertantes - rsiauctions.com');
			$plantilla = $this->CI->load->view('mail/envio_datos_confirmados_ofertante', $datos, true);
			$this->CI->email->message($plantilla);
			$this->CI->email->send();
			return true;
		}
		else return false;
	}
	
	//Metodo que carga la vista del panel de control del usuario ofertante
	public function panel_de_control()
	{
		if ($this->session->userdata('tipo') == "ofertante")
		{
		$this->load->view('header');	
		$this->load->view('left');	
		$this->load->view('ofertante/panel_de_control');	
//		$this->load->view('right');	
		$this->load->view('footer');	
		}
		else
		{
			redirect(base_url());
		}
	}	
	


	//Carga la vista Login de usuarios ofertantes
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
			$this->load->view('ofertante/acceso');	
//			$this->load->view('right');	
			$this->load->view('footer');
		}
	}

	public function recuperar_clave()
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		if ( $this->form_validation->run('recuperar_clave') == false )
		{			
			$this->load->view('header');
			$this->_view('ofertante/recuperar_clave', NULL, FALSE);
			$this->load->view('footer');			
		}
		else
		{
			if ( $this->auth->recuperar_clave_ofertante($this->input->post('email')) )
			{
				$this->session->set_flashdata('mensaje', 'Hemos enviado un correo electrónico con las instruciones para recuperar su contraseña');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-info');
				redirect('ofertante/acceso');
			}
			else
			{
				$this->session->set_flashdata('mensaje', 'Este email no se encuentra registrado');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-info');
				$this->load->view('header');
				$this->_view('ofertante/recuperar_clave', NULL, FALSE);
				$this->load->view('footer');
			}
		}		
	}

		function cambiar_clave()
	{
		$ofertante_token_recuperar_clave = $this->uri->segment(3);
		$ofertante_id = $this->ofertante_model->obtener_id_del_ofertante_por_token($ofertante_token_recuperar_clave);
		if ($_POST)
			{
				$clave_encriptada = md5($_POST['clave']);
				$insert_data = $this->ofertante_model->actualizar_nueva_password($ofertante_id, $clave_encriptada);
				$this->session->set_flashdata('mensaje', 'Contraseña cambiada exitosamente');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
				redirect('ofertante/acceso');
			}
		$this->_view('ofertante/cambiar_clave');
				
				

	}	
	
	//Metodo del Login, consulta en la base de datos por el nombre de usuario y password ingresados para su validación.
	public function accesar(){
		
		// Recupera los datos de la sesión
		$session_set_value = $this->session->all_userdata();
		
		// Verifica si hay datos en el "Recuérdame" para poder recuperar la sesión anterior
		if (isset($session_set_value['remember_me']) && $session_set_value['remember_me'] == "1") {
		redirect(base_url());
		} else
		{
		
		$datos_usuario['ofertante_correo'] = $_POST['ofertante_correo'];
		$datos_usuario['ofertante_password'] = md5($_POST['ofertante_password']);
		$remember =  $this->input->post('remember_me');
		$validacion = $this->ofertante_model->consultar_password($datos_usuario);
		
		if ($remember) 
		{
			// Captura del "recuérdame" si el usuario desea que la sesión sea recordada
			$this->session->set_userdata('remember_me', TRUE);
		}
	
		//Crea la session del usuario logeado	
		if ($validacion) {
			
			$datos_session = array(
				'id'  => $validacion->ofertante_id,
				'email'     => $validacion->ofertante_correo,
				'nombre'  => $validacion->ofertante_nombre." ".$validacion->ofertante_apellido,
				'rut'  => $validacion->ofertante_rut,
				'tipo' => "ofertante",
				'estado' => $validacion->ofertante_estado,
				'ingresado' => TRUE
			);

			$this->session->set_userdata($datos_session);
			
			if($this->session->userdata('estado') == "activo")
			{
				redirect(base_url());
			}
			else
			{
				$this->session->set_flashdata('mensaje', 'El usuario no está activo.<br> Revise su correo para confirmar su usuario dentro del Portal');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
				redirect('ofertante/acceso');
			}
		}
		else {
				$this->session->set_flashdata('mensaje', 'Usuario y/o contraseña inválida.<br> Intente de nuevo o contáctese con el administrador del sitio');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
				redirect('ofertante/acceso');
			}
		}
	}
	
	function validar_rut($rut,$digito_v)
	{ 
		if ($rut == "")
		{ 
			$verificado=false; 
			return $verificado; 
		} 

		$x=2; 
		$sumatorio=0; 
		for ($i=strlen($rut)-1;$i>=0;$i--)
		{ 
			if ($x>7)
			{
				$x=2;
			}
			$sumatorio=$sumatorio+($rut[$i]*$x); 
			$x++; 
		} 
		$digito=$sumatorio%11; 
		$digito=11-$digito; 

		switch ($digito)
		{ 
			case 10:
				$digito="k";
			break; 
			case 11: 
				$digito="0";
			break;
		} 

		if (strtolower($digito_v)==$digito)
		{
			$verificado=true;
		}
		else
		{ 
			$verificado=false; 
		}
		return $verificado; 
	} 
	
	//Función que destruye la session deslogueando al usuario actual
	public function salir(){
		$this->session->sess_destroy();
		//header('location: http://re-remate.s2.imacom.cl/');
		redirect(base_url());
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