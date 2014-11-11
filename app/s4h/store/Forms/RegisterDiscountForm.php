<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class RegisterDiscountForm extends FormValidator{
	protected $rules = [
						'name' => 'required|max:255',
						'description' => 'required|min:10',
						'value' => 'required|numeric',
						'percent' => 'required|numeric',
						'quantity' =>'required|integer',
						'quantity_per_user' => 'required|integer',
						'code' => 'required|alpha_dash|unique:discounts|max:255',
						'active' => 'required|integer',
						'from' => 'required|date',
						'to' => 'required|date',
						'discount_type_id' =>'required|integer'
	];
}