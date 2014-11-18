<?php namespace s4h\store\DiscountTypesLang;

use Eloquent;

class DiscountTypeLang extends Eloquent {
	
	protected $table = 'discount_types_lang';

	public function discount_type(){
		return $this->belongsTo('s4h\store\DiscountsTypes\DiscountType','discount_type_id');
	}

	public function language(){
		return $this->belongsTo('s4h\store\Languages\Language','language_id');
	}

}