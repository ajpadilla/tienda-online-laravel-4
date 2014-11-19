<?php 
	return array(
		"create" => "crear/estatus_factura",
		"store" => "agregar/estatus_factura",
		"index"=>'lista/estatus_factura',
		"show"=>"ver_estatus_factura/{id}",
		"edit"=>"editar_estatus_factura/{id}",
		"update"=>"actualizar_estatus_factura/{id}",
		"destroy"=>"eliminar_estatus_factura/{id}",
		"title" => "Agregar estatus para factura",
		"subtitle" => "Crear estatus para factura",
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
		'message1' =>'Estatus para factura',
		'message2' =>'Agregada con exito!.',
		'alert' => '¡El nombre del estatus para la factura ya se encuentra registrado!',
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