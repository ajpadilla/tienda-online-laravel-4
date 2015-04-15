<?php 
	
return array(
	"routes" => array(
		"show" => "PaymentCredentialDetails/show/{id}",
		"create" => "PaymentCredentialDetails/create",
		"store" => "PaymentCredentialDetails/store",
		'edit' => 'PaymentCredentialDetails/edit/{id}',
		'update' => 'PaymentCredentialDetails/update',
		'destroy' => 'PaymentCredentialDetails/destroy/{id}',
		"api" => array(
			'index'=>'PaymentCredentialDetails/api/list-PaymentCredentialDetails',
			"delete-ajax" =>"PaymentCredentialDetails/api/delete-PaymentCredentialDetails",
			"saveLang" => 'PaymentCredentialDetails/api/update-lang',
			),
		),
)