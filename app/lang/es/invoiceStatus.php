<?php 
	return array(

		"routes" => array(
			"create" => "estatus-de-factura/crear",
			"store" => "estatus-de-factura/agregar",
			"show"=>"estatus-de-factura/ver/{id}",
			"edit"=>"estatus-de-factura/editar/{id}",
			"update"=>"estatus-de-factura/actualizar",
			"destroy"=>"estatus-de-factura/eliminar/{id}",
			"api" => array(
				"index"=>'estatus-de-factura/api/lista-estatus-de-factura',
				"delete-ajax" =>"estatus-de-factura/api/borrar",
				"saveLang" => "actualizar-idioma-estatus-factura/api/idioma-estatus-factura",
			),
		),
		"title" => "Agregar estatus para factura",
		"subtitle" => "Crear estatus para factura",
		"sending" => "Agregando estatus para factura",
		"response" => "Estatus para factura agregado",
		"Updated" => "Estatus para factura actualizado",
		"Delete" => "¡Estatus para factura eliminado con exito!",
		"create-title"=> "Crear estatus de factura",
		"index-title" => "Lista de estatus de factura",
		"show-title" => "Ver estatus de factura",

		"labels" => array(
			'language' => 'Idioma',
			'name' =>'Nombre:',
			'description' => 'Descripción:',
			'color' => 'Color',
			'save' => 'Agregar',
			'sending' => 'Enviando datos',
			'new' => 'Nuevo'
		),

		"validation" => array(
			'required' => 'Campo obligatorio.',
			'rangelength' => 'Por favor, introduzca un valor entre ',
			'characters' => 'caracteres.',
			'number' => 'Por favor, introduzca un número válido.',
			'digits' => 'Por favor, ingrese sólo dígitos enteros.',
			'onlyLettersNumbersAndSpaces' => 'Ingrese solo letras, numeros y/o espacios en blanco',
			'onlyLettersNumbersAndDash' => 'Ingrese solo letras, numeros y/o guiones.'
		),

		'message1' =>'Estatus para factura',
		'message2' =>'Agregada con exito!.',
		'alert' => '¡El nombre del estatus para la factura ya se encuentra registrado!',
		'alertColor' => '¡El color ya se encuentra registrado!.',

		'list' =>array(
			'title' => 'Listado de estatus para factura',
			'subtitle'=>'Lista de estatus para factura',
			'Color' => 'Color',
			'Name'=>'Nombre',
			'Description' => 'Descripción',
			'Actions'=>'Acciones',
		),

		'edit_view' => array(
			'title' => 'Editar Estatus para factura',
			'subtitle' => 'Datos del estatus para factura'
		),

		'show_data' => array(
			'title' => 'Ver datos del estatus para factura',
			'subtitle' => 'Estatus para factura'
		),

		'actions' => array(
			'Show' => 'Ver   ',
			'Edit' => 'Editar',
			'Delete' => 'Eliminar'
		)
	);