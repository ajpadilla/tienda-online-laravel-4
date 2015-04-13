<?php 
	return array(
		
		"routes" => array(
			"create" => "fotos-productos/crear/{productoId}",
			"store" => "fotos-productos/agregar",
		),

		"title" => "Agregar foto a producto",
		"subtitle" => "Añadir foto a producto",
		"create-title"=> "Agregar foto",

		"labels" => array(
			'add' => 'Agregar foto...',
			'init' => 'Iniciar',
			'cancel' => 'Cancelar',
			'delete' => 'Eliminar'
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
