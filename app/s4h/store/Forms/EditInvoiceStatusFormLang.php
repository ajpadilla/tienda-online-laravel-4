<?php namespace s4h\store\Forms;

use Laracasts\Validation\FormValidator;

class EditInvoiceStatusFormLang extends FormValidator{
	protected $rules = [
                    'name' => 'required|max:255',
                    'description' => 'required',
                    'invoice_status_id' => "required|exists:invoice_status,id",
                    'language_id' => "required|exists:languages,id" 
     ];
}
