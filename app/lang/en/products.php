<?php
	return array(
		"create" => "create/product",
		"store" => "add/product",
		'index'=>'list/product',
		"title" => "Add product",
		"subtitle" => "Create new product",
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
			'condition' => 'Condition:'		
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
		)
	);

