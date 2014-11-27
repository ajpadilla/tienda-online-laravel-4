<?php
	return array(
		"create" => "create/discount",
		"store" => "add/discount",
		'index'=>'list/discounts',
		"show"=>"show/discount/{id}",
		"edit"=>"edit/discount/{id}",
		"update"=>"update/discount/{id}",
		"destroy"=>"destroy/discount/{id}",
		"title" => "Add discount",
		"subtitle" => "Create new discount",
		"createCode" =>"create/discount_code", 
 		"storeCode" => "agregar/discount_code",
 		"createData" =>"create/language_data",
		"saveData" =>'add/features_discount',
		"sending" => "Adding discount",
		"response" => "Discount added",
		"Updated" => "Discount updated",
		"Delete" => "¡Discount successfully removed!",
		"labels" => array(
			'name' =>'Name:',
			'description' => 'Description:',
			'value' => 'Value:',
			'percent' => 'Percent:',
			'quantity' => 'Quantity:',
			'quantity_per_user' => 'Quantity per user:',
			'code' => 'Code:',
			'active' => 'Active:',
			'from' => 'From:',
			'to' => 'To',
			'discount_type' => 'Discount type:',
			'save' => 'Save',
			'Yes' => 'Yes',
			'No' => 'No',
			'language' => 'language:',
			'new' => 'New'	
		),

		"validation" => array(
			'required' => 'The field is required.',
			'rangelength' => 'Please enter a value between ',
			'characters' => 'Characters.',
			'number' => 'The field must be a number.',
			'digits' => 'Please enter whole numbers only.',
			'date' => 'Please enter a valid date.',
			'onlyLettersNumbersAndSpaces' => 'Enter only letters, numbers and/or spaces.',
			'onlyLettersNumbersAndDash' => 'Enter only letters, numbers and/or dash.'
		),

		'date' => 'yy-mm-dd',
		'date2' => 'Y-m-d',
		'message1' =>'Discount',
		'message2' =>'Successfully added!.',
		'alert' => 'The discount code is already registered!.',

		'list' =>array(
			'title' => 'List of discounts',
			'subtitle'=>'Discount List',
			'Code'=>'Code',
			'Discount_type'=>'Discount type',
			'Name'=>'Name',
			'Value'=>'Value',
			'Percent'=>'Percent',
			'Active'=>'Active',
			'From'=>'From',
			'To'=>'To',
			'Actions'=>'Actions',
			'title'		=> 'Discounts list',
			'subtitle' => 'List of discounts'
		),

		'edit_view' => array(
			'title' => 'Edit discount',
			'subtitle' => 'Discount Details'
		),

		'show_data' => array(
			'title' => 'See discount details',
		),

		'actions' => array(
			'Show' => 'Show   ',
			'Edit' => 'Edit',
			'Delete' => 'Delete'
		)
		
	);

