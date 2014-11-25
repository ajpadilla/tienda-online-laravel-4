<?php namespace s4h\store\ProductsLang;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class ProductLang extends Eloquent{
	
	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'products_lang';

	public function product(){
		return $this->belongsTo('s4h\store\Products\Product','product_id');
	}

	public function language(){
		return $this->belongsTo('s4h\store\Languages\Language','language_id');
	}

}

