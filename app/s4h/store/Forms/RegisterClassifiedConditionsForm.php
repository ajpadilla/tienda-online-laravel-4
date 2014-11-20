<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;
/**
* 
*/
class RegisterClassifiedConditionsForm extends FormValidator{
	protected $rules = [
		'name' => 'required|max:128',
	];
}
