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
			trans('discountType.list.Name'),
			trans('discountType.list.Actions')
		];
		$this->setModel(new ShipmentStatus);
		$this->setListAllRoute('discountType.api.list');
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

	public function getArrayInCurrentLangData($id)
	{
		$shipmentStatus = $this->getById($id);
		$shipmentStatusLanguage = $shipmentStatus->getInCurrentLangAttribute();
		return[
			'success' => true, 
			'shipment_status' => $shipmentStatus->toArray(),
			'shipment_status_lang' => $shipmentStatusLanguage->toArray(),
		];
	}

	public function updateData($data = array())
	{
		$shipmentStatus = $this->getById($data['shipment_status_id']);
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

	public function getDataForLanguage($shipmentStatusId, $languageId)
	{
		$shipmentStatusLang = ShipmentStatusLang::whereShipmentStatusId($shipmentStatusId)->whereLanguageId($languageId)->first();
		if(count($shipmentStatusLang) > 0){
			return [
				'success' => true, 
				'shipmentStatusLang' => $shipmentStatusLang->toArray()
			];
		}else{
			return ['success' => false];
		}
	}

}

