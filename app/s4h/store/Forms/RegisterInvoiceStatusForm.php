<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class RegisterInvoiceStatusForm extends FormValidator{
	protected $rules = [
		'name' => 'required|max:255',
		'description' => 'required',
		'color' => 'required|max:7|unique:invoice_status,color'
	];
}