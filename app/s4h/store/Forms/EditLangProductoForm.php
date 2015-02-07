<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class EditLangProductoForm extends FormValidator{
        protected $rules = [
          'name' => 'required|max:64',
          'description' => 'required',
     ];
}