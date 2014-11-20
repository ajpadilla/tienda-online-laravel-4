<?php 
	return array(
		"create" => "crear/tipos_de_anuncio",
		"store" => "agregar/tipos_de_anuncio",
		"index" => "lista/tipos_descuentos",
		"show"=>"ver_tipos_de_anuncio/{id}",
		"edit"=>"editar_tipos_de_anuncio/{id}",
		"update"=>"actualizar_tipos_de_anuncio/{id}",
		"destroy"=>"eliminar_tipos_de_anuncio/{id}",
		"title" => "Agregar Tipo de anuncio",
		"subtitle" => "Crear nuevo  tipo de anuncio",
		"labels" => array(
			'name' =>'Nombre:',
			'description' => 'descripción',
			'color' => 'color',
			'language' => 'Idioma',
			'save' => 'Agregar',
		),
		"list" => array(
			'title' => 'Lista para los tipo de anuncio',
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
		'message1' =>'Nuevo tipo de anuncio',
		'message2' =>'Agregado con exito!.',
		'alert' => '¡El nombre ya se encuentra registrado!',
		'sending' => 'Enviando datos'
	);
