<?php if ( ! defined('BASEPATH')) exit('Acceso Directo no Permitido');
class Tipo_categoria extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form'));
		$this->load->model(array('tipo_categoria_model'));
		$this->load->library(array('auth'));
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>','</div>');
 		$this->load->helper(array('url'));
		$this->load->library(array('session'));
		$this->load->helper(array('imacom'));
		$this->load->helper('imacom');
		
	}
	
	public function index()
	{
		// Nada por defecto
	}
	
	public function administrar()
	{	
		if ($this->session->userdata('tipo') == "rematador")
		{
		//	$this->output->enable_profiler(true);
			$categoria_id = $this->uri->segment(3);
			
			if ( is_numeric($categoria_id))
			{
				if ( $this->categoria_model->existe($categoria_id))
				{
					if ($this->categoria_model->activo($categoria_id))
					{
						if ($categoria_id != 1)
						{
							$categoria = $this->categoria_model->obtener_una_categoria($categoria_id);
							$tipos = $this->tipo_categoria_model->obtener_tipos_de_categoria($categoria_id, $categoria->categoria_nombre);
							$sin_tipo = $this->tipo_categoria_model->obtener_sin_tipo_de_la_categoria($categoria_id, $categoria->categoria_nombre);
				
							$this->load->view('header');	
							$this->load->view('tipo_categoria/administrar_tipo_categoria', array('tipos' => $tipos, 'categoria' => $categoria, 'sin_tipo' => $sin_tipo));
							$this->load->view('footer');
						}
						else
						{
							$this->session->set_flashdata('mensaje', 'No se puede editar este tipo de categoria.');
							$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
							redirect('categoria/administrar');
						}
					}
					else
					{
						$this->session->set_flashdata('mensaje', 'No se puede editar una categoría ya eliminada.');
						$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
						redirect('categoria/administrar');
					}
				}
				else
				{
					$this->session->set_flashdata('mensaje', 'La categoría que intenta acceder no existe. <br>
												   Inténtelo nuevamente o póngase en contacto con administrador del sitio. <br>
												   Si usted es el administrador verifique que la categoría exista en la Base de Datos.');
					$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
					redirect('categoria/administrar');
				}
			}
			else
			{
			//	$this->session->set_flashdata('mensaje', 'La categoría no es válida');
			//	$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
				redirect('categoria/administrar');
			}
		}
		else
		{
			$this->session->set_flashdata('mensaje', 'Debe estar logeado como rematador para poder acceder a este sección');
			$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			redirect(base_url());
		}
	}
	
	public function ingresar()
	{
//		$this->output->enable_profiler(true);
		if ($this->session->userdata('tipo') == "rematador")
		{
			$categoria_id = $this->uri->segment(3);
			if ($_POST['tipo_nombre'] != "")
			{
				$nombre_tipo_categoria = $_POST['tipo_nombre'];
				if (! $this->tipo_categoria_model->validar_existencia_del_tipo($nombre_tipo_categoria, $categoria_id))
				{
					if ( $this->tipo_categoria_model->ingresar($nombre_tipo_categoria, $categoria_id))
					{
						$this->session->set_flashdata('mensaje', 'Se agregó exitosamente el tipo <strong>'.$nombre_tipo_categoria.'</strong> en esta categoria.');
						$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
					}
					else
					{
						$this->session->set_flashdata('mensaje', 'Ocurrió un error al ingresar el tipo en esta categoría.');
						$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');				
					}
				}
				else
				{
					$this->session->set_flashdata('mensaje', 'Este tipo en esta categoría ya existe.<br> Verifique la existencia de esta misma o ingrese una nueva con otro nombre. ');
					$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
				}
			}
			redirect('tipo_categoria/administrar/'.$categoria_id);
		}
		else
		{
			$this->session->set_flashdata('mensaje', 'Debe estar logeado como rematador para poder acceder a este sección');
			$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			redirect(base_url());
		}
	}
	
		public function editar()
	{
		if ($this->session->userdata('tipo') == "rematador")
		{
		//	$this->output->enable_profiler(true);
			$tipo_id = $this->uri->segment(3);
			$datos_categoria = $this->tipo_categoria_model->obtener_datos_categoria_segun_tipo($tipo_id);
			$categoria_id = "";
			$nombre_categoria = "";
			foreach($datos_categoria->result() as $row)
				{
					$categoria_id = $row->categoria_id;
					$nombre_categoria = $row->categoria_nombre;
				}
 			if ( is_numeric($tipo_id))
			{
				if ( $this->tipo_categoria_model->existe($tipo_id))
				{
					if($this->tipo_categoria_model->activo($tipo_id))
					{
						if ($this->tipo_categoria_model->validar_tipo_estandar($categoria_id, $nombre_categoria) != $tipo_id)
						{
							$tipo_categoria = $this->tipo_categoria_model->obtener_un_tipo_categoria($tipo_id);
							
							if (isset($_POST["tipo_nombre"]))
							{
								if ($_POST['tipo_nombre'] != "")
								{
									$nombre_tipo_categoria = $_POST['tipo_nombre'];
									if (! $this->tipo_categoria_model->validar_existencia_de_nombre_del_tipo_categoria($nombre_tipo_categoria, $categoria_id))
									{
										if ( $this->tipo_categoria_model->editar())
										{
											$this->session->set_flashdata('mensaje', 'Se editó exitosamente el tipo de categoría <strong>'.$nombre_categoria.'</strong> a <strong>'.$nombre_tipo_categoria.'</strong>.');
											$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
										}
										else
										{
											$this->session->set_flashdata('mensaje', 'Ocurrió un error al editar el tipo de categoría <br> Por favor, inténtenlo nuevamente.');
											$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');				
										}				
									}
									else
									{
										$this->session->set_flashdata('mensaje', 'El tipo de categoría ya existe en '.$nombre_categoria.'.<br> Verifique la existencia de esta misma o edítela con otro nombre. ');
										$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
									}
									redirect('tipo_categoria/administrar/'.$categoria_id);
									break;
								}
							}
							$this->load->view('header');	
							$this->load->view('tipo_categoria/editar_tipo_categoria', array('tipo_categoria' => $tipo_categoria, 'categoria' => $nombre_categoria));
							$this->load->view('footer');
						}
						else
							{
								$this->session->set_flashdata('mensaje', 'Este tipo de categoría no se puede editar.');
								$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
								redirect('tipo_categoria/administrar/'.$categoria_id);
							}
						}
				}
				else 
				{
					$this->session->set_flashdata('mensaje', 'El tipo de categoría que intenta editar no existe. <br>
												   Inténtelo nuevamente o póngase en contacto con administrador del sitio. <br>
												   Si usted es el administrador verifique que la categoría exista en la Base de Datos.');
					$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
					
					redirect('tipo_categoria/administrar/'.$categoria_id);
				}
			}
			else
			{
				redirect('tipo_categoria/administrar/'.$categoria_id);
			} 
		}
		else
		{
			$this->session->set_flashdata('mensaje', 'Debe estar logeado como rematador para poder acceder a este sección');
			$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			redirect(base_url());
		}
		
	//	 endif;
	}
	
	public function eliminar()
	{
		if ($this->session->userdata('tipo') == "rematador")
		{
		//	$this->output->enable_profiler(true);
			if ( $this->input->is_ajax_request())
			{
				$tipo_id = $this->uri->segment(3);
				$tipo_id_estandar = $this->uri->segment(4);
				if ( is_numeric($tipo_id))
				{
					if ( $this->tipo_categoria_model->existe($tipo_id))
					{
				//		if ($this->tipo_categoria_model->validar_tipo_estandar($categoria_id, $nombre_categoria) != $tipo_id)
				//		{
							if ( $this->tipo_categoria_model->eliminar($tipo_id, $tipo_id_estandar))
							{
								$this->session->set_flashdata('mensaje', 'El tipo de categoría se eliminó exitosamente');
								$this->session->set_flashdata('mensaje_clase', 'alert alert-success');					
								echo json_encode(array('success' => true));
							}
							else echo json_encode(array('success' => false));
				//		}
				/* 		else
						{
							$this->session->set_flashdata('mensaje', 'Este tipo de categoría no se puede eliminar.');
							$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
							redirect('categoria/administrar');																
						} */
					}
					else 
					{
						$this->session->set_flashdata('mensaje', 'El tipo de categoría que intenta eliminar no existe. <br>
													   Inténtelo nuevamente o póngase en contacto con administrador del sitio. <br>
													   Si usted es el administrador, verifique que el tipo categoría exista en la Base de Datos para poder ser eliminada correctamente.');
						$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
					
						redirect('categoria/administrar');					
					}
				}
				else
				{
					$this->session->set_flashdata('mensaje', 'Ocurrió un error al eliminar este tipo de categoría');
					$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
					echo json_encode(array('success' => false));
				}
			}
		}
		else
		{
			$this->session->set_flashdata('mensaje', 'Debe estar logeado como rematador para poder acceder a este sección');
			$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			redirect(base_url());
		}
	}
	
		private function _view($view = 'tipo_categoria/administrar', $data = NULL, $layout = TRUE)
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