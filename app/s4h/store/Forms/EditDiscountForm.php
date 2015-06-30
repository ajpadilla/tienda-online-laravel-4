<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class EditDiscountForm extends FormValidator{
	protected $rules = [
						'discount_id' => 'required|exists:discounts,id',
						'name' => 'required|max:255',
						'description' => 'required|min:10',
						'value' => 'required|numeric',
						'percent' => 'required|numeric',
						'quantity' =>'required|integer',
						'quantity_per_user' => 'required|integer',
						'code' => 'required|alpha_dash|max:255',
						'active' => 'required|integer',
						'from' => 'required|date',
						'to' => 'required|date',
						'discount_type_id' =>'required|integer|exists:discounts_types,id'
	];
}