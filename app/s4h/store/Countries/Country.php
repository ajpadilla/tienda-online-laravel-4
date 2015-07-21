<?php namespace s4h\store\Countries;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\Base\BaseModel;
/**
* 
*/
class Country extends BaseModel
{
	
	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'countries';

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','countries_lang','country_id','language_id')->withPivot('name')->withTimestamps();
	}	

	public function states(){
		return  $this->hasMany('s4h\store\States\State');
	}

}