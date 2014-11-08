<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class RegisterLanguageForm extends FormValidator{
	protected $rules = [
						'name' => 'required|alpha_dash|max:255',
						'native_name' => 'required|alpha_dash|max:255',
						'iso_code' => 'required|alpha|max:2',
						'language_code' => 'required|alpha_dash|max:5',
						'date_format' =>'required|alpha_dash|max:45'
	];
}