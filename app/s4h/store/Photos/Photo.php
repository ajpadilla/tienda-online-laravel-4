<?php namespace s4h\store\Photos;

// use Andrew13\Cabinet\CabinetUpload;
use Eloquent;

// class Photo extends CabinetUpload {
class Photo extends Eloquent {

	public function product(){
		return $this->belongsTo('s4h\store\Products\Product');
	}

}
