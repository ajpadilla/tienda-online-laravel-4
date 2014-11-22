<?php 
	return array(
		"create" => "create/discount/type",
		"store" => "add/discount/type",
		"index" => "list/discount/type",
		"show"=>"show/discount/type/{id}",
		"edit"=>"edit/discount/type/{id}",
		"update"=>"update/discount/type/{id}",
		"destroy"=>"delete/discount/type/{id}",
		"title" => "Add Discount Type",
		"subtitle" => "Create new discount type",
		"labels" => array(
			'name' =>'Name:',
			'save' => 'Save',
		),
		"list" => array(
			'title' => 'list of types of discounts',
			'Name' => 'Name',
			'Actions' =>'Actions'
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
		'alert' => '¡The discount code is already registered!.'
	);
