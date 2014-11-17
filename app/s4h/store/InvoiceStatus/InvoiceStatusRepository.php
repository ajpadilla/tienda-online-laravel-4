<?php namespace s4h\store\InvoiceStatus;

use s4h\store\InvoiceStatus\InvoiceStatus;
use s4h\store\Languages\Language;
/**
* 
*/
class InvoiceStatusRepository {
	
	public function save(InvoiceStatus $invoiceStatus)
	{
		$invoiceStatus->save();
	}

	public function createNewInvoiceStatus($data = array())
	{
		$invoiceStatus = new InvoiceStatus;
		$invoiceStatus->color = $data['color'];
		$invoiceStatus->save();
		$invoiceStatus->languages()->attach($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
	}	

	public function getNameInvoiceStatus($data = array())
	{
		$language = Language::select()->where('id','=',$data['language_id'])->first();
		if (count($language) > 0) {
			return $language->invoice_status()->wherePivot('name','=',$data['name'])->first();
		}else{
			return $language;
		}
	}

}