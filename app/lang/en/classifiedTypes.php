<?php 
	return array(
		"create" => "create/classified/type",
		"store" => "add/classified/type",
		"index" => "list/classified/type",
		"show"=>"show/classified/type/{id}",
		"edit"=>"edit/classified/type/{id}",
		"update"=>"update/classified/type/{id}",
		"destroy"=>"delete/classified/type/{id}",
		"title" => "Add classified type",
		"subtitle" => "Create new  classified type",
		"sending" => "Adding classified type",
		"response" => "Classified type added",
		"Updated" => "Classified type updated",
		"Delete" => "¡Classified type successfully removed!",

		"labels" => array(
			'name' =>'Name:',
			'language' => 'Language',
			'save' => 'Save',
			'new' => 'New'
		),

		"list" => array(
			'title' => 'Classified type list',
			'subtitle'=>'List of classified type',
			'Name' => 'Name',
			'Actions' =>'Actions'
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

		'alert' => 'The classified type name is already registered!.',

		'edit_view' => array(
			'title' => 'Edit classified type',
			'subtitle' => 'Classified type Details '
		),

		'show_data' => array(
			'title' => 'See classified type details',
			'subtitle' => 'Classified type'
		),

		'actions' => array(
			'Show' => 'Show   ',
			'Edit' => 'Edit',
			'Delete' => 'Delete'
		)

	);
