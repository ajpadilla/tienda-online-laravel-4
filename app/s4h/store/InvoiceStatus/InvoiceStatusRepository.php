<?php namespace s4h\store\InvoiceStatus;

use namespace s4h\store\InvoiceStatus\InvoiceStatus;
/**
* 
*/
class InvoiceStatusRepository {
	
	public function save(InvoiceStatus $invoiceStatus)
	{
		$invoiceStatus->save();
	}
}