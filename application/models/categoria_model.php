<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');
class Categoria_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
		
	public function obtener_categorias()
	{
		$this->db->select('*');
		$this->db->from('categorias');
		$where = '( categoria_id != 1 and categoria_estado = "activo" )';
		$this->db->where($where);
		$this->db->order_by('categoria_nombre', 'ASC');
		$categorias =  $this->db->get();
	
		if ( $categorias->num_rows() > 0)
		{
			return $categorias;
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
	
	public function obtener_nombre_de_la_categoria($categoria_id)
	{
		$this->db->select('categoria_nombre');
		$this->db->from('categorias');
		$this->db->where('categoria_id', $categoria_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->categoria_nombre;
		}
		return false;
	}
	
	public function obtener_una_categoria($categoria_id)
	{
		return $this->db->get_where('categorias', array('categoria_id' => $categoria_id))->row();
	}
	
	public function obtener_lotes_totales_por_categoria($categoria_id)
	{
	//	$this->db->select('*');
		$this->db->from('remates');
		$this->db->join('categorias', 'remates.categoria_id = categorias.categoria_id', 'inner');
		$this->db->join('lotes ', 'lotes.remate_id = remates.remate_id', 'inner');
		$this->db->where('remates.remate_estado', 'activo');
		$this->db->where('lotes.lote_estado', 'activo');
		$this->db->where('categorias.categoria_id', $categoria_id);
		$numero_de_lotes_por_remate =  $this->db->count_all_results();

	    if(is_numeric($numero_de_lotes_por_remate))
		{
			return $numero_de_lotes_por_remate;
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
	
	public function obtener_tipos_de_los_remates_por_categoria($categoria_id)
	{
		$this->db->distinct();
		$this->db->select('tipos.tipo_id, tipos.tipo_nombre');
		$this->db->from('tipos');
		$this->db->join('lotes', 'tipos.tipo_id = lotes.tipo_id', 'inner');
		$this->db->join('remates', 'remates.remate_id = lotes.remate_id', 'inner');
		$this->db->join('categorias', 'categorias.categoria_id = remates.categoria_id', 'inner');
		$this->db->where('remates.remate_estado', 'activo');
		$this->db->where('lotes.lote_estado', 'activo');
		$this->db->where('categorias.categoria_id', $categoria_id);
		$this->db->order_by('tipos.tipo_id', 'ASC');
		$tipos =  $this->db->get();
	
		if ( $tipos->num_rows() > 0)
		{
			return $tipos;
		}
	
		else return false;
	}
	
	public function obtener_totales_de_tipo_de_la_categoria($categoria_id, $tipo_id)
	{
		$this->db->from('lotes');
		$this->db->join('remates', 'remates.remate_id = lotes.remate_id', 'inner');
		$this->db->where('lote_estado', 'activo');
		$this->db->where('remates.remate_estado', 'activo');
		$this->db->where('remates.categoria_id', $categoria_id);
		$this->db->where('lotes.tipo_id', $tipo_id);
		$numero_de_tipos_por_categoria =  $this->db->count_all_results();

	    if(is_numeric($numero_de_tipos_por_categoria))
		{
			return $numero_de_tipos_por_categoria;
		}
		else return false;
	}
	
	public function obtener_totales_de_todos_los_tipos_del_remate($categoria_id)
	{
		$this->db->from('tipos');
		$this->db->join('lotes', 'tipos.tipo_id = lotes.tipo_id', 'inner');
		$this->db->join('remates', 'remates.remate_id = lotes.remate_id', 'inner');
		$this->db->where('lotes.lote_estado', 'activo');
		$this->db->where('remates.remate_estado', 'activo');
		$this->db->where('remates.categoria_id', $categoria_id);
		$numero_totales_de_tipos_por_categoria =  $this->db->count_all_results();
	
	    if(is_numeric($numero_totales_de_tipos_por_categoria))
		{
			return $numero_totales_de_tipos_por_categoria;
		}
		else return false;
	}
	
	
	 // arreglar
	public function obtener_totales_de_los_tipos_por_categoria($categoria_id)
	{
		/* $this->db->from('tipos');
		$this->db->join('remates', 'tipos.categoria_id = remates.categoria_id', 'inner');
		$this->db->join('lotes ', 'lotes.remate_id = remates.remate_id', 'inner');
		$this->db->where('remates.remate_estado', 'activo');
		$this->db->where('lotes.lote_estado', 'activo');
		$this->db->where('categorias.categoria_id', $categoria_id);
		$numero_de_tipos_por_categoria =  $this->db->count_all_results();

	    if(is_numeric($numero_de_tipos_por_categoria))
		{
			return $numero_de_tipos_por_categoria;
		}
		else return false; */
	}
	
	public function obtener_tipos_por_categorias($categoria_id)
	{
//		$this->output->enable_profiler(TRUE);
		$this->db->select('*');
		$this->db->from('tipos');
		$this->db->where('categoria_id', $categoria_id);
		$this->db->order_by('tipo_id', 'ASC');
		$tipos =  $this->db->get();
	
		if ( $tipos->num_rows() > 0)
		{
			return $tipos;
		}
	
		else return false;
	}
	
	public function obtener_nombre_del_tipo_de_la_categoria($categoria_id)
	{
		$this->db->select('tipo_nombre');
		$this->db->from('tipos');
		$this->db->where('categoria_id', $categoria_id);
		$this->db->where('tipo_estado', 'activo');
		$this->db->order_by('tipo_id', 'ASC');
		$query = $this->db->get();

		if ( $query->num_rows() > 0)
		{
			return $query;
		}
	
		else return false;
	}
	
	public function obtener_nombre_de_las_marcas_de_la_categoria($categoria_id)
	{
		$this->db->select('marca_nombre');
		$this->db->from('marcas');
		$this->db->where('categoria_id', $categoria_id);
		$this->db->where('marca_estado', 'activo');
		$this->db->order_by('marca_id', 'ASC');
		$query = $this->db->get();

		if ( $query->num_rows() > 0)
		{
			return $query;
		}
	
		else return false;
	}
	
	public function obtener_marcas_por_categorias($categoria_id)
	{
		$this->db->distinct();
		$this->db->select('marcas.marca_id, marcas.marca_nombre');
		$this->db->from('marcas');
		$this->db->join('lotes', 'marcas.marca_id = lotes.marca_id', 'inner');
		$this->db->join('remates', 'remates.remate_id = lotes.remate_id', 'inner');
		$this->db->join('categorias', 'categorias.categoria_id = remates.categoria_id', 'inner');
		$this->db->where('remates.remate_estado', 'activo');
		$this->db->where('lotes.lote_estado', 'activo');
		$this->db->where('categorias.categoria_id', $categoria_id);
		$this->db->order_by('marcas.marca_id', 'ASC');
		$marcas =  $this->db->get();
	
		if ( $marcas->num_rows() > 0)
		{
			return $marcas;
		}
		else return false;
	}
	
	public function obtener_totales_de_las_marcas_de_la_categoria($categoria_id, $marca_id)
	{
		$this->db->from('lotes');
		$this->db->join('remates', 'remates.remate_id = lotes.remate_id', 'inner');
		$this->db->where('lotes.lote_estado', 'activo');
		$this->db->where('remates.remate_estado', 'activo');
		$this->db->where('remates.categoria_id', $categoria_id);
		$this->db->where('lotes.marca_id', $marca_id);
		$numero_de_marcas_por_categoria =  $this->db->count_all_results();

	    if(is_numeric($numero_de_marcas_por_categoria))
		{
			return $numero_de_marcas_por_categoria;
		}
		else return false;
	}
	
	public function obtener_totales_de_todas_las_marcas_de_la_categoria($categoria_id)
	{
		$this->db->from('marcas');
		$this->db->join('lotes', 'marcas.marca_id = lotes.marca_id', 'inner');
		$this->db->join('remates', 'remates.remate_id = lotes.remate_id', 'inner');
		$this->db->where('lotes.lote_estado', 'activo');
		$this->db->where('remates.remate_estado', 'activo');
		$this->db->where('remates.categoria_id', $categoria_id);
		$numero_totales_de_marcas_por_categoria =  $this->db->count_all_results();
	
	    if(is_numeric($numero_totales_de_marcas_por_categoria))
		{
			return $numero_totales_de_marcas_por_categoria;
		}
		else return false;
	}
	
	public function obtener_remates_de_la_categoria($categoria_id)
	{
		$this->db->select('*');
		$this->db->from('remates');
		$this->db->where('categoria_id', $categoria_id); 
		$this->db->where('remate_estado', 'activo'); 
		$this->db->order_by('remate_fecha_termino', 'ASC');
		$remates =  $this->db->get();
	
		if ( $remates->num_rows() > 0)
		{
			return $remates;
		}
	
		else return false;
	}
	
	public function obtener_remates_de_la_categoria_filtrado($categoria_id, $f_tipo = null, $f_marca = null)
	{
		if ($f_tipo == true and $f_marca == null)
		{
 			$this->db->select('*');
			$this->db->from('remates');
			$this->db->join('lotes', 'remates.remate_id = lotes.remate_id', 'inner');
			$this->db->join('tipos', 'lotes.tipo_id = tipos.tipo_id', 'inner');
			$this->db->join('categorias', 'categorias.categoria_id = remates.categoria_id', 'inner');
			$where = '( remates.remate_estado = "activo" and lotes.lote_estado = "activo" and categorias.categoria_id='.$categoria_id.' and lotes.tipo_id IN ('.$f_tipo.'))';
			$this->db->where($where);
		}
		elseif ($f_tipo == null and $f_marca == true)
		{
 			$this->db->select('*');
			$this->db->from('remates');
			$this->db->join('lotes', 'remates.remate_id = lotes.remate_id', 'inner');
			$this->db->join('marcas', 'lotes.marca_id = marcas.marca_id', 'inner');
			$this->db->join('categorias', 'categorias.categoria_id = remates.categoria_id', 'inner');
			$where = '( remates.remate_estado = "activo" and lotes.lote_estado = "activo" and categorias.categoria_id='.$categoria_id.' and lotes.marca_id IN ('.$f_marca.'))';
			$this->db->where($where);
		}
		elseif ($f_tipo == true and $f_marca == true)
		{
 			$this->db->select('*');
			$this->db->from('remates');
			$this->db->join('lotes', 'remates.remate_id = lotes.remate_id', 'inner');
			$this->db->join('tipos', 'lotes.tipo_id = tipos.tipo_id', 'inner');
			$this->db->join('marcas', 'lotes.marca_id = marcas.marca_id', 'inner');
			$this->db->join('categorias', 'categorias.categoria_id = remates.categoria_id', 'inner');
			$where = '( remates.remate_estado = "activo" and lotes.lote_estado = "activo" and categorias.categoria_id='.$categoria_id.' and lotes.tipo_id IN ('.$f_tipo.') and  lotes.marca_id IN ('.$f_marca.'))';
			$this->db->where($where);
		}
		else
		{
			return false;
			break;
		}
		$this->db->group_by("remates.remate_id"); 
		$this->db->order_by('remates.remate_fecha_termino', 'ASC');
		$remates =  $this->db->get();
	
		if ( $remates->num_rows() > 0)
		{
			return $remates;
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
	
	public function obtener_valor_del_ultimo_lote_del_remate($remate_id)
	{
		$this->db->select('lote_valor_actual, MAX( lote_fecha_cierre )');
		$this->db->from('lotes');
		$where = '(remate_id='.$remate_id.' and lote_estado="activo")';
		$this->db->where($where);
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->lote_valor_actual;
		}
		return false;
	}
	
	function ingresar($categoria_nombre)
	{
		
		$query = $this->db->insert('categorias', array('categoria_nombre'=>$categoria_nombre, 'categoria_estado'=>'activo'));
		
		$categoria_id = $this->consultar_id_de_la_ultima_categoria();
		
		$query = $this->db->insert('tipos', array('tipo_nombre'=>'('.$categoria_nombre.' sin tipo)', 'tipo_estado'=>'activo', 'categoria_id'=>$categoria_id));
		$query = $this->db->insert('marcas', array('marca_nombre'=>'('.$categoria_nombre.' sin marca)', 'marca_estado'=>'activo', 'categoria_id'=>$categoria_id));
		
		/* 
		
		$campos = array(
			'categoria_nombre',
		);
		$data = array();
		foreach ( $campos as $c)
		{
			$data[$c] = $this->input->post($c);
		}
		return $this->db->insert('categorias', $data); */
	}
	
	public function consultar_id_de_la_ultima_categoria()
	{
		$ultima_categoria = $this->db->order_by('categoria_id', 'desc')->get('categorias');
		if ( $ultima_categoria->num_rows() > 0)
		{
			$categoria = $ultima_categoria->row();
			return $categoria->categoria_id;
		}
		else return NULL;
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
	
	function editar_tipo_estandar($categoria_id, $antiguo_nombre, $nombre_categoria)
	{
		$data = array(
               'tipo_nombre' => '('.$nombre_categoria.' sin tipo)'
            );
		$this->db->where('categoria_id', $categoria_id);
		$this->db->where('tipo_nombre', '('.$antiguo_nombre.' sin tipo)');
		return $this->db->update('tipos', $data); 
	}
	
	function editar_marca_estandar($categoria_id, $antiguo_nombre, $nombre_categoria)
	{
		$data = array(
               'marca_nombre' => '('.$nombre_categoria.' sin marca)'
            );
		$this->db->where('categoria_id', $categoria_id);
		$this->db->where('marca_nombre', '('.$antiguo_nombre.' sin marca)');
		return $this->db->update('marcas', $data); 
	}
	
	function eliminar($categoria_id = NULL)
	{
	//	$this->db->delete('categorias', array('categoria_id' => $categoria_id));
	//	return $this->db->affected_rows();
		$categorias = $this->desactivar_categoria($categoria_id);
		$tipos = $this->desactivar_tipos($categoria_id);
		$marcas = $this->desactivar_marcas($categoria_id);
		$remates = $this->desactivar_remates($categoria_id);
		if($categorias == true and $tipos == true and $marcas == true and $remates == true) return true;
		else return false;
	}
	
	function desactivar_categoria($categoria_id)
	{
		$data = array(
               'categoria_estado' => 'desactivado'
            );
		$this->db->where('categoria_id', $categoria_id);
		return $this->db->update('categorias', $data); 
	}
	
	function desactivar_tipos($categoria_id)
	{
		$data = array(
               'categoria_id' => '1'
            );
		$this->db->where('categoria_id', $categoria_id);
		return $this->db->update('tipos', $data); 
	}
	
	function desactivar_marcas($categoria_id)
	{
		$data = array(
               'categoria_id' => '1'
            );
		$this->db->where('categoria_id', $categoria_id);
		return $this->db->update('marcas', $data); 
	}
	
	function desactivar_remates($categoria_id)
	{
		$data = array(
               'categoria_id' => '1'
            );
		$this->db->where('categoria_id', $categoria_id);
		return $this->db->update('remates', $data); 
	}
	
	
	function validar_existencia_de_la_categoria($categoria_nombre)
	{
		$this->db->select('*');
		$this->db->from('categorias');
		$this->db->like('categoria_nombre', $categoria_nombre, 'none'); 
		$this->db->where('categoria_estado', 'activo');
		
		$categorias =  $this->db->get();
	
		if ( $categorias->num_rows() > 0)
		{
		//	return $categorias;
			return true;
		}
	
		else return false;	
	}
	
	function activo($categoria_id)
	{
		$this->db->select('*');
		$this->db->from('categorias');
		$this->db->where('categoria_id', $categoria_id);
		$this->db->where('categoria_estado', 'activo');
		
		$categorias =  $this->db->get();
	
		if ( $categorias->num_rows() > 0)
		{
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