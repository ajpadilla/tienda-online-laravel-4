<?php namespace s4h\store\ShipmentStatus;

use s4h\store\ShipmentStatus\Shipment_Status;
use s4h\store\ShipmentStatusLang\ShipmentStatusLang;
use s4h\store\Languages\Language;
/**
* 
*/
class ShipmentStatusRepository {
	public function save(Shipment_Status $shipmentStatus)
	{
		return $shipmentStatus->save();
	}

	public function createNewShipmentStatus($data = array())
	{
		$shipmentStatus = new Shipment_Status;
		$shipmentStatus->color = $data['color'];
		$shipmentStatus->save();
		$shipmentStatus->languages()->attach($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
	}	

	public function getNameShipmentStatus($data = array())
	{
		$language = Language::select()->where('id','=',$data['language_id'])->first();
		if (count($language) > 0) {
			return $language->shipment_status()->wherePivot('name','=',$data['name'])->first();
		}else{
			return $language;
		}
	}

	public function getColor($color)
	{
		$shipment_status = Shipment_Status::select()->where('color','=',$color)->first();
		return $shipment_status;
	}

	public function getShipmentStatus($id)
	{
		return Shipment_Status::find($id);
	}

	public function updateShipmentStatu($data = array())
	{
		$shipment_status = $this->getShipmentStatus($data['shipment_status_id']);
		$shipment_status->color = $data['color'];
		$shipment_status->save();

		if (count($shipment_status->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$shipment_status->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
		}else{
			$shipment_status->languages()->attach($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
		}
	}

	public function deleteShipmentStatu($shipment_status_id)
	{
		$shipment_status = $this->getShipmentStatus($shipment_status_id);
		$shipment_status->delete();
	}

	public function getNameForEdit($data = array())
	{
		return ShipmentStatusLang::select()->where('shipment_status_id','!=',$data['shipment_status_id'])->where('name','=',$data['name'])->first();
	}
}
