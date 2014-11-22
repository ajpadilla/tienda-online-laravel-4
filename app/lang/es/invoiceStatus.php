<?php 
	return array(
		"create" => "crear/estatus/factura",
		"store" => "agregar/estatus/factura",
		"index"=>'lista/estatus/factura',
		"show"=>"ver/estatus/factura/{id}",
		"edit"=>"editar/estatus/factura/{id}",
		"update"=>"actualizar/estatus/factura/{id}",
		"destroy"=>"eliminar/estatus/factura/{id}",
		"title" => "Agregar estatus para factura",
		"subtitle" => "Crear estatus para factura",
		"labels" => array(
			'language' => 'Idioma',
			'name' =>'Nombre:',
			'description' => 'Descripción:',
			'color' => 'Color',
			'save' => 'Agregar',
			'sending' => 'Enviando datos'
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
			'title' => 'Listado de facturas',
			'subtitle'=>'Lista de facturas',
			'Color' => 'Color',
			'Name'=>'Nombre',
			'Description' => 'Descripción',
			'Actions'=>'Acciones',
		),
	);