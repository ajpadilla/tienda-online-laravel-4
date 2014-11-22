<?php 
	return array(
		"create" => "create/classified",
		"store" => "add/classified",
		"index" => "list/classified",
		"show"=>"show/classified/{id}",
		"edit"=>"edit/classified/{id}",
		"update"=>"update/classified/{id}",
		"destroy"=>"delete/classified/{id}",
		"title" => "Agregar Tipo de classified",
		"subtitle" => "Crear classified",
		"labels" => array(
			'name' =>'Nombre:',
			'description' => 'Descripción',
			'price' => 'Precio',
			'language' => 'Idioma',
			'add_photos' => 'Agregar foto',
			'user' => 'Usuario',
			'classified_type' => 'Tipo de classified',
			'classified_condition' => 'Condición del clasificado',
			'address' => 'Dirección',
			'save' => 'Agregar',
			'Yes' => 'Si',
			'No' => 'No',
			'user' => 'Usuario'
		),
		"list" => array(
			'title' => 'Lista de clasificados',
			'Name' => 'Nombre',
			'Description' =>'Descripción',
			'Address' => 'Dirección',
			'User' => 'Usuario',
			'Classifieds_types' => 'Tipo de clasificado',
			'Classified_condition' => 'Condición del clasificado',
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
		'message1' =>'Nuevo clasificado',
		'message2' =>'Agregado con exito!.',
		'alert' => '¡El nombre ya se encuentra registrado!',
		'sending' => 'Enviando datos'
	);
