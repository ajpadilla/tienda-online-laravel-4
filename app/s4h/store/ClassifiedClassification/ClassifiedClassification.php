<?php namespace s4h\store\ClassifiedClassification;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class ClassifiedClassification extends Eloquent{
	
	use SoftDeletingTrait;
	
	protected $softDelete = true;

    protected $dates = ['deleted_at'];
	
	protected $table = 'classified_classification';

}