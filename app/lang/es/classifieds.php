<?php 
	return array(

		"routes" => array(
			"create" => "clasificados/crear",
			"store" => "clasificados/agregar",
			"show"=>"clasificados/ver/{id}",
			"index" => "clasificados/lista-clasificados",
			"edit"=>"clasificados/editar/{id}",
			"update"=>"clasificados/actualizar",
			"destroy"=>"clasificados/eliminar/{id}",
			"search" => "clasificados/buscar",
			"filterClassified" => "clasificados/resultados-busqueda",
			"api" => array(
				'update' => 'clasificados/api/actualizar',
				"list" => "clasificados/api/list-clasificados",
				"saveLang" =>"clasificados/api/idioma-actualizar-idioma",
				"delete" =>"clasificados/api/eliminar-clasificados",
			)
		),
		"title" => "Agregar clasificado",
		"subtitle" => "Crear clasificado",
		"sending" => "Agregando clasificado",
		"response" => "Clasificado agregado",
		"Actualiced" => "Clasificado actualizado",
		"Delete" => "¡Clasificado eliminado con exito!",
		"Classifieds" => "Clasificados",
		"create-title" => "Crear clasificado",
		"index-title" => "Lista de clasificados",
		"show-title" => "Ver clasificado",
		"search-title" => "Buscar clasificado",
		"countries" => 'Paises',
		"statesForCountry" =>"estados-por-pais",
		"citiesForState" =>"ciudades-por-estado" ,
		'all-conditions' => 'Todos',

		"labels" => array(
			'name' =>'Nombre:',
			'description' => 'Descripción',
			'price' => 'Precio',
			'language' => 'Idioma',
			'add_photos' => 'Agregar foto',
			'user' => 'Usuario',
			'classified_type' => 'Tipo de clasificado',
			'classified_condition' => 'Condición del clasificado',
			'address' => 'Dirección',
			'save' => 'Guardar',
			'Yes' => 'Si',
			'No' => 'No',
			'user' => 'Usuario',
			'new' => 'Nuevo',
			'NewClassifieds' => 'Nuevos Clasificados',
			'TopClassifieds' => 'Top Clasificados',
			'image' => 'No se han encontrado imágenes',
			'operator' => 'Operador',
			'condition' => 'Condición',
			'Type'=> 'Tipo',
			'search' => 'Buscar'
		),

		"list" => array(
			'title' => 'Lista de clasificados',
			'subtitle' => 'Listado de clasificados',
			'photo' => 'Photo',
			'Name' => 'Nombre',
			'Description' =>'Descripción',
			'Address' => 'Dirección',
			'User' => 'Usuario',
			'Classifieds_types' => 'Tipo de clasificado',
			'Classified_condition' => 'Condición del clasificado',
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
		),

		'searchs' => array(
			'title' => 'Buscar clasificado',
			'subtitle' => 'Buscar clasificado por:',
			'Country' => 'País', 
			'City' => 'Ciudad',
			'State' => 'Estado',
		),

		'filtered' => array(
			'title' => 'Resultados de la busqueda',
			'subtitle' => 'Resultados'
		),

		'edit_language' => array(
			'title' => 'Agregar idioma', 
		),

	);
