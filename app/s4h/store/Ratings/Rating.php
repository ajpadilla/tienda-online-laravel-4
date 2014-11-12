<?php namespace s4h\store\Ratings;

// use Andrew13\Cabinet\CabinetUpload;
use Eloquent;

// class Photo extends CabinetUpload {
class Rating extends Eloquent {

	public function product(){
		return $this->belongsTo('s4h\store\Products\Product');
	}

}
