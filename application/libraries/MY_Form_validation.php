<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class MY_Form_validation extends CI_Form_validation
{

	public function validar_rut($rut)
	{
		$rut = preg_replace('/\.*,*\-*/', '', $rut);
		$dv = substr($rut, -1);
		$rut = substr($rut, 0, strlen($rut)-1);
		$r = $rut;
		$s=1;
		for($m=0;$r!=0;$r/=10)$s=($s+$r%10*(9-$m++%6))%11;
		$dvv = chr($s?$s+47:75);
		if(is_numeric($r) && $dv == $dvv)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function exists($str, $field)
	{
		if (substr_count($field, '.')==3)
		{
			list($table,$field,$id_field,$id_val) = explode('.', $field);
			$query = $this->CI->db->limit(1)->where($field,$str)->where($id_field.' != ',$id_val)->get($table);
		}
		else
		{
			list($table, $field)=explode('.', $field);
			$query = $this->CI->db->limit(1)->get_where($table, array($field => $str));
		}
		return $query->num_rows() !== 0;
    }
    
    public function validar_fecha_inicio($fecha_inicio, $campo_fecha_termino)
    {
		$fecha_termino = $this->CI->input->post($campo_fecha_termino);
		$fecha_inicio = date_create_from_format('d-m-Y H:i', $fecha_inicio);
		$fecha_termino = date_create_from_format('d-m-Y H:i', $fecha_termino);
		$diferencia = $fecha_termino->format('U') - $fecha_inicio->format('U');
		if ($diferencia > 0) return TRUE;
		else return FALSE;
	}
	
	public function existe_rut($str, $field)
	{
		return $this->exists($str, $field);
	}
	
	public function not_exists($str, $field)
	{
		if (substr_count($field, '.')==3)
		{
			list($table,$field,$id_field,$id_val) = explode('.', $field);
			$query = $this->CI->db->limit(1)->where($field,$str)->where($id_field.' != ',$id_val)->get($table);
		}
		else
		{
			list($table, $field)=explode('.', $field);
			$query = $this->CI->db->limit(1)->get_where($table, array($field => $str));
		}
		return $query->num_rows() == 0;
    }
    
    public function existe_fechanac($str)
    {
    	//formato dd-mm-aaaa
		$fecha_nac = explode('-', $str);
		if ( count($fecha_nac) == 3)
		{
			$fecha_nac = $fecha_nac[2].'-'.$fecha_nac[1].'-'.$fecha_nac[0]; //formato aaaa-mm-dd
			$rut = $this->CI->input->post('rut');
			$rut = formatear_rut($rut);
			if ($this->CI->db->limit(1)->get_where('clte_loc', array('Nacim' => $fecha_nac, 'Rut' => $rut))->num_rows() > 0) return true;
			else return false;
		}
		else return false;		
	}
	
	function validate_date($date)
	{
		$format = 'Y-m-d';
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}

	public function reset()
	{
		foreach($_POST as $i => $v)
		{
			unset($_POST[$i]);
		}		
		unset($this->_field_data);
	}
	
}
