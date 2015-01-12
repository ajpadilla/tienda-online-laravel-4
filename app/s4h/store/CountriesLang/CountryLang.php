<?php namespace s4h\store\CountriesLang;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class CountryLang extends Eloquent
{
	
	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'countries_lang';

}