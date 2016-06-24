<?php if ( ! defined('BASEPATH')) exit('Acceso directo no permitido');
class Lote_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('remate_model');

	}
	
	public function obtener($lote_id = NULL)
	{
		if ( ! is_null($lote_id))
		{
			return $this->db->get_where('lotes', array('lote_id' => $lote_id))->row();
		}
	}
	
	public function consultar_id_del_remate_del_lote($lote_id)
	{
		$this->db->select('remate_id');
		$this->db->from('lotes');
		$this->db->where('lote_id', $lote_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->row()->remate_id;
		}
		return false;
	}
	
	public function insertar_lote_masivo($data,$remate_id)
	{
		
		foreach ($data as $registro)
		{
			$registro['lote_fecha_inicio'] = $this->remate_model->obtener_fecha_inicio_remate($remate_id);
			$registro['lote_fecha_cierre'] = $this->remate_model->obtener_fecha_termino_remate($remate_id);
			$registro['remate_id'] = $remate_id;
			$registro['lote_comision'] = 0.12;
			$registro['lote_ganador_id'] = -1;
			$this->db->insert('lotes', $registro);
		}
	}
	
		public function insert_lote($remate_id, $tipo_id, $marca_id, $lote_modelo, $lote_descripcion, $lote_fecha_inicio, $lote_fecha_termino, $lote_puja_minima, $lote_incremento, $fichero, $lote_link_video, $foto_1, $foto_2, $foto_3, $foto_4, $foto_5)
	{
		// de momento la comisión por lote es fija (12%)
	
		$numero_de_lote = $this->consultar_ultimo_lote_ingresado_del_remate($remate_id);
	
		if(is_numeric($numero_de_lote))
		{
			$nombre_del_lote = $numero_de_lote + 1;
		}
		else
		{
			$nombre_del_lote = '1';
		}
	
		$query = $this->db->insert('lotes', array('remate_id'=>$remate_id, 'tipo_id'=>$tipo_id, 'marca_id'=>$marca_id, 'lote_modelo'=>$lote_modelo , 'lote_ganador_id'=> -1 , 'lote_nombre'=> 'Lote '.$nombre_del_lote, 'lote_descripcion'=>$lote_descripcion, 'lote_fecha_inicio'=>$lote_fecha_inicio, 'lote_fecha_cierre'=>$lote_fecha_termino, 'lote_contador_visita' => 0, 'lote_contador_puja' => 0, 'lote_estado' => 'activo', 'lote_puja_minima'=>$lote_puja_minima, 'lote_incremento'=>$lote_incremento, 'lote_valor_actual'=> $lote_puja_minima, 'lote_documento_adjunto'=>$fichero, 'lote_link_video'=>$lote_link_video, 'lote_comision'=>'0.12'));
	
		$lote_id = $this->consultar_id_del_ultimo_lote_ingresado();
	
		$query = $this->db->insert('fotos', array('lote_id'=>$lote_id, 'foto_url'=>$foto_1));
		$query = $this->db->insert('fotos', array('lote_id'=>$lote_id, 'foto_url'=>$foto_2));
		$query = $this->db->insert('fotos', array('lote_id'=>$lote_id, 'foto_url'=>$foto_3));
		$query = $this->db->insert('fotos', array('lote_id'=>$lote_id, 'foto_url'=>$foto_4));
		$query = $this->db->insert('fotos', array('lote_id'=>$lote_id, 'foto_url'=>$foto_5));
	
	}
	
	public function consultar_ultimo_lote_ingresado_del_remate($remate_id)
	{
		$this->db->select('lote_nombre');
		$this->db->from('lotes');
		$this->db->where('remate_id', $remate_id);
		$this->db->order_by('lote_id', 'desc');
		$this->db->limit(1);
		
		$ultimo_lote = $this->db->get();
		
		if ( $ultimo_lote->num_rows() > 0)
		{
			$lote = $ultimo_lote->row()->lote_nombre;;
			$numero = explode(" ", $lote);
			return $numero[1];
		}
		else return NULL;
	}
	
	public function consultar_id_del_ultimo_lote_ingresado()
	{
		$ultimo_lote = $this->db->order_by('lote_id', 'desc')->get('lotes');
		if ( $ultimo_lote->num_rows() > 0)
		{
			$lote = $ultimo_lote->row();
			return $lote->lote_id;
		}
		else return NULL;
	}
	
	public function consultar_lote($lote_id){
		$this->db->select('*');
		$this->db->from('lotes');
		$this->db->where('lote_id', $lote_id); 
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		return false;
	}
		
	public function consultar_nombre_del_remate($remate_id)
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
	
	public function consultar_categoria_del_remate($remate_id, $criterio)
	{
		$this->db->select('categorias.categoria_id, categorias.categoria_nombre');
		$this->db->from('categorias');
		$this->db->join('remates', 'remates.categoria_id = categorias.categoria_id', 'inner');
		$this->db->where('remates.remate_id', $remate_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			if ($criterio == "nombre")
			{
				return $query->row()->categoria_nombre;
			}
			elseif ($criterio == "id")
			{
				return $query->row()->categoria_id;
			}
		}
		return false;
	}
	
	public function consultar_tipo_del_lote($remate_id)
	{

		$this->db->select('tipo_id, tipo_nombre');
		$this->db->from('tipos');
		$this->db->join('remates', 'remates.categoria_id = tipos.categoria_id', 'inner');
		$this->db->where('remates.remate_id', $remate_id); 
		$this->db->where('tipos.tipo_estado', 'activo'); 
		
		$query =  $this->db->get();
		if ( $query->num_rows() > 0)
		{
			return $query;
		}
		else return false;
	}
	
	public function consultar_marca_del_lote($remate_id)
	{

		$this->db->select('*');
		$this->db->from('marcas');
		$this->db->join('remates', 'remates.categoria_id = marcas.categoria_id', 'inner');
		$this->db->where('remates.remate_id', $remate_id); 
		$this->db->where('marcas.marca_estado', 'activo'); 
		$this->db->order_by("marcas.marca_nombre", "asc");
		
		$query =  $this->db->get();
		if ( $query->num_rows() > 0)
		{
			return $query;
		}
		else return false;
	}
	
	public function consultar_fechas_del_remate($remate_id, $criterio)
	{
		$this->db->select('*');
		$this->db->from('remates');
		$this->db->where('remate_id', $remate_id); 
		
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			switch ($criterio)
			{
				case 'inicio':
				return $query->row()->remate_fecha_inicio;
				break;
				case 'final':
				return $query->row()->remate_fecha_termino;
				break;
			}
		}
		return false;
	}
	
	// Modificar. Debe ir con ajax para que de forma dinámica cambie junto con el 'seleccionar marca'
	
	public function obtener_modelo_del_lote()
	{
		$this->db->select('*');
		$this->db->from('modelos');
		
		$query =  $this->db->get();
		if ( $query->num_rows() > 0)
		{
			return $query;
		}
		else return false;
	}
	
	
	public function obtener_remate_por_lote($remate_id){
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
	
	public function consultar_remates_del_rematador($rematador_id)
	{

		$this->db->select('*');
		$this->db->from('remates');
		$this->db->where('rematador_id', $rematador_id); 
		$this->db->where('remate_estado', 'activo'); 
		
		$query =  $this->db->get();
		if ( $query->num_rows() > 0)
		{
			return $query;
		}
		else return false;
	}

	
/* 	public function eliminar($proyecto_id = NULL)
	{
		$this->db->delete('proyectos', array('proyecto_id' => $proyecto_id));
		if ( $this->db->affected_rows() > 0)
		{
			$this->db->insert('logs', array(
				'log_descripcion' => 'Se eliminó el proyecto ID: '.$proyecto_id,
				'usuario_id' => $this->auth->get_id()
			));
			return true;
		}
		
		else return false;		
	} */
/* 	
	public function existe($proyecto_id = NULL)
	{
		if ( ! is_null($proyecto_id))
		{
			$proyecto = $this->db->get_where('proyectos', array('proyecto_id' => $proyecto_id));
			if ( $proyecto->num_rows() > 0) return true;
			else return false;
		}
		return false;			
	} */
		
	public function comprobar_oferta($lote_id, $usuario_id){
		//IF ULTIMO EN PUJAR
	}	
		
	public function subastar($lote_id, $ofertante_id, $monto){
		
		
		//GET VALOR ACTUAL
		
		$this->db->select('*'); 
		$this->db->from('lotes');
		$this->db->where('lote_id', $lote_id); 
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			$valor = $query->row();
		}
		$valor_actual = $valor->lote_valor_actual;
		
		$valor_actual = $valor_actual + $monto;
		
		//INSERT SUABSTA
		
		$data = array(
		   'lote_id' => $lote_id,
		   'ofertante_id' => $ofertante_id,
		   'subasta_valor' => $monto,
		   'subasta_total' => $valor_actual,
		   'subasta_fecha' => date('Y-m-d H:i:s')
		);
		$this->db->insert('subastas', $data); 
		
		
		//UPDATE LOTE
		
		
		$data = array(
               'lote_valor_actual' => $valor_actual,
			   'lote_ganador_id' => $ofertante_id
            );
		$this->db->where('lote_id', $lote_id);
		$this->db->update('lotes', $data); 
	}
	
	public function obtener_total_subastas_por_lote($lote_id){
		$this->db->select('*');
		$this->db->from('lotes');
		$this->db->join('subastas', 'lotes.lote_id = subastas.lote_id', 'inner');
		$this->db->join('ofertantes', 'subastas.ofertante_id = ofertantes.ofertante_id', 'inner');
		$this->db->where('lotes.lote_id', $lote_id); 
		$this->db->order_by("subastas.subasta_total", "desc"); 
		
		$query =  $this->db->get();
		if ( $query->num_rows() > 0)
		{
			return $query->result_array(); 
		}
		else return false;
	}
	
	public function obtener_visitas_del_lote($lote_id)
	{
		$this->db->select('lote_contador_visita');
		$this->db->from('lotes');
		$this->db->where('lote_id', $lote_id); 
		
		$query =  $this->db->get();
		if ( $query->num_rows() > 0)
		{
			return $query->row()->lote_contador_visita;
			
		}
		else return false;
	}
	
	public function actualizar_contador_visitas($lote_id)
	{
		
		$visitas = $this->obtener_visitas_del_lote($lote_id);
		
		$data = array(
               'lote_contador_visita' => $visitas + 1
            );
		$this->db->where('lote_id', $lote_id);
		$this->db->update('lotes', $data); 
		
	}
	
	public function conocer_ofertas_del_lote($lote_id)
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
	
	public function obtener_ofertas_del_lote($lote_id)
	{
		
		$ofertas = $this->conocer_ofertas_del_lote($lote_id);
		
		$data = array(
               'lote_contador_puja' => $ofertas
            );
		$this->db->where('lote_id', $lote_id);
		$this->db->update('lotes', $data);

		return $ofertas;
		
	}
	
		
	public function obtener_visitas_del_remate($remate_id)
	
	{
		$this->db->select_max('lote_contador_visita');
		$this->db->from('lotes');
		$this->db->where('remate_id', $remate_id);
		$this->db->where('lote_estado', 'activo');
		
		
		$query =  $this->db->get();
		if ( $query->num_rows() > 0)
		{
			return $query->row()->lote_contador_visita;
			
		}
		else return false;
	}
	
	public function actualizar_contador_visitas_del_remate($remate_id)
	{
		
		$visitas = $this->obtener_visitas_del_remate($remate_id);
		
		$data = array(
               'remate_contador_visitas' => $visitas
            );
		$this->db->where('remate_id', $remate_id);
		$this->db->update('remates', $data); 
		
	}
	
	public function obtener_ofertas_del_remate($remate_id)
	
	{
		$this->db->select_max('lote_contador_puja');
		$this->db->from('lotes');
		$this->db->where('remate_id', $remate_id);
		$this->db->where('lote_estado', 'activo');
		
		
		$query =  $this->db->get();
		if ( $query->num_rows() > 0)
		{
			return $query->row()->lote_contador_puja;
			
		}
		else return false;
	}
	
	public function actualizar_contador_ofertas_del_remate($remate_id)
	{
		
		$ofertas = $this->obtener_ofertas_del_remate($remate_id);
		
		$data = array(
               'remate_contador_ofertas' => $ofertas
            );
		$this->db->where('remate_id', $remate_id);
		$this->db->update('remates', $data); 
		
	}
	
	public function obtener_fotos_lote($lote_id){
		$this->db->select('*');
		$this->db->from('fotos');
		$this->db->where('lote_id', $lote_id); 
		
		$query =  $this->db->get();
		if ( $query->num_rows() > 0)
		{
			return $query->result_array(); 
		}
		else return false;
	}
	
	public function obtener_datos_ofertante($ofertante_id)
	{
		return $this->db->get_where('ofertantes', array('ofertante_id' => $ofertante_id))->row();
	}
	
	public function obtener_datos_remate($remate_id)
	{
		return $this->db->get_where('remates', array('remate_id' => $remate_id))->row();
	}
	
	public function obtener_fecha_subasta($lote_id, $ofertante_id, $monto)
	{
		$this->db->select('subasta_fecha');
		$this->db->from('subastas');
		$this->db->where('lote_id', $lote_id); 
		$this->db->where('ofertante_id', $ofertante_id); 
		$this->db->where('subasta_total', $monto);
		
		$query =  $this->db->get();
		if ( $query->num_rows() > 0)
		{
			return $query->row()->subasta_fecha;
		}
		else return false;
		
	//	return $this->db->get_where('subastas', array('lote_id' => $lote_id, 'ofertante_id' => $ofertante_id, 'subasta_total' => $monto))->row();
	}
	
	public function obtener_datos_rematador($rematador_id)
	{
		return $this->db->get_where('rematadores', array('rematador_id' => $rematador_id))->row();
	}
	
	public function consultar_ofertantes_perdiendo_este_lote($lote_id, $ofertante_id)
	{
		$this->db->select('*');
		$this->db->from('subastas');
		$where = "lote_id = ".$lote_id." AND ofertante_id != ".$ofertante_id." ";
		$this->db->where($where);
		
		$ofertantes_perdiendo =  $this->db->get();
	
		if ( $ofertantes_perdiendo->num_rows() > 0)
		{
			return $ofertantes_perdiendo;
		}
	
		else return false;
	}

}