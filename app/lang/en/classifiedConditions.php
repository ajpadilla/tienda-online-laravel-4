<?php 
	return array(

		"routes" => array(
			"create" => "condition-classifieds/create",
			"store" => "condition-classifieds/store",
			"show"=>"condition-classifieds/show/{id}",
			"edit"=>"condition-classifieds/edti/{id}",
			"update"=>"condition-classifieds/update/{id}",
			"destroy"=>"condition-classifieds/destroy/{id}",
			"api" => array(
				"index" => "condition-classifieds/api/list-condition-classifieds",
			),
		),

		"title" => "Add Condition to classifieds",
		"subtitle" => "create new condition to classifieds",
		"sending" => "Adding condition to classifieds",
		"response" => "condition to classifieds added",
		"Actualiced" => "Condition to classifieds update",
		"Delete" => "¡Condition to classifieds successfully removed!",
		"create-title"=> "Create condition classified",
		"index-title" => "List of condition classified",
		"show-title" => "Show condition classified",
		'current-lang' =>'data-lang-condition-classified',
		'all-conditions' => 'All',

		"labels" => array(
			'name' =>'Name:',
			'language' => 'Language',
			'save' => 'Save',
			'new' => 'New'
		),
		"list" => array(
			'title' => 'Condition to classifieds list',
			'subtitle'=>'List of condition to classifieds',
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

		'alert' => 'The condition to classifieds name is already registered!.',

		'edit_view' => array(
			'title' => 'Edit condition to classifieds',
			'subtitle' => 'Condition to classifieds Details '
		),

		'show_data' => array(
			'title' => 'See condition to classifieds details',
			'subtitle' => 'Condition to classifieds'
		),

		'actions' => array(
			'Show' => 'Show   ',
			'Edit' => 'Edit',
			'Delete' => 'Delete'
		)
	);
