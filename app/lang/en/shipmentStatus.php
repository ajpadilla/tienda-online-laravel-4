<?php 
	return array(
		"create" => "create/shipment/status",
		"store" => "add/shipment/status",
		"index"=>'list/shipment/status',
		"show"=>"show/shipment/status/{id}",
		"edit"=>"edit/shipment/status/{id}",
		"update"=>"update/shipment/status/{id}",
		"destroy"=>"delete/shipment/status/{id}",
		"title" => "Add shipment status",
		"subtitle" => "Create shipment status",
		"labels" => array(
			'language' => 'language',
			'name' =>'Name:',
			'description' => 'Description:',
			'color' => 'Color',
			'save' => 'Add',
			'sending' => 'Sending data'
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
			'title' => 'List of invoices',
			'subtitle'=>'Lista de facturas',
			'Color' => 'Color',
			'Name'=>'Name',
			'Description' => 'Description',
			'Actions'=>'Actions',
		),
	);