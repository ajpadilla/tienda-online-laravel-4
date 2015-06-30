<?php namespace s4h\store\Discounts;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\DiscountsLang\DiscountLang;
use s4h\store\Base\BaseModel;
use Carbon\Carbon;

class Discount extends BaseModel {
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'discounts';

	protected $fillable = ['value','percent','quantity','quantity_per_user','code','active','from','to','discount_type_id'];


	public function getActivoShowAttribute() {
		return ($this->active == 1) ? trans('discounts.active.Yes') : trans('discounts.active.No');
	}

	public function discountType(){
		return $this->belongsTo('s4h\store\DiscountsTypes\DiscountType');
	}

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','discounts_lang','discount_id','language_id')->withPivot('name','description');
	}	

	public function getFromShowAttribute()
	{
		$language = $this->getCurrentLang();
		return Carbon::createFromFormat('Y-m-d', $this->from)->format($language->date_format);
	}

	public function getToShowAttribute()
	{
		$language = $this->getCurrentLang();
		return Carbon::createFromFormat('Y-m-d', $this->to)->format($language->date_format);
	}

	public function delete()
	{
		DiscountLang::where('discount_id','=',$this->id)->delete();
		return parent::delete();
	}

	public function getInCurrentLangAttribute(){
		$language = $this->getCurrentLang();
		return DiscountLang::whereDiscountId($this->id)->whereLanguageId($language->id)->first();
	}

	public function getAccessorInCurrentLang($languageId = '')
	{
		return DiscountLang::whereDiscountId($this->id)->whereLanguageId($languageId)->first();
	}


}