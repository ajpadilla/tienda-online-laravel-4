<?php
	return array(


		"index-title" => "Lista de productos",
		"create-title" => "Creatar Producto",
		"title" => "Agregar producto",
		"subtitle" => "Crear nuevo producto",
		"sending" => "Agregando producto",
		"response" => "Producto agregado",
		"Updated" => "Producto actualizado",
		"Delete" => "¡Producto eliminado con éxito!",
		"saveLang" => 'Añadir idioma al producto',
		"show-title" => "Ver producto",
		"search-title" => "Buscar",
		"routes" => array(
			"show" => "ver/product/{id}",
			"create" => "crear/producto",
			"store" => "Agregar/producto",
			'index'=>'lista-de-productos',
			'edit' => 'editar/producto/{id}',
			'update' => 'actualizar/producto',
			'destroy' => 'eliminar/producto/{id}',
			"search" => "buscar/producto",
			"order-by-search" => "ordenar-resultados-busqueda",
			"filterWord" => "palabra-a-filtrar",
			"api" => array(
				"delete-ajax" =>"productos/api/eliminar" 
			),
		),

		"labels" => array(
			'name' =>'Nombre',
			'description' => 'Descripción',
			'on_sale' => 'En venta:',
			'quantity' => 'Cantidad:',
			'price' => 'Precio:',
			'width' => 'Ancho:',
			'height' => 'Alto:',
			'depth' => 'Profundidad:',
			'weight' => 'Peso:',
			'active' => 'Activo:',
			'available_for_order' => 'Disponible para la orden:',
			'accept_barter' => 'Trueque:',
			'categories' => 'Categorias:',
			'condition' => 'Condición:',
			'point_price' => 'Precio en puntos:',
			'height' => 'Altura: ',
			'depth' => 'Profundidad:',
			'language' => 'Idioma:',
			'add_photos' => 'Agregar foto',
			'new' => 'Nuevo',
			'measure' => 'Medida',
			'show_price' => 'Mostrar precio',
			'product_for_barter' => 'Cambiar',
			'save' => 'Guardar',
			'image' => 'No se han encontrado imágenes',
			'Image' => 'Imagen',
			'Stock' => 'Almacen',
			'UnitPrice' => 'Precio',
			'MyWishList' => 'Mi Lista de Deseos' ,
			'NewProducts' => 'Nuevos Productos',
			'TopProducts' => 'Top de Productos',
			'search' => 'Buscar'
		),

		"validation" => array(
			'required' => 'Campo obligatorio.',
			'rangelength' => 'Por favor, introduzca un valor entre ',
			'characters' => 'caracteres.',
			'number' => 'Por favor, introduzca un número válido.',
			'digits' => 'Por favor, ingrese sólo dígitos enteros.',
			'date' => 'Por favor, Ingrese una fecha valida.',
			'maxlength' => 'Por favor ingrese maximo ',
			'length' => ' digitos enteros',
			'maxlengthDecimal'=>' y maximo ',
			'decimal' => ' digitos decimales',
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
				'subtitle' => 'Lista de productos',

		),

		'edit_view' => array(
			'title' => 'Editar Producto',
			'subtitle' => 'Datos del producto',
			'save' => 'Actualizar'
		),

		'show_data' => array(
			'title' => 'Ver datos del producto',
		),

		'edit_language' => array(
			'title' => 'Agregar Nuevo Idioma',
		),

		'actions' => array(
			'Show' => 'Ver   ',
			'Edit' => 'Editar',
			'Delete' => 'Eliminar',
			'Activate' => 'Activar',
			'product_for_barter' => 'Cambiar',
			'Deactivated' => 'Desactivar',
			'Photo' => 'Agregar foto',
			'Language' => 'AGREGAR IDIOMA'
		),
		'result_search' => array(
			'title' => 'Resultados de la busqueda'
		),

		'search-blade' => array( 
			'search-result' => 'Resultados para',
			'search-again' => 'Buscar de nuevo',
			'search-options' => "Opciones de Búsqueda",
			'products' => 'Productos',
			'classifieds' => 'Clasificados',
			'categories' => 'Escoger Categorías...',
			'condition-product' => 'Condición del producto',
			'condition-classified' => 'Condición del clasificado',
			'classified-type' => 'Tipo de clasificado',
			'country' => 'País',
			'state' => 'Estado',
			'city' => 'Ciudad',
			'price' => 'Precio' ,
			'range' => 'Rango',
			'point-price' => 'Precio en puntos',
			'show' => 'Mostrar',
			'order-by' => 'Ordenar por',
			'name' => 'Nombre',
			'rating' => 'Puntuación',
			'condition' => 'Condición',
			'low-high' => '(Bajo - Alto)',
			'high-low' => '(Alto - Bajo)',
			'highest' => '(Mayor)', 
			'lowest' => '(Menor)', 
			'new-used' => '(Nuevo - Usado)',
			'used-new' => '(Usado - Nuevo)',
		)
	);

