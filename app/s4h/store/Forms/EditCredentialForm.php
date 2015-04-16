<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class EditCredentialForm extends FormValidator{
	protected $rules = [
		'credit_cart_expire_date' => 'date'
		'payments_types_id' => 'required|integer',
		'card_brands_id' => 'required|integer',
		'users_id' => 'required|integer'
	];
}