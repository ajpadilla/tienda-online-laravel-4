<?php 
return array(

	"routes" => array(
		"create" => "categorias-productos/crear",
		"store" => "categorias-productos/agregar",
		"show"=>"categorias-productos/ver/{id}",
		"edit"=>"categorias-productos/editar/{id}",
		"update"=>"categorias-productos/actualizar/{id}",
		"destroy"=>"categorias-productos/eliminar/{id}",
		"api" => array(
			"index" => "categorias-productos/api/lista-categorias-productos",
		),
	),
	"title" => "Agregar categoria",
	"subtitle" => "Crear categoria",
	"sending" => "Agregando categoria",
	"response" => "categoria agregada",
	"Actualiced" => "categoria actualizada",
	"Delete" => "¡categoria eliminada con exito!",
	"create-title"=> "Crear categoria",
	"index-title" => "Lista de categorias",
	"show-title" => "Ver categoria",	


	"labels" => array(
		'language' => 'Idioma',
		'parent_category'=> 'Categoria padre:',
		'name' =>'Nombre:',
		'save' => 'Agregar',
		'new' => 'Nuevo'
	),

	"list" => array(
		'title' => 'Lista de categorias',
		'subtitle' => 'Listado de categorias',
		'Name' => 'Nombre',
		'parent_category' => 'Categoria padre',
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

	'alert' => '¡El nombre ya se encuentra registrado!',

	'edit_view' => array(
		'title' => 'Editar categoria',
		'subtitle' => 'Datos categoria'
	),

	'show_data' => array(
		'title' => 'Ver datos de la categoria',
		'subtitle' => 'Datos de la Categoria'
	),

	'actions' => array(
		'Show' => 'Ver   ',
		'Edit' => 'Editar',
		'Delete' => 'Eliminar'
	)

);