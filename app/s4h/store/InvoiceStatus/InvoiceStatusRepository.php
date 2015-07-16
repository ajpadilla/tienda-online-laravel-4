<?php namespace s4h\store\InvoiceStatus;

use s4h\store\InvoiceStatus\InvoiceStatus;
use s4h\store\InvoiceStatusLang\InvoiceStatusLang;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseRepository;
/**
* 
*/
class InvoiceStatusRepository extends BaseRepository{
	
	function __construct() {
		$this->columns = [
			trans('shipmentStatus.list.Color'),
			trans('shipmentStatus.list.Name'),
			trans('shipmentStatus.list.Description'),
			trans('shipmentStatus.list.Actions')
		];
		$this->setModel(new InvoiceStatus);
		$this->setListAllRoute('invoiceStatus.api.list');
	}

	public function create($data = array())
	{
		$invoiceStatus = $this->model->create($data);
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

	public function getArrayInCurrentLangData($invoiceStatusId)
	{
		$invoiceStatus = $this->get($invoiceStatusId);
		$invoiceStatusLanguage = $invoiceStatus->InCurrentLang;
		return[
			'attributes' => $invoiceStatus, 
			'invoiceStatusLang' => $invoiceStatusLanguage,
		];
	}

	public function update($data = array())
	{
		$invoiceStatus = $this->get($data['invoice_status_id']);
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


	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Actions', function($model)
		{
			$language = $this->getCurrentLang();

			$this->cleanActionColumn();
			
			$this->addActionColumn("<button href='#fancybox-edit-invoice-status' id='edit_invoice-status_".$model->id."' class='edit-invoice-status btn btn-warning btn-outline dim col-sm-8' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Edit')."'  data-original-title='".trans('discountType.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#' class='delete-invoice-status btn btn-danger btn-outline dim col-sm-8' id='delet_invoice-status_".$model->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Delete')."'  data-original-title='".trans('discountType.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#fancybox-edit-language-invoice-status' id='language_invoice-status_".$model->id."'  class='edit-invoice-status-lang btn btn-success btn-outline dim col-sm-8' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Language')."'  data-original-title='".trans('discountType.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('color','name','description');
		$this->collection->orderColumns('color','name', 'description');

		$this->collection->addColumn('color', function($model)
		{
			return  "<input type='text' class='form-control' STYLE='background-color: ".$model->color.";' size='5' readonly>";
		});

		$this->collection->addColumn('name', function($model)
		{
			return $model->InCurrentLang->name;
		});

		$this->collection->addColumn('description', function($model)
		{
			return $model->InCurrentLang->description;
		});
	}
}


