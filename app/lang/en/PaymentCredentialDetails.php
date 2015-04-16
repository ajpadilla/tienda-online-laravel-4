<?php 

return array(

	"index-title" => "List Details payment credentials",
	"create-title" => "Create Details payment credentials",
	"sending" => 'Sending data',
	"response" => 'Added credentials',
	"date" => 'yy-mm-dd',
	"routes" => array(
		"show" => "PaymentCredentialDetails/show/{id}",
		"create" => "PaymentCredentialDetails/create",
		"store" => "PaymentCredentialDetails/store",
		'edit' => 'PaymentCredentialDetails/edit/{id}',
		'update' => 'PaymentCredentialDetails/update',
		'destroy' => 'PaymentCredentialDetails/destroy/{id}',
		"api" => array(
			'index'=>'PaymentCredentialDetails/api/list-PaymentCredentialDetails',
			"delete-ajax" =>"PaymentCredentialDetails/api/delete-PaymentCredentialDetails",
			"saveLang" => 'PaymentCredentialDetails/api/update-lang',
			"getData" => 'PaymentCredentialDetails/api/get-data',
			),
		),

	"labels" => array(
		'new' => 'Nuevo',
		'email' => 'Email',
		'credit_cart_number' => 'Credit cart number',
		'credit_cart_security_number' => 'Credit cart security number',
		'credit_cart_expire_date'	=> 'Credit cart expire date',
		'payments_types'		=> 'Payment  type',
		'card_brands'	=> 'Card Brands',
		'save' => 'Save'
		),

	'list' => array(
		'email'	=> 'Email',
		'credit_cart_number' => 'Credit cart number',
		'credit_cart_security_number'		=> 'Credit cart security number',
		'credit_cart_expire_date'	=> 'Credit cart expire date',
		'payments_types'		=> 'Payment  type',
		'users'		=> 'User',
		'actions' => 'Actions',
		'card_brands'	=> 'Card Brands',
		'title' => 'List Details payment credentials',
		'subtitle' => 'List details of payment credentials',
		),

	"validation" => array(
			'required' => 'The field is required.',
			'rangelength' => 'Please enter a value between ',
			'characters' => 'Characters.',
			'number' => 'The field must be a number.',
			'digits' => 'Please enter whole numbers only.',
			'date' => 'Please enter a valid date.',
			'onlyLettersNumbersAndSpaces' => 'Enter only letters, numbers and/or spaces.',
			'onlyLettersNumbersAndDash' => 'Enter only letters, numbers and/or dash.',
			'email' => 'Please enter a valid email address.'
		),

	'actions' => array(
		'Show' => 'Show',
		'Edit' => 'Edit',
		'Delete' => 'Delete',
		),
	);