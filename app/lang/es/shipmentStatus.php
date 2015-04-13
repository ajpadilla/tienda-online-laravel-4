<?php 
	return array(
		"routes" => array(
			"create" => "estatus-de-envio/crear",
			"store" => "estatus-de-envio/agreagr",
			"show"=>"estatus-de-envio/ver/{id}",
			"edit"=>"estatus-de-envio/editar/{id}",
			"update"=>"estatus-de-envio/actualizar",
			"destroy"=>"estatus-de-envio/eliminar/{id}",
			"api" => array(
				"delete-ajax" =>"estatus-de-envio/api/borrar",
				"index"=>'estatus-de-envio/api/lista-estatus-de-envio',
				"saveLang" => "actualizar-idioma-estatus-de-envio/api/actualizar-idioma",
			),
		),
		"title" => "Agregar estatus de envío",
		"subtitle" => "Crear estatus de envío",
		"sending" => "Agregando estatus de envio",
		"response" => "Estatus de envio agregando",
		"Updated" => "Estatus de envio actualizado",
		"Delete" => "¡Estatus de envion eliminado con exito!",
		"create-title"=> "Crear estatus de envío",
		"index-title" => "Lista de estatus de envío",
		"show-title" => "Ver estatus de envío",

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

		'message1' =>'Estatus',
		'message2' =>'Agregado con exito!.',
		'alert' => '¡El nombre del estatus ya se encuentra registrado!',
		'alertColor' => '¡El color ya se encuentra registrado!.',

		'list' =>array(
			'title' => 'Listado de estatus',
			'subtitle'=>'Lista de estatus',
			'Color' => 'Color',
			'Name'=>'Nombre',
			'Description' => 'Descripción',
			'Actions'=>'Acciones',
			'title'		=> 'Listado de estatus de envio',
			'subtitle' => 'Lista de estatus de envio',
		),

		'edit_view' => array(
			'title' => 'Editar estatus de envio',
			'subtitle' => 'Detalles del estado de envio'
		),

		'show_data' => array(
			'title' => 'Ver detalles del estado de envio',
			'subtitle' => 'Estatus de envio'
		),

		'actions' => array(
			'Show' => 'Ver',
			'Edit' => 'Editar',
			'Delete' => 'Eliminar'
		)

	);
