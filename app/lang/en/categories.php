<?php 
return array(

	"routes" => array(
		"create" => "categories/create",
		"store" => "categories/store",
		"show"=>"categories/show/{id}",
		"edit"=>"categories/edit/{id}",
		"update"=>"categories/update/{id}",
		"destroy"=>"categories/destroy/{id}",
		"index" => "categories/list-categories",
		"api" => array(
			'update' => 'categories/api/updated',
			"list" => "categories/api/list-categories",
			"delete" =>"categories/api/delete" ,
			"saveLang" => 'categories/api/update-lang'
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
		'Delete' => 'Eliminar',
		'Language' => 'Edit Language'
	)

);