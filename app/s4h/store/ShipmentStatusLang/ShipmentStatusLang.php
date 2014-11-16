<?php namespace s4h\store\ShipmentStatusLang;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class ShipmentStatusLang extends Eloquent{
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'shipment_status_lang';

	public function shipmentStatus(){
		return $this->belongsTo('s4h\store\ShipmentStatus\ShipmentStatus','shipment_status_id');
	}

	public function language(){
		return $this->belongsTo('s4h\store\Languages\Language','language_id');
	}

}