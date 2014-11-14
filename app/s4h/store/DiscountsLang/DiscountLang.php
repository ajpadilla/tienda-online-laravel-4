<?php namespace s4h\store\DiscountsLang;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
/**
* 
*/
class DiscountLang extends Eloquent{

	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'discounts_lang';

	public function discount(){
		return $this->belongsTo('s4h\store\Discounts\Discount','discount_id');
	}

	public function discount(){
		return $this->belongsTo('s4h\store\Languages\Language','language_id');
	}
}
