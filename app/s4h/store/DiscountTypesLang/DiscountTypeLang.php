<?php namespace s4h\store\DiscountTypesLang;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class DiscountTypeLang extends Eloquent {
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'discount_types_lang';

	public function discountType(){
		return $this->belongsTo('s4h\store\DiscountsTypes\DiscountType','discount_type_id');
	}

	public function language(){
		return $this->belongsTo('s4h\store\Languages\Language','language_id');
	}

}