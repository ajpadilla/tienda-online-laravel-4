<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class EditInvoiceStatusForm extends FormValidator{
	protected $rules = [
                    'name' => 'required|max:255',
                    'description' => 'required',
                    'color' => 'required|max:7',
                    'invoice_status_id' => "required|exists:invoice_status,id"
     ];
}
