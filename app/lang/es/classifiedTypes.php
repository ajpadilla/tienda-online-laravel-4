<?php 
	return array(
		"create" => "crear/tipo/clasificado",
		"store" => "agregar/tipo/clasificado",
		"index" => "lista/tipo/clasificado",
		"show"=>"ver/tipo/clasificado/{id}",
		"edit"=>"editar/tipo/clasificado/{id}",
		"update"=>"actualizar/tipo/clasificado/{id}",
		"destroy"=>"eliminar/tipo/clasificado/{id}",
		"title" => "Agregar Tipo de clasificado",
		"subtitle" => "Crear nuevo  tipo de clasificado",
		"labels" => array(
			'name' =>'Nombre:',
			'description' => 'descripción',
			'color' => 'color',
			'language' => 'Idioma',
			'save' => 'Agregar',
		),
		"list" => array(
			'title' => 'Lista para los tipo de clasificado',
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
		'message1' =>'Nuevo tipo de clasificado',
		'message2' =>'Agregado con exito!.',
		'alert' => '¡El nombre ya se encuentra registrado!',
		'sending' => 'Enviando datos'
	);
