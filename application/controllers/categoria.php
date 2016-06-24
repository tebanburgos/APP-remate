<?php if ( ! defined('BASEPATH')) exit('Acceso Directo no Permitido');
class Categoria extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form'));
		$this->load->model(array('categoria_model'));
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
	//	$this->output->enable_profiler(TRUE);
		if ($this->session->userdata('tipo') == "rematador")
		{
			$this->load->view('header');	
			$this->load->view('categoria/administrar_categorias');	
			$this->load->view('footer');
		}
		else
		{
			$this->session->set_flashdata('mensaje', 'Debe estar logeado como rematador para poder acceder a este sección');
			$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
			redirect(base_url());
		}
		
	//	endif;
	}
	
	
	public function ver()
	{	
	//	$this->output->enable_profiler(TRUE);
		$numero_categoria = $this->uri->segment(3);
		$data['nombre_categoria'] = $this->categoria_model->obtener_nombre_de_la_categoria($numero_categoria);
		
		if ($_POST)
		{
			if(isset($_POST['tipo_remate']))
			{
				// captura de los check list en un arreglo y separarlos con una coma
				$filtro_tipo = "";
				for($i = 0; $i< count($_POST['tipo_remate']); $i++){
				$filtro_tipo = $filtro_tipo.$_POST['tipo_remate'][$i] . ",";
					}
				// se borra la última coma
				$filtro_tipo = rtrim($filtro_tipo, ',');
				
				$data['fitro_tipo'] = $filtro_tipo;
			}
			else
			{
				$data['fitro_tipo'] = null;
			}
			if(isset($_POST['marca_remate']))
			{
				// captura de los check list en un arreglo y separarlos con una coma
				$filtro_marca = "";
				for($i = 0; $i< count($_POST['marca_remate']); $i++){
				$filtro_marca = $filtro_marca.$_POST['marca_remate'][$i] . ",";
					}
				// se borra la última coma
				$filtro_marca = rtrim($filtro_marca, ',');
				
				$data['fitro_marca'] = $filtro_marca;
			}
			else
			{
				$data['fitro_marca'] = null;
			}
		}
		else
		{
			$data['fitro_tipo'] = null;
			$data['fitro_marca'] = null;
		}

		$this->load->view('header');
		$this->load->view('categoria/ver', $data);
		$this->load->view('footer');
	}

	public function ingresar()
	{
		if ($this->session->userdata('tipo') == "rematador")
		{
			if ($_POST['categoria_nombre'] != "")
			{
				$nombre_categoria = $_POST['categoria_nombre'];
				if (! $this->categoria_model->validar_existencia_de_la_categoria($nombre_categoria))
				{
					if (! $this->categoria_model->ingresar($nombre_categoria))
					{
						$this->session->set_flashdata('mensaje', 'Se agregó exitosamente la categoria <strong>'.$nombre_categoria.'</strong>');
						$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
					}
					else
					{
						$this->session->set_flashdata('mensaje', 'Ocurrió un error al ingresar la categoría.');
						$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');				
					}
				}
				else
				{
					$this->session->set_flashdata('mensaje', 'La categoría ya existe.<br> Verifique la existencia de esta misma o ingrese una nueva con otro nombre. ');
					$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
				}
			}
			redirect('categoria/administrar');
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
							if ( $this->form_validation->run('editar_categoria') == FALSE)
							{
								$this->_view('categoria/editar_categoria', array('categoria' => $categoria));
							}
							else
							{
								$nombre_categoria = $_POST['categoria_nombre'];
								$antiguo_nombre = $_POST['categoria_nombre_antiguo'];
								if (! $this->categoria_model->validar_existencia_de_la_categoria($nombre_categoria))
								{
									if ( $this->categoria_model->editar())
									{
										$this->categoria_model->editar_tipo_estandar($categoria_id, $antiguo_nombre, $nombre_categoria);
										$this->categoria_model->editar_marca_estandar($categoria_id, $antiguo_nombre, $nombre_categoria);
										$this->session->set_flashdata('mensaje', 'Se editó exitosamente la categoría <strong>'.$nombre_categoria.'</strong>.');
										$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
									}
									else
									{
										$this->session->set_flashdata('mensaje', 'Ocurrió un error al editar la categoría.');
										$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');				
									}				
								}
								else
								{
									$this->session->set_flashdata('mensaje', 'La categoría ya existe.<br> Verifique la existencia de esta misma o edítela con otro nombre. ');
									$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
								}
								redirect('categoria/administrar');
							}
						}
						else
							{
								$this->session->set_flashdata('mensaje', 'Esta categoría no se puede editar.');
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
					$this->session->set_flashdata('mensaje', 'La categoría que intenta editar no existe. <br>
												   Inténtelo nuevamente o póngase en contacto con administrador del sitio. <br>
												   Si usted es el administrador verifique que la categoría exista en la Base de Datos.');
					$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
					
					redirect('categoria/administrar');					
				}
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
			if ( $this->input->is_ajax_request())
			{
				$categoria_id = $this->uri->segment(3);
				if ( is_numeric($categoria_id))
				{
					if ( $this->categoria_model->existe($categoria_id))
					{
						if ($categoria_id != 1)
						{
							if ( $this->categoria_model->eliminar($categoria_id))
							{
								$this->session->set_flashdata('mensaje', 'La categoría se eliminó exitosamente');
								$this->session->set_flashdata('mensaje_clase', 'alert alert-success');					
								echo json_encode(array('success' => true));
							}
							else echo json_encode(array('success' => false));
						}
						else
						{
							$this->session->set_flashdata('mensaje', 'Esta categoría no se puede eliminar.');
							$this->session->set_flashdata('mensaje_clase', 'alert alert-danger');
							redirect('categoria/administrar');																
						}
					}
					else 
					{
						$this->session->set_flashdata('mensaje', 'La categoría que intenta eliminar no existe. <br>
													   Inténtelo nuevamente o póngase en contacto con administrador del sitio. <br>
													   Si usted es el administrador, verifique que la categoría exista en la Base de Datos para poder ser eliminada correctamente.');
						$this->session->set_flashdata('mensaje_clase', 'alert alert-success');
					
						redirect('categoria/administrar');					
					}
				}
				else
				{
					$this->session->set_flashdata('mensaje', 'Ocurrió un error al eliminar la categoría');
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
	//	 endif;
	}
	
		private function _view($view = 'categoria/administrar', $data = NULL, $layout = TRUE)
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