<?php 
	return array(
		"routes" => array(
			"create" => "tipos-de-clasificados/crear",
			"store" => "tipos-de-clasificados/agregar",
			"show"=> "tipos-de-clasificados/ver/{id}",
			"edit"=> "tipos-de-clasificados/editar/{id}",
			"update"=> "tipos-de-clasificados/actualizar/{id}",
			"destroy"=> "tipos-de-clasificados/eliminar/{id}",
			"index" => "tipos-de-clasificados/lista", 
			"api" => array(
				"list" => "tipos-de-clasificados/api/lista-tipos-de-clasificados",
				"show" => "tipos-de-clasificados/api/ver",
				"update" => "tipos-de-clasificados/api/actualizar",
				"saveLang" => "tipos-de-clasificados/api/actualizar-idioma"
			)
		),
		"title" => "Agregar Tipo de clasificado",
		"subtitle" => "Crear nuevo tipo de clasificado",
		"sending" => "Agregando tipo de clasificado",
		"response" => "Tipo de clasificado agregado",
		"Updated" => "Tipo de clasificado actualizado",
		"Delete" => "¡Tipo de clasificado eliminado con exito!",
		"create-title"=> "Crear tipo de clasificado",
		"index-title" => "Lista de tipos de clasificados",
		"show-title" => "Ver clasificado",
		'current-lang' =>'datos-lenguaje-tipo-clasificado',
		'all-conditions' => 'Todos', 
		"labels" => array(
			'name' =>'Nombre:',
			'description' => 'descripción',
			'color' => 'color',
			'language' => 'Idioma',
			'save' => 'Agregar',
		),
		"list" => array(
			'title' => 'Lista para los tipo de clasificado',
			'Name' => 'Nombre',
			'Actions' =>'Acciones',
			'new' => 'Nuevo'
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

		'message1' =>'Nuevo tipo de clasificado',
		'message2' =>'Agregado con exito!.',
		'alert' => '¡El nombre ya se encuentra registrado!',

		'edit_view' => array(
			'title' => 'Editar tipo de clasificado',
			'subtitle' => 'Datos del tipo de clasificado'
		),

		'show_data' => array(
			'title' => 'Ver datos del tipo de clasificado',
			'subtitle' => 'Tipo de clasificado'
		),

		'actions' => array(
			'Show' => 'Ver   ',
			'Edit' => 'Editar',
			'Delete' => 'Eliminar'
		)
	);
