<?php 
	return array(

		"routes" => array(
			"create" => "classifieds-type/create",
			"store" => "classifieds-type/store",
			"show"=>"classifieds-type/shiow/{id}",
			"edit"=>"classifieds-type/edit/{id}",
			"update"=>"classifieds-type/update/{id}",
			"destroy"=>"classifieds-type/destroy/{id}",
			"api" => array(
				"index" => "classifieds-type/api/list-classifieds-type",
			)
		),
		"title" => "Add classified type",
		"subtitle" => "Create new  classified type",
		"sending" => "Adding classified type",
		"response" => "Classified type added",
		"Updated" => "Classified type updated",
		"Delete" => "¡Classified type successfully removed!",
		"create-title"=> "Create classified type",
		"index-title" => "List of classified type",
		"show-title" => "Show classified type",
		'current-lang' =>'data-lang-type-classified',
		'all-conditions' => 'All', 
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
