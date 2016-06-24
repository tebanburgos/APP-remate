<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');
class Rematador_model extends CI_Model
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
			'rematador_correo' => $datos_usuario['rematador_correo'],
			'rematador_password' => $datos_usuario['rematador_password']
			);
		return $this->db->get_where('rematadores', array('rematador_correo' => $datos_usuario['rematador_correo'], 'rematador_password' => $datos_usuario['rematador_password']))->row();
	}
	
	function consultar_correo_existente($correo_usuario)
	{
		$query = $this->db->get_where('rematadores', array('rematador_correo' => $correo_usuario));
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
			'rematador_correo' => $datos_registro['rematador_correo'],
			'rematador_nombre_empresa' => $datos_registro['rematador_nombre_empresa'],
			'rematador_razon_social' => $datos_registro['rematador_razon_social'],
			'rematador_rut_empresa' => $datos_registro['rematador_rut_empresa'],
			'rematador_password' => $datos_registro['rematador_password'],
			'rematador_nombre_responsable' => $datos_registro['rematador_nombre_responsable'],
			'rematador_apellido_responsable' => $datos_registro['rematador_apellido_responsable'],
			'rematador_rut_responsable' => $datos_registro['rematador_rut_responsable'],
			'rematador_foto' => $datos_registro['rematador_foto'],
			'rematador_telefono' => $datos_registro['rematador_telefono'],
			'rematador_movil' => $datos_registro['rematador_movil'],
			'rematador_direccion' => $datos_registro['rematador_direccion'],
			'rematador_ciudad' => $datos_registro['rematador_ciudad'],
			'rematador_region' => $datos_registro['rematador_region'],
			'rematador_pais' => $datos_registro['rematador_pais'],
			'rematador_descripcion_activos' => $datos_registro['rematador_descripcion_activos'],
			'rematador_estado' => $datos_registro['rematador_estado']

		);
		return $this->db->insert('rematadores', $datos_registro);
	}
	
	function editar($datos_registro)
	{
		$data = array(
			'rematador_correo' => $datos_registro['rematador_correo'],
			'rematador_nombre_empresa' => $datos_registro['rematador_nombre_empresa'],
			'rematador_razon_social' => $datos_registro['rematador_razon_social'],
			'rematador_rut_empresa' => $datos_registro['rematador_rut_empresa'],
			'rematador_password' => crypt($datos_registro['rematador_password']),
			'rematador_nombre_responsable' => $datos_registro['rematador_nombre_responsable'],
			'rematador_apellido_responsable' => $datos_registro['rematador_apellido_responsable'],
			'rematador_rut_responsable' => $datos_registro['rematador_rut_responsable'],
			'rematador_foto' => $datos_registro['rematador_foto'],
			'rematador_telefono' => $datos_registro['rematador_telefono'],
			'rematador_movil' => $datos_registro['rematador_movil'],
			'rematador_direccion' => $datos_registro['rematador_direccion'],
			'rematador_ciudad' => $datos_registro['rematador_ciudad'],
			'rematador_region' => $datos_registro['rematador_region'],
			'rematador_pais' => $datos_registro['rematador_pais'],
			'rematador_descripcion_activos' => $datos_registro['rematador_descripcion_activos'],
			'rematador_estado' => $datos_registro['rematador_estado']
			);
		$rematador_password = $datos_registro['rematador_password'];
		if ( ! empty($datos_registro['rematador_password']))
		{
			$data['rematador_password'] = crypt($rematador_password);
		}
		$usuario_id = $this->uri->segment(3);
		$this->db->where(array('usuario_id' => $usuario_id))->update('usuarios', $datos_registro);
		return $this->db->affected_rows();
	}
	
	
	function eliminar($rematador_id = NULL)
	{
		$this->db->delete('rematadores', "rematador_id = $rematador_id");
		return $this->db->affected_rows();
	}
	
	public function obtener_listado_rematadores()
	{
		$this->db->select('*');
		$this->db->from('rematadores');
		$this->db->order_by('rematador_nombre_empresa', 'ASC');
		$rematadores =  $this->db->get();

	/*	if ( $rematadores->num_rows() > 0)
		{
			return $rematadores->row()->rematador_nombre_empresa;
		}
	*/
		if ( $rematadores->num_rows() > 0)
		{
			return $rematadores;
		}
		
		else return false;
	
	}
	
	public function obtener($remate_id = NULL)
	{
		if ( ! is_null($remate_id))
		{
			return $this->db->get_where('remates', array('remates_id' => $remate_id))->row();
		}
		else
		{
			return $this->db->order_by('remate_id', 'desc')->get('remates');
		}
	}
	
	
	public function obtener_id_del_rematador_por_token($token)
	{
		$this->db->select('rematador_id');
		$this->db->from('rematadores');
		$this->db->where('rematador_token_recuperar_clave', $token); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->rematador_id;
		}
		return false;
	}
	
	public function actualizar_nueva_password($rematador_id, $clave_encriptada)
	{
		$data = array(
               'rematador_password' => $clave_encriptada
            );
		$this->db->where('rematador_id', $rematador_id);
		return $this->db->update('rematadores', $data); 
		
	}
	
	public function consultar_datos_rematador_por_token_activacion($token, $criterio)
	{
		$this->db->select('*');
		$this->db->from('rematadores');
		$this->db->where('rematador_token_activacion', $token); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			switch ($criterio)
			{
				case 'nombre':
				return $query->row()->rematador_nombre_responsable;
				break;
				case 'apellido':
				return $query->row()->rematador_apellido_responsable;
				break;
			}
		}
		return false;
	}
	
	public function obtener_id_del_rematador_por_token_activacion($token)
	{
		$this->db->select('rematador_id');
		$this->db->from('rematadores');
		$this->db->where('rematador_token_activacion', $token); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->rematador_id;
		}
		return false;
	}
	
	public function actualizar_activacion($rematador_id, $estado)
	{
		$data = array(
               'rematador_estado' => $estado
            );
		$this->db->where('rematador_id', $rematador_id);
		return $this->db->update('rematadores', $data); 
	}
	
	public function consultar_remates_del_rematador($rematador_id)
	{
		$this->db->select('*');
		$this->db->from('remates');
		$this->db->where('rematador_id', $rematador_id);
		$this->db->order_by('remate_fecha_creacion', 'DESC ');
		$remates =  $this->db->get();
	
		if ( $remates->num_rows() > 0)
		{
			return $remates;
		}
	
		else return false;
	}
	
	public function saber_categoria_del_remate($categoria_id)
	{
		$this->db->select('categorias.categoria_id, categorias.categoria_nombre');
		$this->db->from('categorias');
		$this->db->join('remates', 'remates.categoria_id = categorias.categoria_id', 'inner');
		$this->db->where('remates.categoria_id', $categoria_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->categoria_nombre;
		}
		return false;
	}	
	

}