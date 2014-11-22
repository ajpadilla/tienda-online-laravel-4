<?php 
	return array(
		"create" => "crear/tipo/descuento",
		"store" => "agregar/tipo/descuento",
		"index" => "lista/tipos/descuentos",
		"show"=>"ver/tipo/descuento/{id}",
		"edit"=>"editar/tipo/descuento/{id}",
		"update"=>"actualizar/tipo/descuento/{id}",
		"destroy"=>"eliminar/tipo/descuento/{id}",
		"title" => "Agregar Tipo de descuento",
		"subtitle" => "Crear nuevo  tipo de descuento",
		"labels" => array(
			'name' =>'Nombre:',
			'language' => 'Idioma',
			'save' => 'Agregar',
		),
		"list" => array(
			'title' => 'Lista para los tipos de descuento',
			'Name' => 'Nombre',
			'Actions' =>'Acciones'
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
		'alert' => '¡El nombre ya se encuentra registrado!'
	);
