<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');
class Garantia_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	
		
	public function consultar_garantia_pagada($remate_id,$ofertante_id)
	{
		$this->db->select('*');
		$this->db->from('garantias');
		$this->db->where(array('remate_id' => $remate_id, 'ofertante_id' => $ofertante_id, 'garantia_estado' => "Pagada")); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return "Pagada";
		}
		return false;
	}
	
	public function consultar_garantia_revisando($remate_id,$ofertante_id)
	{
		$this->db->select('*');
		$this->db->from('garantias');
		$this->db->where(array('remate_id' => $remate_id, 'ofertante_id' => $ofertante_id, 'garantia_estado' => "Revisando")); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return "Revisando";
		}
		return false;
	}
	
	public function ingresar_garantia($data)
	{
		return $this->db->insert('garantias', $data);
	}
	
	public function obtener_todas_las_garantias()
	{
		$this->db->select('*');
		$this->db->from('garantias');
		$this->db->join('ofertantes', 'ofertantes.ofertante_id = garantias.ofertante_id');
		$this->db->order_by('garantia_fecha_ingreso', 'desc');
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query;
		}
		return false;
	}	
	
	public function activar_ofertante($garantia_id)
	{
		$data = array('garantia_estado' => 'Pagada');
		$this->db->where('garantia_id', $garantia_id);
		return $this->db->update('garantias', $data);
	}
	
	public function obtener_datos_ofertante($ofertante_id)
	{
		return $this->db->get_where('ofertantes', array('ofertante_id' => $ofertante_id))->row();
	}
	
	public function obtener_datos_remate($remate_id)
	{
		return $this->db->get_where('remates', array('remate_id' => $remate_id))->row();
	}
	
	public function obtener_datos_rematador($remate_id)
	{
		$remate = $this->db->get_where('remates', array('remate_id' => $remate_id))->row();
		$rematador_id = $remate->rematador_id;
		return $this->db->get_where('rematadores', array('rematador_id' => $rematador_id))->row();
	}
	
	public function obtener_datos_garantia($garantia_id)
	{
		return $this->db->get_where('garantias', array('garantia_id' => $garantia_id))->row();
	}
	
}