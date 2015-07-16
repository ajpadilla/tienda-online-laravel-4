<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class EditShipmentStatusForm extends FormValidator{
	protected $rules = [
                    'name' => 'required|max:255',
                    'description' => 'required',
                    'color' => 'required|max:7',
                    'shipment_status_id' => "required|exists:shipment_status,id"
     ];
}
