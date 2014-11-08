<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class RegisterDiscountTypeForm extends FormValidator{
	protected $rules = ['name' => 'required|unique:discounts_types|max:45'];
}