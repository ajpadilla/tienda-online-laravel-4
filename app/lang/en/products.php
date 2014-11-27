<?php
	return array(
		"show" => "show/products/{id}",
		"whistlist" => "whistlist",
		"create" => "create/product",
		"store" => "add/product",
		'index'=>'list/product',
		'edit' => 'edit/product/{id}',
		'update' => 'update/product/{id}',
		'destroy' => 'delete/product/{id}',
		"title" => "Add product",
		"subtitle" => "Create new product",
		"sending" => "Adding product",
		"response" => "Product added",
		"updated" => "Product update",
		"delete" => "¡Product successfully removed!",

		"labels" => array(
			'name' =>'Name:',
			'description' => 'Description:',
			'on_sale' => 'On sale: :',
			'quantity' => 'Quantity:',
			'price' => 'Price:',
			'width' => 'Width:',
			'height' => 'Height:',
			'depth' => 'Depth:',
			'weight' => 'Weight:',
			'active' => 'Active:',
			'available_for_order' => 'Available for order:',
			'show_price' => 'Show price',
			'accept_barter' => 'Accept barter',
			'product_for_barter' => 'Product for barter',
			'categories' => 'Categories:',
			'condition' => 'Condition:',
			'measure' => 'Measure:',
			'height' => 'height:',
			'depth' => 'depth',
			'language' => 'Language:',
			'new' => 'New'	
		),
		"validation" => array(
			'required' => 'The field is required.',
			'rangelength' => 'Please enter a value between ',
			'characters' => 'Characters.',
			'number' => 'The field must be a number.',
			'digits' => 'Please enter whole numbers only.',
			'date' => 'Please enter a valid date.',
			'onlyLettersNumbersAndSpaces' => 'Enter only letters, numbers and/or spaces',
			'onlyLettersNumbersAndDash' => 'Enter only letters, numbers and/or dash.'
		),
		'list' =>array(
				'photo'		=> 'Photo',
				'name'		=> 'Name',
				'price'		=> 'Price',
				'quantity'	=> 'Quantity',
				'active'		=> 'Active',
				'accept'		=> 'Accept barter',
				'category'	=> 'Categories',
				'ratings'	=> 'Ratings',
				'actions'	=> 'Actions',
				'title'		=> 'List Products',
				'title'		=> 'Product List',
				'subtitle' => 'List of products'
		),

		'edit_view' => array(
			'title' => 'Edit product',
			'subtitle' => 'Product Details'
		),

		'show_data' => array(
			'title' => 'See product details',
		),

		'actions' => array(
			'Show' => 'Show',
			'Edit' => 'Edit',
			'Delete' => 'Delete'
		)
	);

