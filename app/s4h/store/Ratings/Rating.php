<?php namespace s4h\store\ShipmentStatus;

// use Andrew13\Cabinet\CabinetUpload;
use Eloquent;

// class Photo extends CabinetUpload {
class ShipmentStatus extends Eloquent {

	public function product(){
		return $this->belongsTo('s4h\store\Products\Product');
	}

}
