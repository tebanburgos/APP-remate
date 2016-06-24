<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo');

$config = array(
	/* Inicio reglas para controlador usuario */
	/* configuración creada para validar (y castear) el usuario. Ojo con las variales, si bien algunas no se pueden ocupar hay que tener consideración qué parametrizan  */
	
	'entrar' => array(
		array('field' => 'admin', 'label' => 'Administrador', 'rules' => 'required|valid_email|strtolower'),
		array('field' => 'clave', 'label' => 'Contraseña', 'rules' => 'required')
	),	
	'ingresar_usuario' => array(
		array('field' => 'nombres', 'label' => 'Nombre', 'rules' => 'required|mb_strtoupper|min_length[3]'),
		array('field' => 'apellido_paterno', 'label' => 'Apellido Paterno', 'rules' => 'required|mb_strtoupper|min_length[3]'),
		array('field' => 'apellido_materno', 'label' => 'Apellido Materno', 'rules' => 'mb_strtoupper'),
		array('field' => 'email', 'label' => 'Email', 'rules' => 'required|strtolower|valid_email|is_unique[usuarios.email]'),
		array('field' => 'telefono', 'label' => 'Teléfono', 'rules' => 'max_length[100]'),
		array('field' => 'celular', 'label' => 'Celular', 'rules' => 'max_length[100]'),
		array('field' => 'clave', 'label' => 'Contraseña', 'rules' => 'required|min_length[6]|max_length[12]'),
		array('field' => 'activo_admin', 'label' => 'Activado', 'rules' => ''),
		array('field' => 'repetir_clave', 'label' => 'Confirmar Contraseña', 'rules' => 'required|matches[clave]'),
		array('field' => 'permiso', 'label' => 'Privilegio del Usuario', 'rules' => 'required'),
		array('field' => 'empresa', 'label' => 'Empresa', 'rules' => 'max_length[255]'),
		array('field' => 'rol', 'label' => 'Rol del Usuario', 'rules' => 'required|max_length[255]|min_length[2]')
	),
	'editar_usuario' => array(
		array('field' => 'nombres', 'label' => 'Nombre', 'rules' => 'required|mb_strtoupper|min_length[3]'),
		array('field' => 'apellido_paterno', 'label' => 'Apellido Paterno', 'rules' => 'required|mb_strtoupper|min_length[3]'),
		array('field' => 'apellido_materno', 'label' => 'Apellido Materno', 'rules' => 'mb_strtoupper'),		
		array('field' => 'email', 'label' => 'Email', 'rules' => 'required|strtolower|valid_email'),
		array('field' => 'telefono', 'label' => 'Teléfono', 'rules' => ''),
		array('field' => 'celular', 'label' => 'Celular', 'rules' => 'max_length[100]'),	
		array('field' => 'activo_admin', 'label' => 'Activado', 'rules' => ''),
		array('field' => 'clave', 'label' => 'Contraseña', 'rules' => 'min_length[6]|max_length[12]'),
		array('field' => 'repetir_clave', 'label' => 'Confirmar Contraseña', 'rules' => 'matches[clave]'),
		array('field' => 'permiso', 'label' => 'Privilegio del Usuario', 'rules' => 'required'),
		array('field' => 'empresa', 'label' => 'Empresa', 'rules' => 'max_length[255]'),
		array('field' => 'rol', 'label' => 'Rol del Usuario', 'rules' => 'required|max_length[255]|min_length[2]')
	),
	'recuperar_clave' => array(
		array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email')
	),
	'cambiar_clave' => array(
		array('field' => 'clave', 'label' => 'Contraseña', 'rules' => 'required|min_length[6]|max_length[12]'),
		array('field' => 'clave_confirmar', 'label' => 'Confirmar Contraseña', 'rules' => 'required|matches[clave]')
	),
	'ingresar_proyecto' => array(
		array('field' => 'proyecto_nombre', 'label' => 'Nombre del Proyecto', 'rules' => 'required|mb_strtoupper|min_length[3]|max_length[300]'),
		array('field' => 'proyecto_tipo', 'label' => 'Tipo de Proyecto', 'rules' => 'required|max_length[60]'),
		array('field' => 'proyecto_cliente', 'label' => 'Cliente', 'rules' => 'required|max_length[255]|min_length[2]|mb_strtoupper'),
		array('field' => 'proyecto_linea', 'label' => 'Línea del Proyecto', 'rules' => 'max_length[60]'),
		array('field' => 'proyecto_area', 'label' => 'Área del Proyecto', 'rules' => 'max_length[200]'),
	),
	'editar_proyecto' => array(
		array('field' => 'proyecto_nombre', 'label' => 'Nombre del Proyecto', 'rules' => 'required|mb_strtoupper|min_length[3]|max_length[300]'),
		array('field' => 'proyecto_tipo', 'label' => 'Tipo de Proyecto', 'rules' => 'required|max_length[60]'),
		array('field' => 'proyecto_cliente', 'label' => 'Cliente', 'rules' => 'required|max_length[255]|min_length[2]|mb_strtoupper'),
		array('field' => 'proyecto_linea', 'label' => 'Línea del Proyecto', 'rules' => 'max_length[60]'),
		array('field' => 'proyecto_area', 'label' => 'Área del Proyecto', 'rules' => 'max_length[200]'),
	),	
	'ingresar_info_proyecto' => array(
		array('field' => 'ejecutivo_servicios_id', 'label' => 'Ejecutivo de Servicios', 'rules' => 'numeric'),
		array('field' => 'ejecutivo_negocios_id', 'label' => 'Ejecutivo de Negocios', 'rules' => 'numeric'),
		array('field' => 'proyecto_ft_proyectada', 'label' => 'Fecha de término proyectada', 'rules' => 'validate_date'),
		array('field' => 'proyecto_ft_real', 'label' => 'Fecha de término real', 'rules' => 'validate_date'),
		array('field' => 'proyecto_costo_real', 'label' => 'Costo real', 'rules' => 'numeric|max_lenght[14]'),
		array('field' => 'proyecto_costo_proyectado', 'label' => 'Costo proyectado', 'rules' => 'numeric|max_lenght[14]'),
		array('field' => 'proyecto_ingreso_proyectado', 'label' => 'Ingreso proyectado', 'rules' => 'numeric|max_lenght[14]'),
		array('field' => 'proyecto_costo_proyectado', 'label' => 'Costo proyectado', 'rules' => 'numeric|max_lenght[14]')		
	),
	'subir_adjunto' => array(
		array('field' => 'titulo', 'label' => 'Se requiere indicar el título del archivo', 'rules' => 'required|max_lenght[255]')
	),
	'ingresar_categoria' => array(
		array('field' => 'categoria_nombre', 'label' => 'Categoría', 'rules' => 'required|max_length[255]')
	),
	'editar_categoria' => array(
		array('field' => 'categoria_nombre', 'label' => 'Categoría', 'rules' => 'required|max_length[255]')
	),
	'ingresar_etapa' => array(
		array('field' => 'etapa_nombre', 'label' => 'Nombre de Etapa', 'rules' => 'required|max_length[120]|mb_strtoupper'),
		array('field' => 'etapa_requerido', 'label' => 'Campos requeridos al finalizar', 'rules' => ''),
		array('field' => 'etapa_orden', 'label' => 'Orden de secuencia', 'rules' => 'required|numeric|max_length[2]')	
	),
	'editar_etapa' => array(
		array('field' => 'etapa_nombre', 'label' => 'Nombre de Etapa', 'rules' => 'required|max_length[120]|mb_strtoupper'),
		array('field' => 'etapa_requerido', 'label' => 'Campos requeridos al finalizar', 'rules' => ''),
		array('field' => 'etapa_orden', 'label' => 'Orden de secuencia', 'rules' => 'required|numeric|max_length[2]')	
	),
	'ingresar_tarea' => array(
		array('field' => 'tarea_nombre', 'label' => 'Nombre de la tarea', 'rules' => 'required|max_length[120]|mb_strtoupper'),
		array('field' => 'tarea_orden', 'label' => '', 'Orden de secuencia' => 'required|numeric|max_length[2]'),
		array('field' => 'tarea_rol', 'label' => '', 'ROL de usuario asignado' => 'required|exact_length[2]'),
	),		
	'editar_tarea' => array(
		array('field' => 'tarea_nombre', 'label' => 'Nombre de la tarea', 'rules' => 'required|max_length[120]|mb_strtoupper'),
		array('field' => 'tarea_orden', 'label' => '', 'Orden de secuencia' => 'required|numeric|max_length[2]'),
		array('field' => 'tarea_rol', 'label' => '', 'ROL de usuario asignado' => 'required|exact_length[2]'),
	),			
);