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
        'point_price' => 'required|integer', 
        'height' => 'required|numeric',
        'depth' => 'required|numeric',
        'weight' => 'required|numeric',
        'active' => 'required|integer',
        'color' =>'required',
        'accept_barter' => 'required|integer',
        'condition_id' => 'required|integer|exists:product_conditions,id',
        'measure_id' => 'required|exists:measures,id',
        'weight_id' => 'require|integer|exists:weights,id'
        ];
}
