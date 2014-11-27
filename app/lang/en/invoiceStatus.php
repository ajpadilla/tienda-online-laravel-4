<?php 
	return array(
		"create" => "create/invoice/status",
		"store" => "add/invoice/status",
		"index"=>'list/invoice/status',
		"show"=>"show/invoice/status/{id}",
		"edit"=>"edit/invoice/status/{id}",
		"update"=>"update/invoice/status/{id}",
		"destroy"=>"delete/invoice/status/{id}",
		"title" => "Add invoice status",
		"subtitle" => "Create invoice status",
		"sending" => "Adding invoice status",
		"response" => "Invoice status added",
		"updated" => "Invoice status updated",
		"delete" => "¡Invoice status successfully removed!",

		"labels" => array(
			'language' => 'Language',
			'name' =>'Name:',
			'description' => 'Description:',
			'color' => 'Color',
			'save' => 'Add',
			'sending' => 'Sending data',
			'new' => 'New'
		),

		"validation" => array(
			'required' => 'The field is required.',
			'rangelength' => 'Please enter a value between ',
			'characters' => 'Characters.',
			'number' => 'The field must be a number.',
			'digits' => 'Please enter whole numbers only.',
			'onlyLettersNumbersAndSpaces' => 'Enter only letters, numbers and/or spaces.',
			'onlyLettersNumbersAndDash' => 'Enter only letters, numbers and/or dash.'
		),

		'message1' =>'Invoice status',
		'message2' =>'Successfully added!.',
		'alert' => 'The invoice status name is already registered!.',
		'alertColor' => 'The color is already registered!.',

		'list' =>array(
			'title' => 'Invoice list',
			'subtitle'=>'List of invoices',
			'Color' => 'Color',
			'Name'=>'Name',
			'Description' => 'Description',
			'Actions'=>'Actions',
		),


		'edit_view' => array(
			'title' => 'Edit invoice status',
			'subtitle' => 'Invoice status Details '
		),

		'show_data' => array(
			'title' => 'See invoice status details',
			'subtitle' => 'Invoice status'
		),

		'actions' => array(
			'Show' => 'Show   ',
			'Edit' => 'Edit',
			'Delete' => 'Delete'
		)
	);