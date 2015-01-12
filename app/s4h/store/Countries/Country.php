<?php namespace s4h\store\Countries;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class Country extends Eloquent
{
	
	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'countries';

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','countries_lang','country_id','language_id')->withPivot('name')->withTimestamps();
	}	

}