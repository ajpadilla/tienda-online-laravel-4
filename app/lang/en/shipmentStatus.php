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
		"sending" => "Adding shipment status",
		"response" => "Shipment status added",
		"updated" => "Shipment status updated",
		"delete" => "¡Shipment status successfully removed!",

		"labels" => array(
			'language' => 'language',
			'name' =>'Name:',
			'description' => 'Description:',
			'color' => 'Color',
			'save' => 'Add',
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

		'message1' =>'¡Shipment status',
		'message2' =>'Successfully added!.',
		'alert' => 'The invoice status name is already registered!.',
		'alertColor' => 'The color is already registered!.',

		'list' =>array(
			'Color' => 'Color',
			'Name'=>'Name',
			'Description' => 'Description',
			'Actions'=>'Actions',
			'title'		=> 'Shipment status list',
			'subtitle' => 'List of shipment status',
		),

		'edit_view' => array(
			'title' => 'Edit shipment status',
			'subtitle' => 'Shipment status Details'
		),

		'show_data' => array(
			'title' => 'See shipment status details',
			'subtitle' => 'Shipment status'
		),

		'actions' => array(
			'Show' => 'Show   ',
			'Edit' => 'Edit',
			'Delete' => 'Delete'
		)

	);