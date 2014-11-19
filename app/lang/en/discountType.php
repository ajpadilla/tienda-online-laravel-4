<?php 
	return array(
		"create" => "create/discount_type",
		"store" => "add/discount_type",
		"index" => "",
		"show"=>"show_discount_type/{id}",
		"edit"=>"edit_discount_type/{id}",
		"update"=>"update_discount_type/{id}",
		"destroy"=>"delete_discount_type/{id}",
		"title" => "Add Discount Type",
		"subtitle" => "Create new discount type",
		"labels" => array(
			'name' =>'Name:',
			'save' => 'Save',
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
