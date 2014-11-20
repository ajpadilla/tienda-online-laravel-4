<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

/**
* 
*/
class RegisterClassifiedTypesForm extends FormValidator {

		protected $rules = [
			'name' => 'required|max:128',
		];
	
}

