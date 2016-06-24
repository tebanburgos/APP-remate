<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');
class Remate_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	
	public function insert_remate($categoria, $rematador, $remate_nombre, $remate_comuna, $remate_direccion, $remate_nombre_mandante, $remate_imagen, $remate_fecha_creacion, $remate_fecha_inicio, $remate_fecha_termino, $remate_plazo_garantia, $remate_precio_garantia, $remate_descripcion){

		$query = $this->db->insert('remates', array('categoria_id'=>$categoria, 'rematador_id'=>$rematador, 'remate_nombre'=>$remate_nombre, 'remate_comuna'=>$remate_comuna , 'remate_direccion'=>$remate_direccion, 'remate_nombre_mandante'=>$remate_nombre_mandante, 'remate_imagen'=>$remate_imagen, 'remate_fecha_creacion'=>$remate_fecha_creacion, 'remate_fecha_inicio'=>$remate_fecha_inicio, 'remate_fecha_termino'=>$remate_fecha_termino, 'remate_estado'=>'activo', 'remate_contador_visitas'=> 0, 'remate_contador_ofertas'=> 0, 'remate_plazo_garantia'=>$remate_plazo_garantia, 'remate_descripcion'=>$remate_descripcion, 'remate_precio_garantia'=>$remate_precio_garantia));
			
	}
	
		public function obtener_fecha_inicio_remate($remate_id)
	{
		$this->db->select('remate_fecha_inicio');
		$this->db->from('remates');
		$this->db->where('remate_id', $remate_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->remate_fecha_inicio;
		}
		return false;
	}
	
	public function obtener_fecha_termino_remate($remate_id)
	{
		$this->db->select('remate_fecha_termino');
		$this->db->from('remates');
		$this->db->where('remate_id', $remate_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->remate_fecha_termino;
		}
		return false;
	}
	
	public function update_remate($categoria, $rematador, $remate_nombre, $remate_comuna, $remate_direccion, $remate_nombre_mandante, $foto_caluga, $precio_garantia, $remate_descripcion, $remate_id)
	{
		$data = array(
				'categoria_id'=> $categoria,
				'rematador_id'=> $rematador,
				'remate_nombre'=> $remate_nombre,
				'remate_comuna'=> $remate_comuna,
				'remate_direccion'=> $remate_direccion,
				'remate_nombre_mandante'=> $remate_nombre_mandante,
				'remate_imagen'=> $foto_caluga,
				'remate_descripcion'=> $remate_descripcion
				);
		$this->db->where('remate_id', $remate_id);
		$this->db->update('remates', $data); 
		
		return $this->db->affected_rows();
	}
	
	public function fin_remate($remate_id)
	{	
		$data = array('remate_estado' => 'finalizado');

		$this->db->where('remate_id', $remate_id);
		$this->db->update('remates', $data);
	}
	
	public function fin_lotes($remate_id)
	{	
		$data = array('lote_estado' => 'finalizado');

		$this->db->where('remate_id', $remate_id);
		$this->db->update('lotes', $data);
	}
	
	public function fin_lotes_por_id($lote_id)
	{	
		$data = array('lote_estado' => 'finalizado');

		$this->db->where('lote_id', $lote_id);
		$this->db->update('lotes', $data);
	}
	
	public function obtener_nombre_del_lote($lote_id)
	{
		$this->db->select('lote_nombre');
		$this->db->from('lotes');
		$this->db->where('lote_id', $lote_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->lote_nombre;
		}
		return false;
	}
	
	public function obtener_id_del_remate_por_lote($lote_id)
	{
		$this->db->select('*');
		$this->db->from('remates');
		$this->db->join('lotes', 'lotes.remate_id = remates.remate_id', 'inner');
		$this->db->where('lotes.lote_id', $lote_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->remate_id;
		}
		return false;
	}
	
	public function eliminar($remate_id = NULL)
	{
		$this->db->delete('remates', array('remate_id' => $remate_id));
	}
	
	public function existe($remate_id = NULL)
	{
		if ( ! is_null($remate_id))
		{
			$remate = $this->db->get_where('remates', array('remate_id' => $remate_id));
			if ( $remate->num_rows() > 0) return true;
			else return false;
		}
		return false;			
	}
	
	// DEBE IR UN PARÁMETRO QUE CAPTURE EL USUARIO, YA QUE PODRÍA CONSULTAR EL ÚLTIMO REMATE DE CUALQUIER USUARIO QUE INGRESO UNO
	
	public function consultar_ultimo_remate_ingresado($rematador_id, $dato)
	{
		$this->db->select('*');
		$this->db->from('remates');
		$this->db->where('rematador_id', $rematador_id);
		$this->db->order_by('remate_id', 'desc');
		$this->db->limit(1);
		$ultimo_remate = $this->db->get();
		if ( $ultimo_remate->num_rows() > 0)
		{
			$remate = $ultimo_remate->row();
			
			switch ($dato)
			{
				case 'nombre':
					return $remate->remate_nombre;
				break;
			
				case 'id':
					return $remate->remate_id;
				break;
			}
		}
		else return NULL;
	}

	public function obtener($remate_id = NULL)
	{
		if ( ! is_null($remate_id))
		{
			return $this->db->get_where('remates', array('remate_id' => $remate_id))->row();
		}
		else
		{
			return $this->db->order_by('remate_nombre', 'asc')->get('remates');
		}
	}
	
	public function obtener_datos_de_la_categoria($remate_id, $criterio)
	{
		$this->db->select('*');
		$this->db->from('remates');
		$this->db->join('categorias', 'remates.categoria_id = categorias.categoria_id', 'inner');
		$this->db->where('remates.remate_id', $remate_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			switch ($criterio)
			{
				case 'categoria_id':
					return $query->row()->categoria_id;
				break;
			
				case 'categoria_nombre':
					return $query->row()->categoria_nombre;
				break;
			}
		}
		return false;
	}
	
	public function obtener_nombre_del_remate($remate_id)
	{
		$this->db->select('remate_nombre');
		$this->db->from('remates');
		$this->db->where('remate_id', $remate_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->remate_nombre;
		}
		return false;
	}
	
	public function obtener_foto_del_remate($remate_id)
	{
		$this->db->select('remate_imagen');
		$this->db->from('remates');
		$this->db->where('remate_id', $remate_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->remate_imagen;
		}
		return false;
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
	
	public function obtener_tipos_por_remate($remate_id)
	{
		$this->db->distinct();
		$this->db->select('tipos.tipo_id, tipos.tipo_nombre');
		$this->db->from('tipos');
		$this->db->join('lotes', 'tipos.tipo_id = lotes.tipo_id', 'inner');
		$this->db->where('lotes.remate_id', $remate_id);
		$this->db->where('lotes.lote_estado', 'activo');
		$this->db->order_by('tipos.tipo_id', 'ASC');
		$tipos =  $this->db->get();
	
		if ( $tipos->num_rows() > 0)
		{
			return $tipos;
		}
	
		else return false;
	}
	
	public function obtener_totales_de_todos_los_tipos_del_remate($remate_id)
	{
		$this->db->from('tipos');
		$this->db->join('lotes', 'tipos.tipo_id = lotes.tipo_id', 'inner');
		$this->db->where('lotes.remate_id', $remate_id);
		$this->db->where('lotes.lote_estado', 'activo');
		$numero_totales_de_tipos_por_remate =  $this->db->count_all_results();
	
	    if(is_numeric($numero_totales_de_tipos_por_remate))
		{
			return $numero_totales_de_tipos_por_remate;
		}
		else return false;
	}
	
	public function obtener_totales_de_tipo_del_remate($remate_id, $tipo_id)
	{
		$this->db->from('lotes');
		$this->db->where('lote_estado', 'activo');
		$this->db->where('remate_id', $remate_id);
		$this->db->where('tipo_id', $tipo_id);
		$numero_de_tipos_por_remate =  $this->db->count_all_results();

	    if(is_numeric($numero_de_tipos_por_remate))
		{
			return $numero_de_tipos_por_remate;
		}
		else return false;
	}
	
	public function obtener_lotes_totales_por_remate($remate_id)
	{
		$this->db->from('lotes');
		$this->db->join('lotes', 'tipos.tipo_id = lotes.tipo_id', 'inner');
		$this->db->where('lotes.remate_id', $remate_id);
		$this->db->where('lotes.lote_estado', 'activo');
		$numero_de_lotes_por_remate =  $this->db->count_all_results();

	    if(is_numeric($numero_de_lotes_por_remate))
		{
			return $numero_de_lotes_por_remate;
		}
		else return false;
	}
	
		public function obtener_lotes_del_remate($remate_id, $ordenamiento)
	{
		$this->db->select('*');
		$this->db->from('lotes');
		$this->db->where('remate_id', $remate_id); 
		$this->db->where('lote_estado', 'activo');
		$this->db->group_by("lote_id"); 
		
		switch ($ordenamiento)
			{
				case 'cierre':
					$this->db->order_by('lote_fecha_cierre', 'ASC');
				break;
			
				case 'mayor_valor':
					$this->db->order_by('lote_valor_actual', 'DESC');
				break;
				
				case 'menor_valor':
					$this->db->order_by('lote_valor_actual', 'ASC');
				break;
				
				case 'mas_visitado':
					$this->db->order_by('lote_contador_visita', 'DESC');
				break;
				
				case null:
					$this->db->order_by('lote_fecha_cierre', 'ASC');
				break;
			}
		
		$lotes =  $this->db->get();
	
		if ( $lotes->num_rows() > 0)
		{
			return $lotes;
		}
	
		else return false;
	}
	
	
	public function obtener_lotes_del_remate_filtrado($remate_id, $ordenamiento, $filtro_tipo = null, $filtro_marca = null)
	{
		if($filtro_tipo == true and $filtro_marca == null)
		{
			$this->db->select('*');
			$this->db->from('lotes');
			$this->db->join('tipos', 'lotes.tipo_id = tipos.tipo_id', 'inner');
			$where = '(lotes.lote_estado = "activo" and lotes.remate_id='.$remate_id.' and lotes.tipo_id IN ('.$filtro_tipo.'))';
			$this->db->where($where);
		}
		elseif ($filtro_tipo == null and $filtro_marca == true)
		{
			$this->db->select('*');
			$this->db->from('lotes');
			$this->db->join('marcas', 'lotes.marca_id = marcas.marca_id', 'inner');
			$where = '(lotes.lote_estado = "activo" and lotes.remate_id='.$remate_id.' and lotes.marca_id IN ('.$filtro_marca.'))';
			$this->db->where($where);
		}
		elseif ($filtro_tipo == true and $filtro_marca == true)
		{
			$this->db->select('*');
			$this->db->from('lotes');
			$this->db->join('tipos', 'lotes.tipo_id = tipos.tipo_id', 'inner');
			$this->db->join('marcas', 'lotes.marca_id = marcas.marca_id', 'inner');
			$where = '(lotes.lote_estado = "activo" and lotes.remate_id='.$remate_id.' and lotes.tipo_id IN ('.$filtro_tipo.') and lotes.marca_id IN ('.$filtro_marca.'))';
			$this->db->where($where);
		}
		else
		{
			return false;
			break;
		}
		
		$this->db->group_by("lotes.lote_id"); 
		
		switch ($ordenamiento)
			{
				case 'cierre':
					$this->db->order_by('lotes.lote_fecha_cierre', 'ASC');
				break;
			
				case 'mayor_valor':
					$this->db->order_by('lotes.lote_valor_actual', 'DESC');
				break;
				
				case 'menor_valor':
					$this->db->order_by('lotes.lote_valor_actual', 'ASC');
				break;
				
				case 'mas_visitado':
					$this->db->order_by('lotes.lote_contador_visita', 'DESC');
				break;
				
				case null:
					$this->db->order_by('lotes.lote_fecha_cierre', 'ASC');
				break;
			}
		
		$lotes =  $this->db->get();
	
		if ( $lotes->num_rows() > 0)
		{
			return $lotes;
		}
		else return false;
	}
	
	public function obtener_primera_foto_del_lote($lote_id)
	{
		$this->db->select('foto_url');
		$this->db->from('fotos');
		$this->db->where('lote_id', $lote_id); 
		$this->db->order_by('foto_id', 'ASC');
		$this->db->limit(1);
		$foto =  $this->db->get();
	
		if ( $foto->num_rows() > 0)
		{
			return $foto->row()->foto_url;
		}
	
		else return false;
	}
	
	public function obtener_marcas_de_este_remate($remate_id)
	{
		$this->db->distinct();
		$this->db->select('marcas.marca_id, marcas.marca_nombre');
		$this->db->from('marcas');
		$this->db->join('lotes', 'marcas.marca_id = lotes.marca_id', 'inner');
		$this->db->where('lotes.remate_id', $remate_id);
		$this->db->where('lotes.lote_estado', 'activo');
		$this->db->order_by('marcas.marca_id', 'ASC');
		$marcas =  $this->db->get();
	
		if ( $marcas->num_rows() > 0)
		{
			return $marcas;
		}
	
		else return false;
	}
	
	public function obtener_totales_de_las_marcas_del_remate($remate_id, $marca_id)
	{
		$this->db->from('lotes');
		$this->db->where('lote_estado', 'activo');
		$this->db->where('remate_id', $remate_id);
		$this->db->where('marca_id', $marca_id);
		$numero_de_marcas_por_remate =  $this->db->count_all_results();

	    if(is_numeric($numero_de_marcas_por_remate))
		{
			return $numero_de_marcas_por_remate;
		}
		else return false;
	}
	
	public function obtener_totales_de_todas_las_marcas_del_remate($remate_id)
	{
		$this->db->from('marcas');
		$this->db->join('lotes', 'marcas.marca_id = lotes.marca_id', 'inner');
		$this->db->where('lotes.remate_id', $remate_id);
		$this->db->where('lotes.lote_estado', 'activo');
		$numero_totales_de_marcas_por_remate =  $this->db->count_all_results();
	
	    if(is_numeric($numero_totales_de_marcas_por_remate))
		{
			return $numero_totales_de_marcas_por_remate;
		}
		else return false;
	}
	
	public function obtener_datos_del_rematador($remate_id, $criterio)
	{
		$this->db->select('*');
		$this->db->from('rematadores');
		$this->db->join('remates', 'remates.rematador_id = rematadores.rematador_id', 'inner');
		$this->db->where('remates.remate_id', $remate_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			switch ($criterio)
			{
				case 'rematador_id':
					return $query->row()->rematador_id;
				break;
			
				case 'rematador_nombre_empresa':
					return $query->row()->rematador_nombre_empresa;
				break;
				
				case 'rematador_foto':
					return $query->row()->rematador_foto;
				break;
			}
		}
		return false;
	}
	
	public function obtener_nombre_del_mandante($remate_id)
	{
		$this->db->select('remate_nombre_mandante');
		$this->db->from('remates');
		$this->db->where('remate_id', $remate_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->remate_nombre_mandante;
		}
		return false;
	}
	
	public function obtener_ofertas_del_lote($lote_id)
	{
		$this->db->select('*');
		$this->db->from('subastas');
		$this->db->where('lote_id', $lote_id); 
		$numero_de_ofertas_por_este_lote = $this->db->count_all_results();
		
	    if(is_numeric($numero_de_ofertas_por_este_lote))
		{
			return $numero_de_ofertas_por_este_lote;
		}
		else return false;
	}
	
	public function obtener_todos_los_datos_del_remate($remate_id)
	{
		$this->db->select('*');
		$this->db->from('remates');
		$this->db->where('remate_id', $remate_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query;
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
	
	public function obtener_rematador_del_remate($remate_id)
	{
		$this->db->select('rematador_id');
		$this->db->from('remates');
		$this->db->where('remate_id', $remate_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->rematador_id;
		}
		return false;
	}
	
	public function consultar_lotes_del_remate($remate_id)
	{
		$this->db->select('*');
		$this->db->from('lotes');
		$this->db->where('remate_id', $remate_id);
		$remates =  $this->db->get();
	
		if ( $remates->num_rows() > 0)
		{
			return $remates;
		}
	
		else return false;
	}
	
	public function consultar_tipo_del_lote($tipo_id)
	{

		$this->db->select('tipos.tipo_id, tipos.tipo_nombre');
		$this->db->from('tipos');
		$this->db->join('lotes', 'lotes.tipo_id = tipos.tipo_id', 'inner');
		$this->db->where('lotes.tipo_id', $tipo_id); 
		
		$query =  $this->db->get();
		if ( $query->num_rows() > 0)
		{
			return $query->row()->tipo_nombre;
		}
		else return false;
	}
	
	public function consultar_marca_del_lote($marca_id)
	{

		$this->db->select('marcas.marca_id, marcas.marca_nombre');
		$this->db->from('marcas');
		$this->db->join('lotes', 'lotes.marca_id = marcas.marca_id', 'inner');
		$this->db->where('lotes.marca_id', $marca_id); 
		
		$query =  $this->db->get();
		if ( $query->num_rows() > 0)
		{
			return $query->row()->marca_nombre;
		}
		else return false;
	}
	
	public function obtener_remate_por_id($remate_id)
	{
		$this->db->select('*'); 
		$this->db->from('remates');
		$this->db->where('remate_id', $remate_id); 
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		return false;
	}
	
	public function obtener_datos_rematador($rematador_id)
	{
		return $this->db->get_where('rematadores', array('rematador_id' => $rematador_id))->row();
	}
	
	public function obtener_datos_ofertante($ofertante_id)
	{
		return $this->db->get_where('ofertantes', array('ofertante_id' => $ofertante_id))->row();
	}
	
	public function obtener_datos_remate($remate_id)
	{
		return $this->db->get_where('remates', array('remate_id' => $remate_id))->row();
	}
	
	public function obtener_datos_lote($lote_id)
	{
		return $this->db->get_where('lotes', array('lote_id' => $lote_id))->row();
	}
	
	public function consultar_lotes_de_remate($remate_id)
	{
		$this->db->select('*');
		$this->db->from('lotes');
		$this->db->where('remate_id', $remate_id); 
	//	$where = "remate_id = ".$remate_id." AND lote_estado = 'activo' ";
	//	$this->db->where($where);
		
		$lotes_del_remate =  $this->db->get();
	
		if ( $lotes_del_remate->num_rows() > 0)
		{
			return $lotes_del_remate;
		}
	
		else return false;
	}
		
}