<?php
	return array(
		"create" => "crear/descuento",
		"store" => "agregar/descuento",
 		"createCode" =>"crear/codigo_descuento", 
 		"storeCode" => "agregar/codigo_descuento",
		"index"=>'lista/descuentos',
		"createData" =>"agregar/datos_idioma",
		"saveData" =>'agregar/caracteristicas_descuento',
		"show"=>"ver/{id}",
		"edit"=>"editar/{id}",
		"update"=>"Actualizar/{id}",
		"destroy"=>"Eliminar/{id}",
		"title" => "Agregar descuento",
		"subtitle" => "Crear nuevo descuento",
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
			'No' => 'No'
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
		'message1' =>'Descuento',
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
		),
	);
 