<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class EditDiscountTypeForm extends FormValidator{
	protected $rules = ['name' => 'required|max:45'];
}