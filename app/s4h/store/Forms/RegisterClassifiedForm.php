<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

/**
* 
*/
class RegisterClassifiedForm extends FormValidator {

		protected $rules = [
			'price' => 'required|numeric',
			'classified_type_id' => 'required|integer',
			'classified_condition_id' => 'required|integer', 
		];
	
}
