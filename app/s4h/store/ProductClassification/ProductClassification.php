<?php namespace s4h\store\ProductClassification;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class ProductClassification extends Eloquent{
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'product_classification';

}