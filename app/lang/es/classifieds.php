<?php 
	return array(
		"create" => "crear/tipo_de_clasificado",
		"store" => "agregar/tipo_de_clasificado",
		"index" => "lista/tipo_de_clasificado",
		"show"=>"ver_tipo_de_clasificado/{id}",
		"edit"=>"editar_tipo_de_clasificado/{id}",
		"update"=>"actualizar_tipo_de_clasificado/{id}",
		"destroy"=>"eliminar_tipo_de_clasificado/{id}",
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
