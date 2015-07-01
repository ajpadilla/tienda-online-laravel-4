<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;
/**
* 
*/
class RegisterCategorieForm extends FormValidator{
	protected $rules = [
		'name' => 'required|max:128',
	];
}
