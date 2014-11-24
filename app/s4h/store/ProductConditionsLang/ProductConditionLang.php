<?php namespace s4h\store\ProductConditionsLang;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ProductConditionLang extends Eloquent {
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'product_condition_lang';
}