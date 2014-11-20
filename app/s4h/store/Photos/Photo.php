<?php namespace s4h\store\Photos;

use Andrew13\Cabinet\CabinetUpload;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

// class Photo extends CabinetUpload {
class Photo extends CabinetUpload {

	use SoftDeletingTrait;
	protected $softDelete = true;
	protected $dates = ['deleted_at'];

	public function product(){
		return $this->belongsTo('s4h\store\Products\Product');
	}

}
