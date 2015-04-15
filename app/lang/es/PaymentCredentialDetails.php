<?php 

return array(

	'title' => 'Crear detalles de credenciales de pago',
	'subtitle' => 'Agregar detalles de credenciales de pago',
	"index-title" => "Lista de detalles de credenciales de pago",
	"create-title" => "Crear detalles de credenciales de pago",
	"sending" => 'Enviando datos',
	"response" => 'Credenciales agregadas',

	"routes" => array(
		"show" => "DetallesdecredencialesDePago/ver/{id}",
		"create" => "DetallesdecredencialesDePago/crear",
		"store" => "DetallesdecredencialesDePago/agregar",
		'edit' => 'DetallesdecredencialesDePago/editar/{id}',
		'update' => 'DetallesdecredencialesDePago/actualizar',
		'destroy' => 'DetallesdecredencialesDePago/eliminar/{id}',
		"api" => array(
			'index'=>'DetallesdecredencialesDePago/api/lista-DetallesdecredencialesDePago',
			"delete-ajax" =>"DetallesdecredencialesDePago/api/eliminar-DetallesdecredencialesDePago",
			"saveLang" => 'DetallesdecredencialesDePago/api/actualizar-idioma',
			),
		),
	"labels" => array(
		'new' => 'Nuevo',
		'email' => 'Email',
		'credit_cart_number' => 'Nro de tarjeta de credito',
		'credit_cart_security_numbe' => 'Nro de seguridad de tarjeta de credito',
		'credit_cart_expire_date'	=> 'Fecha de vencimiento tarjeta de credito',
		'payments_types'		=> 'Tipo de pago ',
		'card_brands'	=> 'Marca de la tarjeta',
		'save' => 'Guardar'
	),

	'list' => array(
		'email'	=> 'Email',
		'credit_cart_number' => 'Nro de tarjeta de credito',
		'credit_cart_security_numbe'		=> 'Nro de seguridad tarjeta de credito',
		'credit_cart_expire_date'	=> 'Fecha de vencimiento tarjeta de credito',
		'payments_types'		=> 'Tipo de pago',
		'users'		=> 'Usuario',
		'actions' => 'Acciones',
		'card_brands'	=> 'Marca de tarjeta de crediot',
		'title' => 'Listado de detalles de credenciales de pago',
		'subtitle' => 'Lista de detalles de credenciales de pago',
		),

	);

