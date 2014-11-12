<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class EditProductForm extends FormValidator{
	protected $rules = [
		'name' => 'required|max:64',
		'description' => 'required',
		'on_sale' => 'required|integer',
		'quantity' => 'required|integer',
		'price' => 'required|numeric',
		'width' => 'required|numeric',
		'height' => 'required|numeric',
		'depth' => 'required|numeric',
		'weight' => 'required|numeric',
		'active' => 'required|integer',
		'available_for_order' => 'required|integer',
		'show_price' => 'required|integer',
		'accept_barter' => 'required|integer',
		'product_for_barter' => 'required|integer',
		'condition_id' => 'required|integer'
	];
}
