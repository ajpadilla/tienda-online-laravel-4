<?php
	return array(
		"create" => "crear/producto",
		"store" => "agregar/producto",
		'index'=>'lista/productos',
		'edit' => 'editar/producto/{id}',
		"title" => "Agregar producto",
		"subtitle" => "Crear nuevo producto",
		"labels" => array(
			'name' =>'Nombre:',
			'description' => 'Descripción:',
			'on_sale' => 'a la venta: :',
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
			'condition' => 'Condición:'
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
		'list' =>array(
				'photo'		=> 'Foto',
				'name'		=> 'Nombre',
				'price'		=> 'Precio',
				'quantity'	=> 'Cantidad',
				'active'		=> 'Activo',
				'accept'		=> 'Acepta trueque',
				'category'	=> 'Categorias',
				'ratings'	=> 'Ratings',
				'actions'	=> 'Acciones',
				'title'		=> 'Lista de productos'
		),
	);

