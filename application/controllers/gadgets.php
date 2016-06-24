<?php if ( ! defined('BASEPATH')) exit('Acceso Directo no Permitido');

class Gadgets extends CI_Controller {

	public function index()
	{
		// nada por defecto
	}
	
	public function subastas_disponibles()
	{
    $this->load->view('gadgets/subastas_disponibles', array(), false)
	}
	
	public function subastas_finalizadas()
	{
  //  $this->load->view('gadgets/subastas_finalizadas', array(), false)
	}
}