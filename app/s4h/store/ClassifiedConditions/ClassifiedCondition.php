<?php namespace s4h\store\ClassifiedConditions;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
/**
* 
*/
class ClassifiedCondition extends Eloquent {
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'classified_conditions';

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','classified_conditions_lang','classified_conditions_id','language_id')->withPivot('name');
	}	

}