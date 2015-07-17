<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

/**
* 
*/
class EditClassifiedTypeForm extends FormValidator {

		protected $rules = [
			'language_id' =>'required|integer|exists:languages,id',
			'classified_type_id' =>'required|integer|exists:classified_types,id',
			'name' => 'required|max:128',
		];
	
}
