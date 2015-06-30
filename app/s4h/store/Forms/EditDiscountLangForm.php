<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class EditDiscountLangForm extends FormValidator{
        protected $rules = [
          'discount_id' => 'required|exists:discounts,id',
          'name' => 'required|max:64',
          'description' => 'required',
     ];
}