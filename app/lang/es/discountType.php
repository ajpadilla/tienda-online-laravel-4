<?php 
	return array(
		"create" => "crear/TypoDescuento",
		"store" => "agregar/TypoDescuento",
		"title" => "Agregar Tipo de descuento",
		"subtitle" => "Crear nuevo  tipo de descuento",
		"labels" => array(
			'name' =>'Nombre:',
			'description' => 'Descripción:',
			'value' => 'Valor:',
			'percent' => 'Porcentaje:',
			'quantity' => 'Cantidad:',
			'quantity_per_user' => 'Cantidad por usuario:',
			'code' => 'Código:',
			'active' => 'Activo:',
			'from' => 'Desde:',
			'to' => 'Hasta',
			'discount_type' => 'Tipo de descuento:',
			'save' => 'Agregar',
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
		'date' => 'dd-mm-yy',
		'message1' =>'Descuento',
		'message2' =>'Agregado con exito!.',
		'alert' => '¡El nombre ya se encuentra registrado!'
	);
