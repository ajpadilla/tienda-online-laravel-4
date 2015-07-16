<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class EditShipmentStatusFormLang extends FormValidator{
	protected $rules = [
                    'name' => 'required|max:255',
                    'description' => 'required',
                    'shipment_status_id' => "required|exists:shipment_status,id",
                    'language_id' => "required|exists:languages,id" 
     ];
}
