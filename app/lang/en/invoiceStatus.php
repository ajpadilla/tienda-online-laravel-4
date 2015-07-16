<?php 
	return array(

		"routes" => array(
			"create" => "create/invoice/status",
			"store" => "add/invoice/status",
			"show"=>"show/invoice/status/{id}",
			"edit"=>"edit/invoice/status/{id}",
			"update"=>"update/invoice/status",
			"destroy"=>"delete/invoice/status/{id}",
			"index" => "invoice-status/list",
			"api" => array(
				"list"=>'invoice-status/api/list-invoice-status',
				'delete' => 'invoice-status/api/delete',
				"saveLang" => "invoice-status/api/lang-invoice-status",
				"update" => "invoice-status/api/update"
			)
		),
		"title" => "Add invoice status",
		"subtitle" => "Create invoice status",
		"sending" => "Adding invoice status",
		"response" => "Invoice status added",
		"Updated" => "Invoice status updated",
		"Delete" => "¡Invoice status successfully removed!",
		"create-title"=> "Create invoice status",
		"index-title" => "List of invoice status",
		"show-title" => "Show invoice status",

		

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