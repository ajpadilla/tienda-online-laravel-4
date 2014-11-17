<?php 
	return array(
		"create" => "crear/factura_de_envio",
		"store" => "agregar/factura_de_envio",
		"index"=>'lista/factura_de_envio',
		"show"=>"ver_factura_de_envio/{id}",
		"edit"=>"editar_factura_de_envio/{id}",
		"update"=>"actualizar_factura_de_envio/{id}",
		"destroy"=>"eliminar_factura_de_envio/{id}",
		"title" => "Agregar factura de envío",
		"subtitle" => "Crear factura de envío",
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
		'message1' =>'Factura',
		'message2' =>'Agregado con exito!.',
		'alert' => '¡El nombre del factura ya se encuentra registrado!',
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