<?php 
	return array(

		"routes" => array(
			"create" => "classifieds/create",
			"store" => "classifieds/store",
			"show"=>"classifieds/show/{id}",
			"index" => "classifieds/list-classifieds",
			"edit"=>"classifieds/edit/{id}",
			"update"=>"classifieds/update",
			"destroy"=>"classifieds/delete/{id}",
			"search" => "classifieds/search",
			"filterClassified" => "classifieds/result-search",
			"api" => array(
				'update' => 'classifieds/api/update',
				"list" => "classifieds/api/list-classifieds",
				"delete-ajax" => "clasificado/api/delete-ajax",
				"saveLang" =>"classifieds/api/language-update-idioma",
			)
		),

		"title" => "Add classified",
		"subtitle" => "Create classified",
		"sending" => "Adding classified",
		"response" => "Classified added",
		"Actualiced" => "Classified updated",
		"Delete" => "¡Classified successfully removed!",
		"Classifieds" => "Classifieds",
		"create-title" => "Create classified",
		"index-title" => "List of classifieds",
		"show-title" => "Show classified",
		"search-title" => "Search classified",
		"countries" => 'Countries',
		"statesForCountry" =>"states-for-country",
		"citiesForState" =>"cities-for-state" ,
		'all-conditions' => 'All',

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
			'new' => 'New',
			'NewClassifieds' => 'New Classifieds',
			'TopClassifieds' => 'Top Classifieds',
			'image' => 'Not images found',
			'operator' => 'Operator',
			'condition' => 'Condition',
			'Type'=> 'Type',
			'Search' => 'Buscar'
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
		),

		'searchs' => array(
			'title' => 'Search Classifieds',
			'subtitle' => 'Search',
			'Country' => 'País', 
			'City' => 'Ciudad',
			'State' => 'Estado',
		),

		'filtered' => array(
			'title' => 'Search Results',
			'subtitle' => 'Results'
		),

		'edit_language' => array(
			'title' => 'Add language', 
		),

	);
