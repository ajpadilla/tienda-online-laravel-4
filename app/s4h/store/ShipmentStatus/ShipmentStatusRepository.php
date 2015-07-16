<?php namespace s4h\store\ShipmentStatus;

use s4h\store\ShipmentStatus\ShipmentStatus;
use s4h\store\ShipmentStatusLang\ShipmentStatusLang;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseRepository;
/**
* 
*/
class ShipmentStatusRepository extends BaseRepository {

	function __construct() {
		$this->columns = [
			trans('shipmentStatus.list.Color'),
			trans('shipmentStatus.list.Name'),
			trans('shipmentStatus.list.Description'),
			trans('shipmentStatus.list.Actions')
		];
		$this->setModel(new ShipmentStatus);
		$this->setListAllRoute('shipmentStatus.api.list');
	}

	public function create($data = array())
	{
		$shipmentStatus = $this->model->create($data);
		$shipmentStatus->languages()->attach($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
	}	

	public function getNameShipmentStatus($data = array())
	{
		$language = Language::select()->where('id','=',$data['language_id'])->first();
		if (count($language) > 0) {
			return $language->shipmentStatus()->wherePivot('name','=',$data['name'])->first();
		}else{
			return $language;
		}
	}

	public function getColor($color)
	{
		$shipmentStatus = ShipmentStatus::select()->where('color','=',$color)->first();
		return $ShipmentStatus;
	}

	public function getById($id)
	{
		return ShipmentStatus::findOrFail($id);
	}

	public function deleteShipmentStatu($shipmentStatusId)
	{
		$ShipmentStatus = $this->getById($shipmentStatusId);
		$ShipmentStatus->delete();
	}

	public function getNameForEdit($data = array())
	{
		return ShipmentStatusLang::select()->where('shipment_status_id','!=',$data['shipment_status_id'])->where('name','=',$data['name'])->first();
	}

	public function getArrayInCurrentLangData($shipmentStatusId)
	{
		$shipmentStatus = $this->get($shipmentStatusId);
		$shipmentStatusLang = $shipmentStatus->InCurrentLang;
		return[
			'attributes' => $shipmentStatus, 
			'shipmentStatusLang' => $shipmentStatusLang,
		];
	}

	public function getDataForLanguage($shipmentStatusId, $languageId)
	{
		$shipmentStatus = $this->get($shipmentStatusId);
		$shipmentStatusLang = $shipmentStatus->getAccessorInCurrentLang($languageId);
		return $shipmentStatusLang;
	}


	public function update($data = array())
	{
		$shipmentStatus = $this->get($data['shipment_status_id']);
		if (isset($data['color'])) {
			$shipmentStatus->color = $data['color'];
		}
		$shipmentStatus->save();

		if (count($shipmentStatus->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
					$shipmentStatus->languages()->updateExistingPivot($data['language_id'], array('name'=> $data['name'],
				'description' => $data['description'])
			);
		}else{
					$shipmentStatus->languages()->attach($data['language_id'], array('name'=> $data['name'],
				'description' => $data['description'])
			);
		}
	}

	public function updateLanguage($data = array())
	{
		$shipmentStatus = $this->get($data['shipment_status_id']);

		if (count($shipmentStatus->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$shipmentStatus->languages()->updateExistingPivot($data['language_id'], array('name'=> $data['name'])
			);
		}else{
			$shipmentStatus->languages()->attach($data['language_id'], array('name'=> $data['name'])
			);
		}
		return $shipmentStatus;
	}

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Actions', function($model)
		{
			$language = $this->getCurrentLang();

			$this->cleanActionColumn();
			
			$this->addActionColumn("<button href='#fancybox-edit-shipment-status' id='edit_shipment-status_".$model->id."' class='edit-shipment-status btn btn-warning btn-outline dim col-sm-8' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Edit')."'  data-original-title='".trans('discountType.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#' class='delete-shipment-status btn btn-danger btn-outline dim col-sm-8' id='delet_shipment-status_".$model->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Delete')."'  data-original-title='".trans('discountType.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#fancybox-edit-language-shipment-status' id='language_shipment-status_".$model->id."'  class='edit-shipment-status-lang btn btn-success btn-outline dim col-sm-8' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Language')."'  data-original-title='".trans('discountType.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />");
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

