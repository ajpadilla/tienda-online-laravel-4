<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

/**
* 
*/
class EditClassifiedTypeForm extends FormValidator {

		protected $rules = [
			'name' => 'required|max:128',
		];
	
}
