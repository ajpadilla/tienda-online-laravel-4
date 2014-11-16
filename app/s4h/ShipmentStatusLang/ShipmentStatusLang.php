<?php namespace s4h\store\Discounts;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class ClassName extends Eloquent{
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'shipment_status_lang';

	public function shipment_status(){
		return $this->belongsTo('s4h\store\ShipmentStatus\ShipmentStatus','shipment_status_id');
	}

	public function language(){
		return $this->belongsTo('s4h\store\Languages\Language','language_id');
	}

}