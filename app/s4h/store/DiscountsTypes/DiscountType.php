<?php namespace s4h\store\DiscountsTypes;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\DiscountTypesLang\DiscountTypeLang;
use s4h\store\Base\BaseModel;

class DiscountType extends BaseModel {
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'discounts_types';

	protected $fillable = ['name'];

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','discount_types_lang','discount_type_id','language_id')->withPivot('name');
	}	

	public function discounts()
	{
		return $this->hasMany('s4h\store\Discounts\Discount');
	}


	public function getInCurrentLangAttribute(){
		$language = $this->getCurrentLang();
		return DiscountTypeLang::whereDiscountTypeId($this->id)->whereLanguageId($language->id)->first();
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