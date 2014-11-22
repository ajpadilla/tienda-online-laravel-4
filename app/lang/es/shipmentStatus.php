<?php 
	return array(
		"create" => "crear/estatus/envio",
		"store" => "agregar/estatus/envio",
		"index"=>'lista/estatus/envio',
		"show"=>"ver/estatus/envio/{id}",
		"edit"=>"editar/estatus/envio/{id}",
		"update"=>"actualizar/estatus/envio/{id}",
		"destroy"=>"eliminar/estatus/envio/{id}",
		"title" => "Agregar estatus de envío",
		"subtitle" => "Crear estatus de envío",
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
		'message1' =>'Estatus',
		'message2' =>'Agregado con exito!.',
		'alert' => '¡El nombre del estatus ya se encuentra registrado!',
		'alertColor' => '¡El color ya se encuentra registrado!.',
		'list' =>array(
			'title' => 'Listado de estatus',
			'subtitle'=>'Lista de estatus',
			'Color' => 'Color',
			'Name'=>'Nombre',
			'Description' => 'Descripción',
			'Actions'=>'Acciones',
		),
	);