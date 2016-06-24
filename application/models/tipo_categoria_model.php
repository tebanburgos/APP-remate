<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');
class Tipo_categoria_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function obtener_tipos_de_categoria($categoria_id, $categoria_nombre)
	{
		$this->db->select('*');
		$this->db->from('tipos');
		$where = "tipo_nombre NOT LIKE '(".$categoria_nombre." sin tipo)' AND categoria_id = ".$categoria_id." and tipo_estado = 'activo'";
		$this->db->where($where);
		$this->db->order_by('tipo_nombre', 'ASC');
		$tipos =  $this->db->get();
	
		if ( $tipos->num_rows() > 0)
		{
			return $tipos;
		}
	
		else return false;
	}
	
	public function obtener_sin_tipo_de_la_categoria($categoria_id, $categoria_nombre)
	{
		$this->db->select('*');
		$this->db->from('tipos');
		$where = "tipo_nombre LIKE '(".$categoria_nombre." sin tipo)' AND categoria_id = ".$categoria_id."";
		$this->db->where($where);
		$tipos =  $this->db->get();
	
		if ( $tipos->num_rows() > 0)
		{
			return $tipos;
		}
	
		else return false;
	}
		
	public function obtener_tipo_categorias()
	{
		$this->db->select('*');
		$this->db->from('tipos');
		$where = '( tipo_id != 1 and tipo_id != 2 and tipo_id !=3 and tipo_id != 4 and tipo_id = 5 )';
		$this->db->where($where);
		$this->db->order_by('tipo_nombre', 'ASC');
		$tipos =  $this->db->get();
	
		if ( $tipos->num_rows() > 0)
		{
			return $tipos;
		}
	
		else return false;
	}
	
	public function obtener_categorias_permanentes()
	{
		$this->db->select('*');
		$this->db->from('tipos');
		$where = '( tipo_id = 1 and tipo_id = 2 and tipo_id = 3 and tipo_id = tipo_id = 4 and tipo_id = 5 )';
		$this->db->where($where);
		$tipos =  $this->db->get();
	
		if ( $tipos->num_rows() > 0)
		{
			return $tipos;
		}
	
		else return false;
	}
	
	public function obtener_un_tipo_categoria($tipo_id)
	{
		return $this->db->get_where('tipos', array('tipo_id' => $tipo_id))->row();
	}
	
	function ingresar($tipo_nombre, $categoria_id)
	{
		return $this->db->insert('tipos', array('tipo_nombre'=>$tipo_nombre, 'tipo_estado'=>'activo', 'categoria_id' => $categoria_id));
	}
	
	function editar()
	{
		$campos = array(
			'tipo_nombre',
		);
		$data = array();
		foreach ( $campos as $c)
		{
			$data[$c] = $this->input->post($c);
		}
		return $this->db->where(array('tipo_id' => $this->uri->segment(3)))->update('tipos', $data);		
	}
	
	function eliminar($tipo_id = NULL, $tipo_estandar)
	{
	//	$this->db->delete('tipos', array('tipo_id' => $tipo_id));
	//	return $this->db->affected_rows();
		$tipos = $this->desactivar_tipo($tipo_id);
	//	$tipo_estandar = $this->obtener_id_sin_tipo($tipo_id);
		$lotes = $this->desactivar_lotes($tipo_id, $tipo_estandar);
		if($tipos == true and $lotes == true) return true;
		else return false;
	}
	
	public function obtener_id_sin_tipo($tipo_id)
	{
		$id_categoria = $this->obtener_id_categoria_segun_id_tipo($tipo_id);
		$nombre_categoria = $this->obtener_nombre_categoria($id_categoria);
		$id_tipo_estandar = $this->obtener_id_tipo_estandar($id_categoria, $nombre_categoria);
		return $id_tipo_estandar;
	}
	
	public function obtener_id_categoria_segun_id_tipo($tipo_id)
	{
		$this->db->select('categoria_id');
		$this->db->from('tipos');
		$this->db->where('tipo_id', $tipo_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->categoria_id;
		}
		return false;
	}
	
	public function obtener_nombre_categoria($categoria_id)
	{
		$this->db->select('categoria_nombre');
		$this->db->from('categorias');
		$this->db->where('categoria_id', $tipo_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->categoria_nombre;
		}
		return false;
	}
	
	public function obtener_id_tipo_estandar($categoria_id, $categoria_nombre)
	{
		$this->db->select('tipo_id');
		$this->db->from('tipos');
		$where = '( tipo_nombre =  LIKE "%('.$categoria_nombre.' sin tipo)%" AND categoria_id = '.$categoria_id.' )';
		$this->db->where($where);
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->tipo_id;
		}
		return false;
	}
	
	function desactivar_tipo($tipo_id)
	{
		$data = array(
               'tipo_estado' => 'desactivado'
            );
		$this->db->where('tipo_id', $tipo_id);
		return $this->db->update('tipos', $data); 
	}
	
	function desactivar_lotes($tipo_id, $tipo_estandar)
	{
		$data = array(
               'tipo_id' => $tipo_estandar
            );
		$this->db->where('tipo_id', $tipo_id);
		return $this->db->update('lotes', $data); 
	}
	
	
	
	function validar_existencia_del_tipo($tipo_nombre, $categoria_id)
	{
		$this->db->select('*');
		$this->db->from('tipos');
		$this->db->like('tipo_nombre', $tipo_nombre, 'none'); 
		$this->db->where('tipo_estado', 'activo');
		$this->db->where('categoria_id', $categoria_id);
		
		$tipos =  $this->db->get();
	
		if ( $tipos->num_rows() > 0)
		{
		//	return $tipos;
			return true;
		}
	
		else return false;	
	}
	
	public function obtener_datos_categoria_segun_tipo($tipo_id)
	{
		$this->db->select('*');
		$this->db->from('categorias');
		$this->db->join('tipos', 'categorias.categoria_id = tipos.categoria_id');
		$this->db->where('tipos.tipo_id', $tipo_id);
		$categoria =  $this->db->get();
		if ( $categoria->num_rows() > 0)
		{
			return $categoria;
		}
		else return false;
	}

	function existe($tipo_id = NULL)
	{
		if ( ! is_null($tipo_id))
		{
			$tipo = $this->db->get_where('tipos', array('tipo_id' => $tipo_id));
			if ( $tipo->num_rows() > 0) return true;
			else return false;
		}
		return false;		
	}
	
	function activo($tipo_id)
	{
		$this->db->select('*');
		$this->db->from('tipos');
		$this->db->where('tipo_id', $tipo_id);
		$this->db->where('tipo_estado', 'activo');
		
		$tipos =  $this->db->get();
	
		if ( $tipos->num_rows() > 0)
		{
			return true;
		}
		else return false;	
	}
	
	public function validar_tipo_estandar($categoria_id, $categoria_nombre)
	{
		$this->db->select('*');
		$this->db->from('tipos');
		$where = '( tipo_nombre like "(%'.$categoria_nombre.' sin tipo%)" and categoria_id = '.$categoria_id.' )';
		$this->db->where($where);
		$tipos =  $this->db->get();
	
		if ( $tipos->num_rows() > 0)
		{
			return $tipos->row()->tipo_id;
		}
	
		else return false;
	}
	
		function validar_existencia_de_nombre_del_tipo_categoria($tipo_nombre, $categoria_id)
	{
		$this->db->select('*');
		$this->db->from('tipos');
		$this->db->like('tipo_nombre', $tipo_nombre, 'none'); 
		$this->db->where('tipo_estado', 'activo');
		$this->db->where('categoria_id', $categoria_id);
		
		$tipos =  $this->db->get();
	
		if ( $tipos->num_rows() > 0)
		{
		//	return $tipos;
			return true;
		}
	
		else return false;	
	}
	
}