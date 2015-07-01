<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;
/**
* 
*/
class RegisterCategorieForm extends FormValidator{
	protected $rules = [
		'parent_category' => 'exists:categories,id',
		'name' => 'required|max:128',
	];
}
