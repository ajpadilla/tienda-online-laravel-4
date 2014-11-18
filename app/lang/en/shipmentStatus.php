<?php 
	return array(
		"create" => "create/shipment_status",
		"store" => "add/shipment_status",
		"index"=>'list/shipment_status',
		"show"=>"show_shipment_status/{id}",
		"edit"=>"edit_shipment_status/{id}",
		"update"=>"update_shipment_status/{id}",
		"destroy"=>"delete_shipment_status/{id}",
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