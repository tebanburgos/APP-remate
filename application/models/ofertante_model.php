<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');
class Ofertante_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function consultar_regiones()
	{
		$this->db->select('*');
		$this->db->from('regiones');
		$this->db->order_by('region_id', 'ASC');
		
		$query =  $this->db->get();
		if ( $query->num_rows() > 0)
		{
			return $query;
		}
		else return false;
	}
	
	function consultar_password($datos_usuario)
	{
		$data = array(
			'ofertante_correo' => $datos_usuario['ofertante_correo'],
			'ofertante_password' => $datos_usuario['ofertante_password']
			);
		return $this->db->get_where('ofertantes', array('ofertante_correo' => $datos_usuario['ofertante_correo'], 'ofertante_password' => $datos_usuario['ofertante_password']))->row();
	}
	
	function consultar_correo_existente($correo_usuario)
	{
		$query = $this->db->get_where('ofertantes', array('ofertante_correo' => $correo_usuario));
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function consultar_nick_existente($nick_usuario)
	{
		$query = $this->db->get_where('ofertantes', array('ofertante_nickname' => $nick_usuario));
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function registrar($datos_registro)
	{
		$data = array(
			'ofertante_nickname' => $datos_registro['ofertante_nickname'],
			'ofertante_correo' => $datos_registro['ofertante_correo'],
			'ofertante_password' => $datos_registro['ofertante_password'],
			'ofertante_nombre' => $datos_registro['ofertante_nombre'],
			'ofertante_apellido' => $datos_registro['ofertante_apellido'],
			'ofertante_rut' => $datos_registro['ofertante_rut'],
			'ofertante_fono' => $datos_registro['ofertante_fono'],
			'ofertante_movil' => $datos_registro['ofertante_movil'],
			'ofertante_direccion' => $datos_registro['ofertante_direccion'],
			'ofertante_ciudad' => $datos_registro['ofertante_ciudad'],
			'ofertante_region' => $datos_registro['ofertante_region'],
			'ofertante_pais' => $datos_registro['ofertante_pais']

		);
		return $this->db->insert('ofertantes', $datos_registro);
	}
	

	
	
	function eliminar($ofertante_id = NULL)
	{
		$this->db->delete('ofertantes', "ofertante_id = $ofertante_id");
		return $this->db->affected_rows();
	}
	
	public function obtener_id_del_ofertante_por_token($token)
	{
		$this->db->select('ofertante_id');
		$this->db->from('ofertantes');
		$this->db->where('ofertante_token_recuperar_clave', $token); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->ofertante_id;
		}
		return false;
	}
	
	public function actualizar_nueva_password($ofertante_id, $clave_encriptada)
	{
		$data = array(
               'ofertante_password' => $clave_encriptada
            );
		$this->db->where('ofertante_id', $ofertante_id);
		return $this->db->update('ofertantes', $data); 
		
	}
	
	public function consultar_datos_ofertante_por_token_activacion($token, $criterio)
	{
		$this->db->select('*');
		$this->db->from('ofertantes');
		$this->db->where('ofertante_token_activacion', $token); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			switch ($criterio)
			{
				case 'nombre':
				return $query->row()->ofertante_nombre;
				break;
				case 'apellido':
				return $query->row()->ofertante_apellido;
				break;
			}
		}
		return false;
	}
	
	public function obtener_id_del_ofertante_por_token_activacion($token)
	{
		$this->db->select('ofertante_id');
		$this->db->from('ofertantes');
		$this->db->where('ofertante_token_activacion', $token); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->ofertante_id;
		}
		return false;
	}
	
	public function actualizar_activacion($ofertante_id, $estado)
	{
		$data = array(
               'ofertante_estado' => $estado
            );
		$this->db->where('ofertante_id', $ofertante_id);
		return $this->db->update('ofertantes', $data); 
	}
	
	public function consultar_subastas_del_ofertante($ofertante_id)
	{
		$this->db->select('*');
		$this->db->from('subastas');
		$this->db->where('ofertante_id', $ofertante_id); 
		$this->db->order_by('subasta_fecha', 'DESC');
		$ofertante =  $this->db->get();
	
		if ( $ofertante->num_rows() > 0)
		{
			return $ofertante;
		}
	
		else return false;
	}
	
	public function obtener_datos_del_remate_a_traves_del_lote($lote_id, $criterio)
	{
		$this->db->select('*');
		$this->db->from('lotes');
		$this->db->join('remates', 'remates.remate_id = lotes.remate_id', 'inner');
		$this->db->where('lotes.lote_id', $lote_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			switch ($criterio)
			{
				case 'remate_id':
				return $query->row()->remate_id;
				break;
				case 'remate_nombre':
				return $query->row()->remate_nombre;
				break;
			}
		}
		return false;
	}
	
	public function obtener_datos_del_lote($lote_id, $criterio)
	{
		$this->db->select('*');
		$this->db->from('lotes');
		$this->db->where('lote_id', $lote_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			switch ($criterio)
			{
				case 'lote_nombre':
				return $query->row()->lote_nombre;
				break;
				case 'lote_fecha_cierre':
				return $query->row()->lote_fecha_cierre;
				break;
				case 'lote_estado':
				return $query->row()->lote_estado;
				break;
				case 'lote_ganador_id':
				return $query->row()->lote_ganador_id;
				break;
			}
		}
		return false;
	}

	
}