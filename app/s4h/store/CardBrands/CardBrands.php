<?php namespace s4h\store\CardBrands;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseModel;


/**
* 
*/
class ClassName extends AnotherClass
{
	use SoftDeletingTrait;
	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'card_brands';
	
	protected $fillable = ['name'];


}