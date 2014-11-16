<?php namespace s4h\store\Languages;

use Eloquent;

/**
* 
*/
class Language extends Eloquent
{
	protected $table = 'languages';

	protected $fillable = ['name','native_name','iso_code','language_code','date_format'];

	public function discounts(){
		return $this->belongsToMany('s4h\store\Discounts\Discount','discounts_lang','language_id','discount_id')->withPivot('name','description');
	}

	public function discounts_types(){
		return $this->belongsToMany('s4h\store\DiscountsTypes\DiscountType','discount_types_lang','language_id','discount_type_id')->withPivot('name');
	}
	public function shipment_status()
	{
		return $this->belongsToMany('s4h\store\ShipmentStatus\ShipmentStatus','shipment_status_lang','language_id','shipment_status_id')->withPivot('name','description');
	}
}
