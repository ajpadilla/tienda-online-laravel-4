<?php namespace s4h\store\Languages;

use Eloquent;

/**
* 
*/
class Language extends Eloquent
{
	protected $table = 'languages';

	protected $fillable = ['name','native_name','iso_code','language_code','date_format'];

	public function discounts()
	{
		return $this->belongsToMany('s4h\store\Discounts\Discount','discounts_lang','language_id','discount_id')->withPivot('name','description');
	}

}
