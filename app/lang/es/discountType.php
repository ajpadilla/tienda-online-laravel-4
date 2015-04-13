<?php 
	return array(

		"routes" => array(
			"create" => "tipos-de-descuentos/crear",
			"store" => "tipos-de-descuentos/agregar",
			"show"=>"tipos-de-descuentos/ver/{id}",
			"edit"=>"tipos-de-descuentos/editar/{id}",
			"update"=>"tipos-de-descuentos/actualizar/{id}",
			"destroy"=>"tipos-de-descuentos/eliminar/{id}",
			"api" => array(
				"index" => "tipos-de-descuentos/api/lista-tipos-descuentos",
			),
		),
		"title" => "Agregar Tipo de descuento",
		"subtitle" => "Crear nuevo  tipo de descuento",
		"sending" => "Agregando tipo de descuento",
		"response" => "Tipo de descuento agregado",
		"Updated" => "Tipo de descuento actualizado",
		"Delete" => "¡Tipo de descuento eliminado con éxito!",
		"create-title"=> "Crear tipo de descuento",
		"index-title" => "Lista de tipos de descuentos",
		"show-title" => "Ver tipo de descuento",

		"labels" => array(
			'name' =>'Nombre:',
			'language' => 'Idioma',
			'save' => 'Agregar',
			'new' => 'Nuevo'
		),

		"list" => array(
			'title' => 'Lista para los tipos de descuento',
			'Name' => 'Nombre',
			'Actions' =>'Acciones',
			'title'		=> 'Listado de descuentos',
			'subtitle' => 'Lista de descuentos',
		),

		"validation" => array(
			'required' => 'Campo obligatorio.',
			'rangelength' => 'Por favor, introduzca un valor entre ',
			'characters' => 'caracteres.',
			'number' => 'Por favor, introduzca un número válido.',
			'digits' => 'Por favor, ingrese sólo dígitos enteros.',
			'date' => 'Por favor, Ingrese una fecha valida.',
			'onlyLettersNumbersAndSpaces' => 'Ingrese solo letras, numeros y espacios en blanco',
			'onlyLettersNumbersAndDash' => 'Ingrese solo letras, numeros y/o guiones.'
		),

		'message1' =>'Nuevo tipo de descuento',
		'message2' =>'Agregado con exito!.',
		'alert' => '¡El nombre ya se encuentra registrado!',

		'edit_view' => array(
			'title' => 'Editar typo de descuento',
			'subtitle' => 'Datos del tipo de descuento'
		),

		'show_data' => array(
			'title' => 'Ver detalles del tipo de descuento',
			'subtitle' => 'Tipo de descuento'
		),

		'actions' => array(
			'Show' => 'Ver   ',
			'Edit' => 'Editar',
			'Delete' => 'Borar'
		)
	);
