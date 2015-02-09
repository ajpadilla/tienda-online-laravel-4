<?php namespace s4h\store\Carts;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\ProductsLang\ProductLang;

/**
* 
*/
class Cart extends Eloquent
{
	
	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'carts';


	/*
	 * ------------- Relations ---------------
	 */
	public function products()
	{
		return $this->belongsToMany('s4h\store\Products\Product')->withPivot('quantity')->withTimestamps();
	}

	public function user(){
		return $this->belongsTo('s4h\store\Users\User');
	}

	public function currency(){
		return $this->belongsTo('s4h\store\Currencies\Currency');
	}
}