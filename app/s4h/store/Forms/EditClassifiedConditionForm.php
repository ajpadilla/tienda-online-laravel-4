<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;
/**
* 
*/
class EditClassifiedConditionForm extends FormValidator{
	protected $rules = [
		'language_id' => 'required|integer|exists:languages,id',
		'classified_condition_id' => 'required|integer|exists:classified_conditions,id',
		'name' => 'required|max:128',
	];
}