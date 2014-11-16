<?php namespace s4h\store\ShipmentStatus;

use s4h\store\ShipmentStatus\ShipmentStatus;
use s4h\store\Languages\Language;
/**
* 
*/
class ShipmentStatusRepository {
	public function save(ShipmentStatus $shipmentStatus)
	{
		return $shipmentStatus->save();
	}

	public function createNewShipmentStatus($data = array())
	{
		$shipmentStatus = new ShipmentStatus;
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
		$shipment_status = ShipmentStatus::select()->where('color','=',$color))->first();
		return $shipment_status;
	}
	
}
