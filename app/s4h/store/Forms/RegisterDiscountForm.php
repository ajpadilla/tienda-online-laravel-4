<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class RegisterDiscountForm extends FormValidator{
	protected $rules = ['name' => 'required|max:128'];
}