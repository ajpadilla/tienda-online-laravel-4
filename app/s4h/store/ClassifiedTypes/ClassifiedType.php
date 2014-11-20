<?php namespace s4h\store\ClassifiedTypes;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
/**
* 
*/
class ClassifiedType extends Eloquent {
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'classified_types';

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','classified_types_lang','classified_types_id','language_id')->withPivot('name');
	}	

}