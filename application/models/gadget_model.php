<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');
class Gadget_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function obtener_lotes_totales()
	{
		$this->db->where('lote_estado', 'activo'); 
		$this->db->from('lotes');
		return $this->db->count_all_results();
	}
	
 	public function obtener_nombre_de_las_categorias()
	{
		$this->db->select('categoria_nombre');
	//	$this->db->from('categorias');
	//	$where = '( categoria_nombre != 1)';
		$this->db->where($where);
		$this->db->order_by('categoria_id', 'ASC');
		$categorias =  $this->db->get();
		
		if ( $categorias->num_rows() > 0)
		{
			return $categorias;
		}
		else return false;
	}	

	public function obtener_categorias()
	{
		$this->db->select('*');
		$this->db->from('categorias');
		$this->db->where('categoria_estado', 'activo'); 
	//	$where = '( categoria_id != 1 )';
	//	$this->db->where($where);
		$this->db->order_by('categoria_nombre', 'ASC');
		$categorias =  $this->db->get();
	
		if ( $categorias->num_rows() > 0)
		{
			return $categorias;
		}
	
		else return false;
	}
 
	public function obtener_remates($estado, $fecha_actual)
	{
	//	$this->output->enable_profiler(TRUE);
		$this->db->select('*');
		$this->db->from('remates');
		if ($estado == "activo")
		{
			$where = '(remate_estado = "'.$estado.'" AND remate_fecha_termino >= "'.$fecha_actual.'")';
			$this->db->where($where);
			$this->db->order_by('remate_fecha_termino', 'ASC');
			$this->db->limit(20);
		}
		elseif ($estado == "finalizado")
		{
			$where = '(remate_estado = "'.$estado.'" AND remate_fecha_termino <= "'.$fecha_actual.'")';
			$this->db->where($where);
			$this->db->order_by('remate_fecha_termino', 'ASC');
			$this->db->limit(8);
		}
		$remates =  $this->db->get();
	
		if ( $remates->num_rows() > 0)
		{
			return $remates;
		}
	
		else return false;
	}
	
		public function obtener_remates_totales_por_categoria($categoria)
	{
		$this->db->from('remates');
		$this->db->where('categoria_id', $categoria); 
		$this->db->where('remate_estado', 'activo'); 
		$numero_categoria =  $this->db->count_all_results();

	    if(is_numeric($numero_categoria))
		{
			return $numero_categoria;
		}
		else return false;
	}
	
	
	public function obtener_rematadores_por_remate($remate, $rematador)
	{
		$this->db->select('*');
		$this->db->from('rematadores');
		$this->db->join('remates', 'rematadores.rematador_id = remates.rematador_id');
	//	$this->db->where('rematadores.rematador_id', $remate); 
		$where = '(rematadores.rematador_id='.$rematador.' and remates.remate_id='.$remate.')';
		$this->db->where($where);
		$this->db->order_by('remate_fecha_termino', 'ASC');
		$remates =  $this->db->get();
		if ( $remates->num_rows() > 0)
		{
			return $remates;
		}
		else return false;
	}
	
	public function obtener_lotes_totales_del_remate($remate_id)
	{
		$this->db->from('lotes');
		$this->db->where('lote_estado', 'activo');
		$this->db->where('remate_id', $remate_id);
		$numero_de_lotes_por_remate =  $this->db->count_all_results();

	    if(is_numeric($numero_de_lotes_por_remate))
		{
			return $numero_de_lotes_por_remate;
		}
		else return false;
	}
	
	public function obtener_la_primera_categoria()
	{
		$this->db->select('*');
		$this->db->from('categorias');
		$where = '( categoria_id = 1 )';
		$this->db->where($where);
		$categorias =  $this->db->get();
	
		if ( $categorias->num_rows() > 0)
		{
			return $categorias;
		}
	
		else return false;
	}
	
	public function obtener_una_categoria($categoria_id)
	{
		return $this->db->get_where('categorias', array('categoria_id' => $categoria_id))->row();
	}
	
	function ingresar()
	{
		$campos = array(
			'categoria_nombre',
		);
		$data = array();
		foreach ( $campos as $c)
		{
			$data[$c] = $this->input->post($c);
		}
		return $this->db->insert('categorias', $data);
	}
	
	function editar()
	{
		$campos = array(
			'categoria_nombre',
		);
		$data = array();
		foreach ( $campos as $c)
		{
			$data[$c] = $this->input->post($c);
		}
		return $this->db->where(array('categoria_id' => $this->uri->segment(3)))->update('categorias', $data);		
	}
	
	function eliminar($categoria_id = NULL)
	{
		$this->db->delete('categorias', array('categoria_id' => $categoria_id));
		return $this->db->affected_rows();
	}
	
	
	function validar_existencia_de_la_categoria($categoria_nombre)
	{
		$this->db->select('*');
		$this->db->from('categorias');
		$this->db->like('categoria_nombre', $categoria_nombre, 'none'); 
		
		$categorias =  $this->db->get();
	
		if ( $categorias->num_rows() > 0)
		{
		//	return $categorias;
			return true;
		}
	
		else return false;	
	}

	function existe($categoria_id = NULL)
	{
		if ( ! is_null($categoria_id))
		{
			$categoria = $this->db->get_where('categorias', array('categoria_id' => $categoria_id));
			if ( $categoria->num_rows() > 0) return true;
			else return false;
		}
		return false;		
	}
	
	public function truncar_texto($cadena)
	{
		if (strlen($cadena) > 10)
		{
			$cadena = substr($cadena, 0, 20) . "...";
		}
		return $cadena;
	}
}