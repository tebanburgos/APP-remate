<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');
class Inicio_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
		
	public function actualizar_remates()
	{
	
		$fecha_actual = date("Y-m-d");
		
		$data = array(
               'remate_estado' => "finalizado"
            );
			
		$where = 'remate_estado = "activo" AND remate_fecha_termino < "'.$fecha_actual.'"';
		$this->db->where($where);
		
		$this->db->update('remates', $data); 
	}
	
		public function actualizar_lotes()
	{
	
		$fecha_actual = date("Y-m-d");
		
		$data = array(
               'lote_estado' => "finalizado"
            );
			
		$where = 'lote_estado = "activo" AND lote_fecha_cierre < "'.$fecha_actual.'"';
		$this->db->where($where);
		
		$this->db->update('lotes', $data); 
	}
	
}