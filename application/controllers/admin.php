<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form'));
		$this->load->model(array('admin_model'));
		$this->load->library(array('auth'));
		$this->load->helper('url');
		$this->load->library('session');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>','</div>');
	}
	
		public function index()
	{
		// Nada por defecto
	}
	
	public function entrar()
	{
		if ( $this->auth->check()) redirect('/index.php');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		if ( $this->form_validation->run('entrar') == FALSE )
		{
			$this->load->view('header');
			$this->_view('admin/entrar', NULL, FALSE);	
			$this->load->view('footer');
		}
		else
		{
			if ( $this->auth->login($this->input->post('admin'), $this->input->post('clave')) )
			{
				redirect(base_url());
			}
			else
			{
				$this->session->set_flashdata('mensaje', 'Usuario y/o contraseña incorrectos, o su cuenta aún no ha sido autorizada por un Administrador');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
				redirect('admin/entrar');
			}
		}
	}
	
	public function salir()
	{
		$this->auth->logout();
		redirect('/index.php');
	}
	
	
	public function recuperar_clave()
	{
		$this->load->library('email');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		if ( $this->form_validation->run('recuperar_clave') == false )
		{			
			$this->load->view('header');
			$this->_view('admin/recuperar_clave', NULL, FALSE);
			$this->load->view('footer');			
		}
		else
		{
			if ( $this->auth->recuperar($this->input->post('email')) )
			{
				$this->session->set_flashdata('mensaje', 'Hemos enviado un correo electrónico con las instruciones para recuperar su contraseña');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-info');
				redirect('admin/entrar');
			}
			else
			{
				$this->session->set_flashdata('mensaje', 'Este email no se encuentra registrado');
				$this->session->set_flashdata('mensaje_clase', 'alert alert-info');
				$this->load->view('header');
				$this->_view('admin/recuperar_clave', NULL, FALSE);
				$this->load->view('footer');
			}
		}		
	}
	
	
		function cambiar_clave()
	{
		$token_recuperar_clave = $this->uri->segment(3);
		$token_sesion = $this->session->flashdata('token_recuperar_clave');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		if ( ! empty($token_recuperar_clave) )
		{
			$admin = $this->db->get_where('admin', array('token_recuperar_clave' => $this->uri->segment(3)))->row();
			if (count($admin) == 1)
			{
				$this->session->set_flashdata('token_recuperar_clave', $token_recuperar_clave);
			}
			else redirect('admin/entrar');
		}
		elseif ( ! empty($token_sesion) )
		{
			$token_recuperar_clave = $this->session->flashdata('token_recuperar_clave');
			$this->session->keep_flashdata('token_recuperar_clave');
		}
		elseif ( $this->auth->check()) $token_recuperar_clave = NULL;
		else redirect('admin/entrar');
		if ( $this->form_validation->run('cambiar_clave') == FALSE )
		{
				$this->_view('admin/cambiar_clave');
		}
		else
		{
			$clave = $this->input->post('clave');
			$hash = crypt($clave);
			if ( empty($token_recuperar_clave) && $this->auth->check() )
			{
				$this->db->where(array('admin_id' => $this->auth->get_id()));
			}
			else
			{
				$this->db->where(array('token_recuperar_clave' => $token_recuperar_clave))	;
			}
			$this->db->update('admin', array('clave' => $hash));
			$this->session->set_flashdata('mensaje', 'Contraseña cambiada exitosamente');
			$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
			redirect('admin/entrar');
		}
	}
	
	
	public function administrar()
	{
		if ( $this->auth->check('admin')): 
		$admin = $this->admin_model->obtener();
		$this->_view('admin/administrar_usuario', array('admin' => $admin));
		endif;
	}
	
	public function panel_de_control()
	{
	//	if ( $this->auth->check('admin')): 
	//	$admin = $this->admin_model->obtener();
	//	$this->_view('admin/panel_de_control', array('admin' => $admin));
		$this->load->view('header');
		$this->load->view('admin/panel_de_control');
		$this->load->view('footer');
	
	
	//	endif;
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
	

/*	public function index()
	{
		$this->load->view('admin/login');
	}
*/
}