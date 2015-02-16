<?php
	return array(
		"show" => "show/products/{id}",
		"create" => "create/product",
		"store" => "add/product",
		'index'=>'list/product',
		'edit' => 'edit/product/{id}',
		'update' => 'update/product',
		'destroy' => 'delete/product/{id}',
		'delete-ajax' => 'product/delete-ajax',
		"title" => "Add product",
		"subtitle" => "Create new product",
		"sending" => "Adding product",
		"response" => "Product added",
		"Updated" => "Product update",
		"Delete" => "¡Product successfully removed!",
		"filter" => "search/results",
		"saveLang" => 'addLanguageClassified',
		
		"labels" => array(
			'name' =>'Name',
			'description' => 'Description',
			'on_sale' => 'On sale: :',
			'quantity' => 'Quantity:',
			'price' => 'Price:',
			'width' => 'Width:',
			'height' => 'Height:',
			'depth' => 'Depth:',
			'weight' => 'Weight:',
			'active' => 'Active:',
			'accept_barter' => 'Accept barter',
			'categories' => 'Categories:',
			'condition' => 'Condition:',
			'point_price' => 'Price in points:',
			'height' => 'height:',
			'depth' => 'depth',
			'language' => 'Language:',
			'add_photos' => 'Add photo',
			'new' => 'New',
			'measure' => 'Measure',
			'show_price' => 'Show price',
			'product_for_barter' => 'Barter',
			'image' => 'Not images found',
			'Image' => 'Image',
			'Stock' => 'Stock',
			'UnitPrice' => 'Price',
			'MyWishList' => 'My Wish List',
			'NewProducts' => 'New Products',
			'TopProducts' => 'Top Products'
		),

		"validation" => array(
			'required' => 'The field is required.',
			'rangelength' => 'Please enter a value between ',
			'characters' => 'Characters.',
			'number' => 'The field must be a number.',
			'digits' => 'Please enter whole numbers only.',
			'date' => 'Please enter a valid date.',
			'maxlength' => 'Please enter maximum ',
			'length' => ' digits integers',
			'maxlengthDecimal'=>' and maximum ',
			'decimal' => ' digits decimals',
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

		'edit_language' => array(
			'title' => 'Add language', 
		),

		'actions' => array(
			'Show' => 'Show',
			'Edit' => 'Edit',
			'Delete' => 'Delete',
			'Activate' => 'Activate',
			'Deactivated' => 'Deactivated',
			'Photo' => 'Add photo',
			'Language' => 'Add language'
		),
		'result_search' => array(
			'title' => 'Search results'
		)
	);

