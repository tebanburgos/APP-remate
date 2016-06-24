<?php if ( ! defined('BASEPATH')) exit('Acceso Directo no Permitido');

class Inicio extends CI_Controller {

	public function index()
	{
		$this->_view();
		$this->inicio_model->actualizar_remates();
		$this->inicio_model->actualizar_lotes();
	}
	
	public function actualizar_app()
	{
		$this->inicio_model->actualizar_remates();
		$this->inicio_model->actualizar_lotes();
	}
	
	private function _view($view = 'inicio', $data = NULL, $layout = TRUE)
	{
		$data['mensaje'] = $this->session->flashdata('mensaje');
		$data['mensaje_clase'] = $this->session->flashdata('mensaje_clase');
		if ( $layout)
		{
			$this->load->view('header');
			$this->load->view('inicio/home', $data);
			$this->load->view('footer');
		}
		else
		{
			$this->load->view($view, $data);
		}		
	}
}