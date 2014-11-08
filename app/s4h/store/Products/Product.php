<?php namespace s4h\store\Products;

use Eloquent;

class Product extends Eloquent{

	protected $fillable = ['name','description','on_sale','quantity','price','width','height','depth','weight','active','available_for_barter','condition_id','user_id'];

	public function categories()
	{
		return $this->hasMany('s4h\store\Categories\Category');
	}
}
