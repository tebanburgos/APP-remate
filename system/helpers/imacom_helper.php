<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function mostrar_mensaje($mensaje=NULL, $mensaje_clase='alert alert-info')
	{
		if ( ! empty($mensaje)) echo '<div class="'.$mensaje_clase.'">'.$mensaje.'</div>';
	}
	function limpiar_rut($rut)
	{
		return strtoupper(preg_replace('/\.*,*\-*/', '', $rut));
	}
	function formatear_rut($rut)
	{
		$rut = preg_replace('/\.*,*\-*/', '', $rut);
		$digito = substr($rut, -1);
		$largo = strlen($rut) - 1;
		$rut = number_format(substr($rut, 0, $largo), 0, ',', '.');
		return $rut.'-'.$digito;
	}
	function formatear_fecha($fecha)
	{
		// DateTime::CreateFromFormat no disponible en PHP < 5.3
		// $fecha = DateTime::CreateFromFormat('Y-m-d', $fecha);
		$fecha = date_create_from_format('Y-m-d', $fecha);
		return $fecha->format('d-m-Y');
	}
	function formatear_fecha_hora($fecha)
	{
		// DateTime::CreateFromFormat no disponible en PHP < 5.3
		// $fecha = DateTime::CreateFromFormat('Y-m-d', $fecha);
		$fecha = @crear_fecha('Y-m-d H:i', $fecha);
		return $fecha->format('d-m-Y H:i');
	}
	function formatear_numero($numero)
	{
		return number_format($numero, 0, ',', '.');
	}
	function recursive_array_search($needle,$haystack) {
	    foreach($haystack as $key=>$value) {
	        $current_key=$key;
	        if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
	            return (int)$current_key;
	        }
	    }
	    return false;
	}
	function recursive_keys($input, $search_value = null){ 
        $output = ($search_value !== null ? array_keys($input, $search_value) : array_keys($input)) ; 
        foreach($input as $sub){ 
            if(is_array($sub)){ 
                $output = ($search_value !== null ? array_merge($output, recursive_keys($sub, $search_value)) : array_merge($output, recursive_keys($sub))) ; 
            } 
        } 
        return $output ; 
    }

	if ( ! function_exists('strptime'))
	{
		function strptime($date, $format) { 
		    $masks = array( 
		      '%d' => '(?P<d>[0-9]{2})', 
		      '%m' => '(?P<m>[0-9]{2})', 
		      '%Y' => '(?P<Y>[0-9]{4})', 
		      '%H' => '(?P<H>[0-9]{2})', 
		      '%M' => '(?P<M>[0-9]{2})', 
		      '%S' => '(?P<S>[0-9]{2})', 
		     // usw.. 
		    ); 

		    $rexep = "#".strtr(preg_quote($format), $masks)."#"; 
		    if(!preg_match($rexep, $date, $out)) 
		      return false; 

		    $ret = array( 
		      "tm_sec"  => (int) $out['S'], 
		      "tm_min"  => (int) $out['M'], 
		      "tm_hour" => (int) $out['H'], 
		      "tm_mday" => (int) $out['d'], 
		      "tm_mon"  => $out['m']?$out['m']-1:0, 
		      "tm_year" => $out['Y'] > 1900 ? $out['Y'] - 1900 : 0, 
		    ); 
		    return $ret; 
		  } 		
	}


	function crear_fecha( $dformat, $dvalue )
	{
	    $schedule = $dvalue;
	    $schedule_format = str_replace(array('Y','m','d', 'H', 'i','a'),array('%Y','%m','%d', '%H', '%M', '%p' ) ,$dformat);
	    // %Y, %m and %d correspond to date()'s Y m and d.
	    // %I corresponds to H, %M to i and %p to a
	    $ugly = strptime($schedule, $schedule_format);
	    $ymd = sprintf(
	        // This is a format string that takes six total decimal
	        // arguments, then left-pads them with zeros to either
	        // 4 or 2 characters, as needed
	        '%04d-%02d-%02d %02d:%02d:%02d',
	        $ugly['tm_year'] + 1900,  // This will be "111", so we need to add 1900.
	        $ugly['tm_mon'] + 1,      // This will be the month minus one, so we add one.
	        $ugly['tm_mday'], 
	        $ugly['tm_hour'], 
	        $ugly['tm_min'], 
	        $ugly['tm_sec']
	    );
	    $new_schedule = new DateTime($ymd);
		return $new_schedule;
	}
	
	function download($url) {
	    set_time_limit(0);
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	    $r = curl_exec($ch);
	    curl_close($ch);
	    header('Expires: 0'); // no cache
	    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
	    header('Cache-Control: private', false);
	    header('Content-Type: application/force-download');
	    header('Content-Disposition: attachment; filename="' . basename($url) . '"');
	    header('Content-Transfer-Encoding: binary');
	    header('Content-Length: ' . strlen($r)); // provide file size
	    header('Connection: close');
	    echo $r;
	}