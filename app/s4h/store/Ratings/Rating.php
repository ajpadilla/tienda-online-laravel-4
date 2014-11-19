<?php namespace s4h\store\ShipmentStatus;

// use Andrew13\Cabinet\CabinetUpload;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

// class Photo extends CabinetUpload {
class ShipmentStatus extends Eloquent {

	use SoftDeletingTrait;
	protected $softDelete = true;
	protected $dates = ['deleted_at'];

	public function product(){
		return $this->belongsTo('s4h\store\Products\Product');
	}

}
