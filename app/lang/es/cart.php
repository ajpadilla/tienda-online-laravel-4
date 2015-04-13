<?php
	return array(

		"routes" => array(
			"show" => "carrito/ver/{id}/{user?}",
			"create" => "carrito/agregar/{id}/{quantity?}",
			"store" => "carrito/guardar",
			'change-quantity' => "carrito/cambiar-cantidad/{productId}/{quantity}",
			"api" => array(
				"index" => "carrito/api/lista-carrito",
				'delete-ajax' => 'carrito/api/carrito-eliminar-ajax/{id}',
			)
		),
		"show-title" => "Ver Carrito",
		"cart-empty" => "¿Tu carro de compras está vacío!",
		"title" => "Carrito",

		"labels" => array(
			'name' =>'Nombre',
			'description' => 'Descripción',
			'quantity' => 'Cantidad',
			'price' => 'Precio',
			'save' => 'Guardar',
			'image' => 'No se han encontrado imágenes',
			'Image' => 'Imagen',
			'Stock' => 'Almacen',
			'UnitPrice' => 'Precio unitario',
			'sub-total' => "Sub total",
			'total' => "Total",
			'cost' => "Costo de envío",
			'continue-shopping' => "Continuar compra",
			'pay' => 'Pagar'
		),
	);

