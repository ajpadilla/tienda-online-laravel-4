<?php namespace s4h\store\ProductConditions;

// use Andrew13\Cabinet\CabinetUpload;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

// class Photo extends CabinetUpload {
class ProductCondition extends Eloquent {

	use SoftDeletingTrait;
	
	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'product_conditions';

}
