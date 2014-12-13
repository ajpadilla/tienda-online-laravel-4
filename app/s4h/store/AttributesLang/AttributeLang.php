<?php namespace s4h\store\AttributesLang;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class AttributeLang extends Eloquent
{
	
	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'attributes_lang';

}