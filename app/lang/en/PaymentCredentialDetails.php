<?php 

return array(

	"index-title" => "List Details payment credentials",
	"create-title" => "Create Details payment credentials",
	"sending" => 'Sending data',
	
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
	);