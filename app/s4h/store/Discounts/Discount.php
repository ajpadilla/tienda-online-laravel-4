<?php namespace s4h\store\Discounts;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Discount extends Eloquent {
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'discounts';

	protected $fillable = ['value','percent','quantity','quantity_per_user','code','active','from','to','discount_type_id'];


	public function getActivoShow() {
		return ($this->active == 1) ? 'Yes' : 'No';
	}

	public function discountType(){
		return $this->belongsTo('s4h\store\DiscountsTypes\DiscountType');
	}

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','discounts_lang','discount_id','language_id')->withPivot('name','description');
	}	

}