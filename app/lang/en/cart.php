<?php
	return array(

		"routes" => array(
			"show" => "cart/show/{id}/{user?}",
			"create" => "cart/add/{id}/{quantity?}",
			'change-quantity' => "cart/change-quantity/{productId}/{quantity}",
			"store" => "cart/store",
			"api" => array(
				"index" => "cart/api/list-cart",
				'delete-ajax' => 'cart/api/cart-delete-ajax/{id}',
			)
		),
		"show-title" => "Show Cart",
		"cart-empty" => "Your shopping cart is empty!",
		"title" => "Cart",

		"labels" => array(
			'name' =>'Nombre',
			'description' => 'Description',
			'quantity' => 'Quantity',
			'price' => 'Price',
			'save' => 'Save',
			'image' => 'No images found',
			'Image' => 'Image',
			'Stock' => 'Stock',
			'UnitPrice' => 'Unit price',
			'sub-total' => "Sub total",
			'total' => "Total",
			'cost' => "Shipping Cost",
			'continue-shopping' => "continue shopping",
			'pay' => 'Pay'
		),
	);

