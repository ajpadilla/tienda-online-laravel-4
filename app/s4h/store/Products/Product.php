<?php namespace s4h\store\Products;

use Eloquent;

class Product extends Eloquent{

	protected $fillable = ['name','description','on_sale','quantity','price','width','height','depth','weight','active','available_for_barter','condition_id','user_id'];

	public function categories()
	{
		return $this->belongsToMany('s4h\store\Categories\Category', 'product_classification');
	}

	public function condition()
	{
		return $this->belongsto('s4h\store\Conditions\Condition');
	}
}
