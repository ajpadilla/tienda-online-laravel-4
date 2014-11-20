<?php 
	return array(
		"create" => "crear/condicion_de_clasificado",
		"store" => "agregar/condicion_de_clasificado",
		"index" => "lista/condicion_de_clasificados",
		"show"=>"ver_condicion_de_clasificado/{id}",
		"edit"=>"editar_condicion_de_clasificado/{id}",
		"update"=>"actualizar_condicion_de_clasificado/{id}",
		"destroy"=>"eliminar_condicion_de_clasificado/{id}",
		"title" => "Agregar Condición para clasificados",
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
		'alert' => '¡El nombre ya se encuentra registrado!',
		'sending' => 'Enviado datos'
	);
