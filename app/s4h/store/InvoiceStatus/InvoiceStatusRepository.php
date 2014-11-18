<?php namespace s4h\store\InvoiceStatus;

use s4h\store\InvoiceStatus\InvoiceStatus;
use s4h\store\InvoiceStatusLang\InvoiceStatusLang;
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

	public function updateInvoiceStatu($data = array())
	{
		$invoice_status = $this->getInvoicetStatus($data['invoice_status_id']);
		$invoice_status->color = $data['color'];
		$invoice_status->save();
		if (count($invoice_status->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$invoice_status->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
		}else{
			$invoice_status->languages()->attach($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
		}
	}

	public function deleteInvoiceStatu($invoice_status_id)
	{
		$invoiceStatus = $this->getInvoicetStatus($invoice_status_id);
		$invoiceStatus->delete();
		InvoiceStatusLang::where('invoice_status_id','=', $invoice_status_id)->delete();
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

	public function getInvoicetStatus($invoice_status_id)
	{
		return InvoiceStatus::find($invoice_status_id);
	}

}