<?php 
	return array(
		"create" => "create/condition/classified",
		"store" => "add/condition/classified",
		"index" => "list/condition/classifieds",
		"show"=>"show/condition/classified/{id}",
		"edit"=>"edit/condition/classified/{id}",
		"update"=>"update/condition/classified/{id}",
		"destroy"=>"delete/condition/classified/{id}",
		"title" => "Agregar Condición para classifieds",
		"subtitle" => "Crear Condición para clasificados",
		"labels" => array(
			'name' =>'Nombre:',
			'language' => 'Idioma',
			'save' => 'Agregar',
		),
		"list" => array(
			'title' => 'Lista para condición para clasificados',
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
		'message1' =>'Nuevo Condición para clasificados',
		'message2' =>'Agregado con exito!.',
		'alert' => '¡El nombre ya se encuentra registrado!'
	);
