<?php namespace s4h\store\ShipmentStatus;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ShipmentStatus extends Eloquent {
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'shipment_status';

	protected $fillable = ['color'];


	public function discountType(){
		return $this->belongsTo('s4h\store\DiscountsTypes\DiscountType');
	}

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','discounts_lang','discount_id','language_id')->withPivot('name','description');
	}	

}