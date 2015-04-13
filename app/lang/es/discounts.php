<?php
	return array(

		"routes" => array(
			"create" => "descuentos/crear",
			"store" => "descuentos/agregar",
			"show"=>"descuentos/ver/{id}",
			"edit"=>"descuentos/editar/{id}",
			"update"=>"descuentos/actualizar/{id}",
			"destroy"=>"descuentos/eliminar/{id}",
			"api" => array(
				"index"=>'descuentos/api/lista-descuentos',
			),
		),
		"title" => "Agregar descuento",
		"subtitle" => "Crear nuevo descuento",
		"sending" => "Agregando descuento",
		"response" => "Descuento agregado",
		"Updated" => "Descuento actualizado",
		"Delete" => "¡Descuento eliminado con éxito!",
		"create-title"=> "Crear descuento",
		"index-title" => "Lista de descuentos",
		"show-title" => "Ver descuento",
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
			'Yes' => 'Si',
			'No' => 'No',
			'language' => 'Idioma:',
			'new' => 'Nuevo'		
		),
		"validation" => array(
			'required' => 'Campo obligatorio.',
			'rangelength' => 'Por favor, introduzca un valor entre ',
			'characters' => 'caracteres.',
			'number' => 'Por favor, introduzca un número válido.',
			'digits' => 'Por favor, ingrese sólo dígitos enteros.',
			'date' => 'Por favor, Ingrese una fecha valida.',
			'onlyLettersNumbersAndSpaces' => 'Ingrese solo letras, numeros y/o espacios en blanco',
			'onlyLettersNumbersAndDash' => 'Ingrese solo letras, numeros y/o guiones.'
		),

		'date' => 'dd-mm-yy',
		'date2' => 'd-m-Y',
		'message1' =>'descuento',
		'message2' =>'Agregado con exito!.',
		'alert' => '¡El codigo del descuento ya se encuentra registrado!',

		'list' =>array(
			'title' => 'Listado de descuentos',
			'subtitle'=>'Lista de descuentos',
			'Code'=>'Codigo',
			'Discount_type'=>'Tipo de descuento',
			'Name'=>'Nombre',
			'Value'=>'Monto',
			'Percent'=>'Porcentaje',
			'Active'=>'Activo',
			'From'=>'Desde',
			'To'=>'Hasta',
			'Actions'=>'Acciones',
			'title'		=> 'Listado de descuentos',
			'subtitle' => 'Lista de descuentos'
		),

		'edit_view' => array(
			'title' => 'Editar descuento',
			'subtitle' => 'Datos del descuento'
		),

		'show_data' => array(
			'title' => 'Ver datos del descuento',
			'subtitle' => 'Datos del descuento'
		),

		'actions' => array(
			'Show' => 'Ver   ',
			'Edit' => 'Editar',
			'Delete' => 'Eliminar'
		),

		"active" => array(
			"Yes" => "Si",
			"No" => "No"
		)
	);

