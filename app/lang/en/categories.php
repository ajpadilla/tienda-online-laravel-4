<?php 
return array(

	"routes" => array(
		"create" => "categories-products/create",
		"store" => "categories-products/store",
		"show"=>"categories-products/show/{id}",
		"edit"=>"categories-products/edit/{id}",
		"update"=>"categories-products/update/{id}",
		"destroy"=>"categories-products/destroy/{id}",
		"api" => array(
			"index" => "categories-products/api/list-categories-products",
		),
	),
	"title" => "Add category",
	"subtitle" => "Create category",
	"sending" => "Adding category",
	"response" => "aggregate category",
	"Actualiced" => "category updated",
	"Delete" => "¡Category deleted successfully!",
	"create-title"=> "Create category",
	"index-title" => "List of category",
	"show-title" => "Show category",

	"labels" => array(
		'language' => 'Language',
		'parent_category'=> 'Categoria padre:',
		'name' =>'Nombre:',
		'save' => 'Agregar',
		'new' => 'Nuevo'
	),

	"list" => array(
		'title' => 'Lista de categorias',
		'subtitle' => 'Listado de categorias',
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

	'alert' => '¡El nombre ya se encuentra registrado!',

	'edit_view' => array(
		'title' => 'Editar tipo de categoria',
		'subtitle' => 'Datos del tipo de categoria'
	),

	'show_data' => array(
		'title' => 'Ver datos del tipo de categoria',
		'subtitle' => 'Tipo de categoria'
	),

	'actions' => array(
		'Show' => 'Ver   ',
		'Edit' => 'Editar',
		'Delete' => 'Eliminar'
	)

);