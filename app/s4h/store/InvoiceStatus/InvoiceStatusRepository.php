<?php namespace s4h\store\InvoiceStatus;

use s4h\store\InvoiceStatus\InvoiceStatus;
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

}