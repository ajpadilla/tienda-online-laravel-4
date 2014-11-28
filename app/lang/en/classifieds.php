<?php 
	return array(
		"create" => "create/classified",
		"store" => "add/classified",
		"index" => "list/classified",
		"show"=>"show/classified/{id}",
		"edit"=>"edit/classified/{id}",
		"update"=>"update/classified/{id}",
		"destroy"=>"delete/classified/{id}",
		"title" => "Agregar Tipo de classified",
		"subtitle" => "Crear classified",
		"sending" => "Adding classified type",
		"response" => "Classified type added",
		"Actualiced" => "Classified type updated",
		"Delete" => "¡Classified type successfully removed!",

		"labels" => array(
			'name' =>'Name:',
			'description' => 'Description',
			'price' => 'Price',
			'language' => 'Language',
			'add_photos' => 'Add photo',
			'user' => 'User',
			'classified_type' => 'Classified Type',
			'classified_condition' => 'Condition Classified',
			'address' => 'Address',
			'save' => 'Save',
			'Yes' => 'Yes',
			'No' => 'No',
			'new' => 'New'
		),

		"list" => array(
			'title' => 'List Classified',
			'subtitle' => 'List of classified',
			'photo' => 'Photo',
			'Name' => 'Name',
			'Description' =>'Description',
			'Address' => 'Address',
			'User' => 'User',
			'Classifieds_types' => 'Classified Type',
			'Classified_condition' => 'Condition Classified',
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

		'alert' => 'The classified  name is already registered!.',

		'edit_view' => array(
			'title' => 'Edit classified ',
			'subtitle' => 'Classified details '
		),

		'show_data' => array(
			'title' => 'See classified details',
			'subtitle' => 'Classified'
		),

		'actions' => array(
			'Show' => 'Show   ',
			'Edit' => 'Edit',
			'Delete' => 'Delete'
		)

	);
