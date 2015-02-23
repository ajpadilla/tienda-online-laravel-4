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

	public function deleteInvoiceStatu($invoice_status_id)
	{
		$invoiceStatus = $this->getById($invoice_status_id);
		$invoiceStatus->delete();
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

	public function getById($invoiceStatusId)
	{
		return InvoiceStatus::findOrFail($invoiceStatusId);
	}

	public function getNameForEdit($data = array())
	{
		return InvoiceStatusLang::select()->where('invoice_status_id','!=',$data['invoice_status_id'])->where('name','=',$data['name'])->first();
	}

	public function getArrayInCurrentLangData($id)
	{
		$invoiceStatus = $this->getById($id);
		$invoiceStatusLanguage = $invoiceStatus->getInCurrentLangAttribute();
		return[
			'success' => true, 
			'invoice_status' => $invoiceStatus->toArray(),
			'invoice_status_lang' => $invoiceStatusLanguage->toArray(),
		];
	}

	public function updateData($data = array())
	{
		$invoiceStatus = $this->getById($data['invoice_status_id']);
		if (isset($data['color'])) {
			$invoiceStatus->color = $data['color'];
		}
		$invoiceStatus->save();

		if (count($invoiceStatus->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
					$invoiceStatus->languages()->updateExistingPivot($data['language_id'], array('name'=> $data['name'],
				'description' => $data['description'])
			);
		}else{
					$invoiceStatus->languages()->attach($data['language_id'], array('name'=> $data['name'],
				'description' => $data['description'])
			);
		}
	}

	public function getDataForLanguage($invoiceStatusId, $languageId)
	{
		$invoiceStatusLang = InvoiceStatusLang::whereInvoiceStatusId($invoiceStatusId)->whereLanguageId($languageId)->first();
		if(count($invoiceStatusLang) > 0){
			return [
				'success' => true, 
				'invoiceStatusLang' => $invoiceStatusLang->toArray()
			];
		}else{
			return ['success' => false];
		}
	}
}


