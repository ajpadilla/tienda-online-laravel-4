<?php
	return array(
		"show" => "ver/producto/{id}",
		"create" => "crear/producto",
		"show" => "ver/producto/{id}",
		"whistlist" => "deseos",
		"store" => "agregar/producto",
		'index'=>'lista/productos',
		'edit' => 'editar/producto/{id}',
		'update' => 'actualizar/producto/{id}',
		'destroy' => 'eliminar/producto/{id}',
		"title" => "Agregar producto",
		"subtitle" => "Crear nuevo producto",
		"sending" => "Agregando producto",
		"response" => "Producto agregado",
		"labels" => array(
			'name' =>'Nombre:',
			'description' => 'Descripción:',
			'on_sale' => 'A la venta: :',
			'quantity' => 'Cantidad:',
			'price' => 'Precio:',
			'width' => 'Ancho:',
			'height' => 'Alto:',
			'depth' => 'Profundidad:',
			'weight' => 'Peso:',
			'active' => 'Activo:',
			'available_for_order' => 'Disponible para la orden:',
			'show_price' => 'Mostrar precio',
			'accept_barter' => 'Aceptar trueque',
			'product_for_barter' => 'Producto para trueque',
			'categories' => 'Categorias:',
			'condition' => 'Condición:',
			'measure' => 'Medida:',
			'height' => 'Altura: ',
			'depth' => 'Profundidad:',
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
		'list' => array(
				'photo'		=> 'Foto',
				'name'		=> 'Nombre',
				'price'		=> 'Precio',
				'quantity'	=> 'Cantidad',
				'active'		=> 'Activo',
				'accept'		=> 'Acepta trueque',
				'category'	=> 'Categorias',
				'ratings'	=> 'Ratings',
				'actions'	=> 'Acciones',
				'title'		=> 'Listado de productos',
				'subtitle' => 'Lista de productos'
		),

		'edit_view' => array(
			'title' => 'Editar Producto',
			'subtitle' => 'Datos del producto'
		),

		'show_data' => array(
			'title' => 'Ver datos del producto',
		),

		'actions' => array(
			'Show' => 'Ver   ',
			'Edit' => 'Editar',
			'Delete' => 'Eliminar'
		)
	);

