<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');
class Marca_categoria_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function obtener_marcas_de_categoria($categoria_id, $categoria_nombre)
	{
		$this->db->select('*');
		$this->db->from('marcas');
		$where = "marca_nombre NOT LIKE '(".$categoria_nombre." sin marca)' AND categoria_id = ".$categoria_id." and marca_estado = 'activo'";
		$this->db->where($where);
		$this->db->order_by('marca_nombre', 'ASC');
		$marcas =  $this->db->get();
	
		if ( $marcas->num_rows() > 0)
		{
			return $marcas;
		}
	
		else return false;
	}
	
	public function obtener_sin_marca_de_la_categoria($categoria_id, $categoria_nombre)
	{
		$this->db->select('*');
		$this->db->from('marcas');
		$where = "marca_nombre LIKE '(".$categoria_nombre." sin marca)' AND categoria_id = ".$categoria_id."";
		$this->db->where($where);
		$marcas =  $this->db->get();
	
		if ( $marcas->num_rows() > 0)
		{
			return $marcas;
		}
	
		else return false;
	}
		
	public function obtener_marca_categorias()
	{
		$this->db->select('*');
		$this->db->from('marcas');
		$where = '( marca_id != 1 and marca_id != 2 and marca_id !=3 and marca_id != 4 and marca_id = 5 )';
		$this->db->where($where);
		$this->db->order_by('marca_nombre', 'ASC');
		$marcas =  $this->db->get();
	
		if ( $marcas->num_rows() > 0)
		{
			return $marcas;
		}
	
		else return false;
	}
	
	public function obtener_categorias_permanentes()
	{
		$this->db->select('*');
		$this->db->from('marcas');
		$where = '( marca_id = 1 and marca_id = 2 and marca_id = 3 and marca_id = marca_id = 4 and marca_id = 5 )';
		$this->db->where($where);
		$marcas =  $this->db->get();
	
		if ( $marcas->num_rows() > 0)
		{
			return $marcas;
		}
	
		else return false;
	}
	
	public function obtener_un_marca_categoria($marca_id)
	{
		return $this->db->get_where('marcas', array('marca_id' => $marca_id))->row();
	}
	
	function ingresar($marca_nombre, $categoria_id)
	{
		return $this->db->insert('marcas', array('marca_nombre'=>$marca_nombre, 'marca_estado'=>'activo', 'categoria_id' => $categoria_id));
	}
	
	function editar()
	{
		$campos = array(
			'marca_nombre',
		);
		$data = array();
		foreach ( $campos as $c)
		{
			$data[$c] = $this->input->post($c);
		}
		return $this->db->where(array('marca_id' => $this->uri->segment(3)))->update('marcas', $data);		
	}
	
	function eliminar($marca_id = NULL, $marca_estandar)
	{
	//	$this->db->delete('marcas', array('marca_id' => $marca_id));
	//	return $this->db->affected_rows();
		$marcas = $this->desactivar_marca($marca_id);
		$lotes = $this->desactivar_lotes($marca_id, $marca_estandar);
		if($lotes == true) return true;
		else return false;
	}
	
	function desactivar_marca($marca_id)
	{
		$data = array(
               'marca_estado' => 'desactivado'
            );
		$this->db->where('marca_id', $marca_id);
		return $this->db->update('marcas', $data); 
	}
	
	function desactivar_lotes($marca_id, $marca_estandar)
	{
		$data = array(
               'marca_id' => $marca_estandar
            );
		$this->db->where('marca_id', $marca_id);
		return $this->db->update('lotes', $data); 
	}
	
	
	function validar_existencia_del_marca($marca_nombre, $categoria_id)
	{
		$this->db->select('*');
		$this->db->from('marcas');
		$this->db->like('marca_nombre', $marca_nombre, 'none'); 
		$this->db->where('marca_estado', 'activo');
		$this->db->where('categoria_id', $categoria_id);
		
		$marcas =  $this->db->get();
	
		if ( $marcas->num_rows() > 0)
		{
		//	return $marcas;
			return true;
		}
	
		else return false;	
	}
	
	public function obtener_datos_categoria_segun_marca($marca_id)
	{
		$this->db->select('*');
		$this->db->from('categorias');
		$this->db->join('marcas', 'categorias.categoria_id = marcas.categoria_id');
		$this->db->where('marcas.marca_id', $marca_id);
		$categoria =  $this->db->get();
		if ( $categoria->num_rows() > 0)
		{
			return $categoria;
		}
		else return false;
	}

	function existe($marca_id = NULL)
	{
		if ( ! is_null($marca_id))
		{
			$marca = $this->db->get_where('marcas', array('marca_id' => $marca_id));
			if ( $marca->num_rows() > 0) return true;
			else return false;
		}
		return false;		
	}
	
	function activo($marca_id)
	{
		$this->db->select('*');
		$this->db->from('marcas');
		$this->db->where('marca_id', $marca_id);
		$this->db->where('marca_estado', 'activo');
		
		$marcas =  $this->db->get();
	
		if ( $marcas->num_rows() > 0)
		{
			return true;
		}
		else return false;	
	}
	
	public function validar_marca_estandar($categoria_id, $categoria_nombre)
	{
		$this->db->select('*');
		$this->db->from('marcas');
		$where = '( marca_nombre like "(%'.$categoria_nombre.' sin marca%)" and categoria_id = '.$categoria_id.' )';
		$this->db->where($where);
		$marcas =  $this->db->get();
	
		if ( $marcas->num_rows() > 0)
		{
			return $marcas->row()->marca_id;
		}
	
		else return false;
	}
	
		function validar_existencia_de_nombre_del_marca_categoria($marca_nombre, $categoria_id)
	{
		$this->db->select('*');
		$this->db->from('marcas');
		$this->db->like('marca_nombre', $marca_nombre, 'none'); 
		$this->db->where('marca_estado', 'activo');
		$this->db->where('categoria_id', $categoria_id);
		
		$marcas =  $this->db->get();
	
		if ( $marcas->num_rows() > 0)
		{
		//	return $marcas;
			return true;
		}
	
		else return false;	
	}
	
}