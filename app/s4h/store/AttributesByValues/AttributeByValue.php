<?php namespace s4h\store\AttributesByValues;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class AttributeByValue extends Eloquent
{
	
	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'attribute_by_values';

}