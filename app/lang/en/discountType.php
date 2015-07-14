<?php 
	return array(

		"routes" => array(
			"create" => "discounts-type/create",
			"store" => "discounts-type/store",
			"show"=>"discounts-type/show/{id}",
			"edit"=>"discounts-type/edit/{id}",
			"update"=>"discounts-type/update/{id}",
			"destroy"=>"discounts-type/destroy/{id}",
			"index"=>'discounts-type/list-discounts-type',
			"api" => array(
				"index" => "discounts-type/api/list-discounts-type",
			),
		),
		"title" => "Add Discount Type",
		"subtitle" => "Create new discount type",
		"sending" => "Adding discount type",
		"response" => "Discount type added",
		"Updated" => "Discount type updated",
		"Delete" => "¡Discount type successfully removed!",
		"create-title"=> "Create discount type",
		"index-title" => "List of discounts type",
		"show-title" => "Show discounts type",

		"labels" => array(
			'name' =>'Name:',
			'save' => 'Save',
			'language' => 'Language:',
			'new' => 'New'
		),
		"list" => array(
			'Name' => 'Name',
			'Actions' =>'Actions',
			'title'		=> 'Discounts type list',
			'subtitle' => 'List of discounts types'
		),

		"validation" => array(
			'required' => 'The field is required.',
			'rangelength' => 'Please enter a value between ',
			'characters' => 'Characters.',
			'number' => 'The field must be a number.',
			'digits' => 'Please enter whole numbers only.',
			'date' => 'Please enter a valid date.',
			'onlyLettersNumbersAndSpaces' => 'Enter only letters, numbers and/or spaces',
			'onlyLettersNumbersAndDash' => 'Enter only letters, numbers and/or dash.'
		),

		'message1' =>'Discount',
		'message2' =>'Successfully added!.',
		'alert' => '¡The name already registered!.',

		'edit_view' => array(
			'title' => 'Edit discount type',
			'subtitle' => 'Discount type Details '
		),

		'show_data' => array(
			'title' => 'See discount type details',
			'subtitle' => 'Discount type'
		),

		'actions' => array(
			'Show' => 'Show   ',
			'Edit' => 'Edit',
			'Delete' => 'Delete'
		)
		
	);
