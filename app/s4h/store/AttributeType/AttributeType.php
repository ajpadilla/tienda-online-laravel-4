<?php namespace s4h\store\AttributeType;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class AttributeType extends Eloquent
{
	
	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'attribute_types';

}