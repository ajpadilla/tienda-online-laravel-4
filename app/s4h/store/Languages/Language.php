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
		return $this->belongsToMany('s4h\store\ShipmentStatus\Shipment_Status','shipment_status_lang','language_id','shipment_status_id')->withPivot('name','description');
	}

	public function invoice_status()
	{
		return $this->belongsToMany('s4h\store\InvoiceStatus\InvoiceStatus','invoice_status_lang','language_id','invoice_status_id')->withPivot('name','description');
	}

	public function classifiedTypes()
	{
		return $this->belongsToMany('s4h\store\ClassifiedTypes\ClassifiedType','classified_types_lang','language_id','classified_types_id')->withPivot('name');
	}

	public function classifiedConditions()
	{
		return $this->belongsToMany('s4h\store\ClassifiedConditions\ClassifiedCondition','classified_conditions_lang','language_id','classified_conditions_id')->withPivot('name');
	}

	public function classifieds(){
		return $this->belongsToMany('s4h\store\Classifieds\Classified','classifieds_lang','language_id','classified_id')->withPivot('name','description','address');
	}	

	public function products(){
		return $this->belongsToMany('s4h\store\Products\Product','products_lang','language_id','product_id')->withPivot('name','description');
	}	

	public function productConditions(){
		return $this->belongsToMany('s4h\store\Conditions\Condition','product_condition_lang','language_id','product_condition_id')->withPivot('name');
	}	

	public function categories(){
		return $this->belongsToMany('s4h\store\Categories\Category','categories_lang','language_id','categories_id')->withPivot('name');
	}	

	public function measure(){
		return $this->belongsToMany('s4h\store\Measures\Measure','measures_lang','language_id','measures_id')->withPivot('name','abbreviation');
	}
}
