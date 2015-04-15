<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class RegisterCredentialsForm extends FormValidator{
	protected $rules = ['payments_types_id' => 'required|integer',
		'card_brands_id' => 'required|integer',
		'users_id' => 'required|integer'
	];
}