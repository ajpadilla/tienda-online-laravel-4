<?php 
	return array(

		"routes" => array(
			"create" => "condiciones-clasificados/crear",
			"store" => "condiciones-clasificados/agregar",
			"show"=>"condiciones-clasificados/ver/{id}",
			"edit"=>"condiciones-clasificados/editar/{id}",
			"update"=>"condiciones-clasificados/actualizar/{id}",
			"destroy"=>"condiciones-clasificados/elimiar/{id}",
			"api" => array(
				"list" => "condiciones-clasificados/api/lista-condiciones-clasificados",
				"update" => "condiciones-clasificados/api/actualizar",
				"show" => "condiciones-clasificados/api/ver",
				"saveLang" => "condiciones-clasificados/api/actualizar-idioma"
			),
		),
		"title" => "Agregar Condición para clasificados",
		"subtitle" => "Crear Condición para clasificados",
		"sending" => "Agregando tipo de clasificado",
		"response" => "Tipo de clasificado agregado",
		"Actualiced" => "Tipo de clasificado actualizado",
		"Delete" => "¡Tipo de clasificado eliminado con exito!",
		"create-title"=> "Crear condición de clasificado",
		"index-title" => "Lista de condición de clasificado",
		"show-title" => "Ver condición de clasificado",
		'current-lang' =>'datos-lenguaje-condicion-clasificado',
		'all-conditions' => 'Todos',
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
		
		'edit_view' => array(
			'title' => 'Editar condicion de clasificado',
			'subtitle' => 'Datos para la condicion de clasificado'
		),

		'show_data' => array(
			'title' => 'Ver datos para la condicion de clasificado',
			'subtitle' => 'Condicion de clasificado'
		),

		'actions' => array(
			'Show' => 'Ver   ',
			'Edit' => 'Editar',
			'Delete' => 'Eliminar'
		)
	);
