<?php
	return array(
		"create" => "crear/lenguaje",
		"store" => "agregar/lenguaje",
		'index'=>'lista/lenguajes',
		"title" => "Agregar lenguaje",
		"subtitle" => "Crear nuevo lenguaje",
		"labels" => array(
			'name' =>'Nombre:',
			'native_name' => 'Nombre natal:',
			'iso_code' => 'Código iso:',
			'language_code' => 'Código del idioma:',
			'date_format' => 'Formato de fecha:',
			'save' => 'Agregar',
		),
		"validation" => array(
			'required' => 'Campo obligatorio.',
			'rangelength' => 'Por favor, introduzca un valor entre ',
			'characters' => 'caracteres.',
			'number' => 'Por favor, introduzca un número válido.',
			'digits' => 'Por favor, ingrese sólo dígitos enteros.',
			'date' => 'Por favor, Ingrese una fecha valida.',
			'onlyLettersNumbersAndSpaces' => 'Ingrese solo letras, numeros y/o espacios en blanco.',
			'onlyLettersNumbersAndDash' => 'Ingrese solo letras, numeros y/o guiones.',
			'max' => 'Dede ingresar maximo ',
			'min' => 'Debe ingresar minimo ',
			'onlyLetters' => 'Ingrese solo letras por favor!.'
		),
		'date' => 'dd-mm-yy',
		'message1' =>'lenguaje',
		'message2' =>'Agregado con exito!.',
		'alert' => '¡El codigo del lenguaje ya se encuentra registrado!',
		'list' =>array(
			'title' => 'Listado de lenguajes',
			'subtitle'=>'Lista de lenguajes',
			'Code'=>'Código',
			'Discount_type'=>'Tipo de lenguaje',
			'Name'=>'',
			'Value'=>'',
			'Percent'=>'',
			'Active'=>'',
			'From'=>'',
			'To'=>'',
			'Actions'=>'',
			''=>'',
			''=>''
		),
	);
 