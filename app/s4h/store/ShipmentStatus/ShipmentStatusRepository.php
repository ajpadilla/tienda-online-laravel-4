<?php namespace s4h\store\ShipmentStatus;

use s4h\store\ShipmentStatus\ShipmentStatus;

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
}
