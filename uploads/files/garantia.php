<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');
class Garantia extends CI_Controller
{

	private $es_correcto_subido_adjunto;
	private $nombre_archivo_adjunto;
	
	public function __construct()
	{
		parent::__construct();
	//	if ( ! $this->auth->check()) redirect('/index.php');
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
	
	public function subir_adjunto_garantia()
	{
		$config['upload_path'] = "./uploads/garantias/";
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
			}					
	}
	
	public function pagar()
	{
	//	$this->output->enable_profiler(TRUE);
		if($_POST)
		{
			$this->subir_adjunto_garantia("./uploads/garantias/");
		}
		$remate_id = $this->uri->segment(3);
		$ofertante_id = $this->session->userdata('id');
		
		$este_remate = $this->remate_model->obtener_remate_por_id($remate_id);
		
		
		$this->load->view('header');
		$this->load->view('left');	
		$this->load->view('garantia/pagar', array('remate_id' => $remate_id, 'ofertante_id' => $ofertante_id, 'remate' => $este_remate));
		$this->load->view('footer');
		
	}
	
}	