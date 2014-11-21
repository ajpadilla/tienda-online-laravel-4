<?php 
	return array(
		"create" => "crear/clasificado",
		"store" => "agregar/clasificado",
		"index" => "lista/clasificado",
		"show"=>"ver_clasificado/{id}",
		"edit"=>"editar_clasificado/{id}",
		"update"=>"actualizar_clasificado/{id}",
		"destroy"=>"eliminar_clasificado/{id}",
		"title" => "Agregar Tipo de clasificado",
		"subtitle" => "Crear clasificado",
		"labels" => array(
			'name' =>'Nombre:',
			'description' => 'Descripción',
			'price' => 'Precio',
			'language' => 'Idioma',
			'add_photos' => 'Agregar foto',
			'user' => 'Usuario',
			'classified_type' => 'Tipo de clasificado',
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
