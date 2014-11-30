<?php namespace s4h\store\DiscountsTypes;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\DiscountTypesLang\DiscountTypeLang;

class DiscountType extends Eloquent {
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'discounts_types';

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','discount_types_lang','discount_type_id','language_id')->withPivot('name');
	}	

	public function discounts()
	{
		return $this->hasMany('s4h\store\Discounts\Discount');
	}

	public function delete()
	{
		foreach ($this->discounts as $discount) {
			$discount->delete();
		}
		DiscountTypeLang::where('discount_type_id','=', $this->id)->delete();
		return parent::delete();
	}
}