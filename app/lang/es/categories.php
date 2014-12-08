<?php 
return array(
	"create" => "crear/categoria",
	"store" => "agregar/categoria",
	"index" => "lista/categoria",
	"show"=>"ver/categoria/{id}",
	"edit"=>"editar/categoria/{id}",
	"update"=>"actualizar/categoria/{id}",
	"destroy"=>"eliminar/categoria/{id}",
	"title" => "Agregar Tipo de categoria",
	"subtitle" => "Crear categoria",
	"sending" => "Agregando categoria",
	"response" => "categoria agregada",
	"Actualiced" => "categoria actualizada",
	"Delete" => "¡categoria eliminada con exito!",

	"labels" => array(
		'Categoria_padre'=> 'Categoria padre:',
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