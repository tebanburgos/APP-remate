<?php if ( ! defined('BASEPATH')) exit('Acceso Directo no Permitido');
class Ayuda extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function index()
	{
		$this->load->view('header');	
		$this->load->view('ayuda/escritorio_ayuda');	
		$this->load->view('footer');
	}
	
	public function solucion()
	{
		$duda = $this->uri->segment(3);
		
		$this->load->view('header');
		
		switch ($duda)
		{
			case 'acceder':
				$this->load->view('ayuda/acceder');
			break;
			
			case 'olvide_mi_contrasena':
				$this->load->view('ayuda/olvide_mi_contrasena');
			break;
			
			case 'cambio_contrasena':
				$this->load->view('ayuda/cambio_contrasena');
			break;
			
			case 'primera_vez':
				$this->load->view('ayuda/primera_vez');
			break;
			
			case 'como_ofertar':
				$this->load->view('ayuda/como_ofertar');
			break;
			
			case 'info_bienes':
				$this->load->view('ayuda/info_bienes');
			break;
			
			case 'verificar_bienes':
				$this->load->view('ayuda/verificar_bienes');
			break;
			
			case 'como_rematar':
				$this->load->view('ayuda/como_rematar');
			break;
			
			case 'como_participar':
				$this->load->view('ayuda/como_participar');
			break;
			
			case 'como_vender':
				$this->load->view('ayuda/como_vender');
			break;
			
			case 'cuanto_dura':
				$this->load->view('ayuda/cuanto_dura');
			break;
			
			case 'que_es_un_lote':
				$this->load->view('ayuda/que_es_un_lote');
			break;
			
			case 'favoritos':
				$this->load->view('ayuda/favoritos');
			break;
			
			case 'como_puedo_ofertar':
				$this->load->view('ayuda/como_puedo_ofertar');
			break;
			
			case 'politica_seguridad':
				$this->load->view('ayuda/politica_seguridad');
			break;
		
		}
		$this->load->view('footer');
	}
}