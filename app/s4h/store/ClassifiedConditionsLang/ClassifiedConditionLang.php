<?php namespace s4h\store\ClassifiedConditionsLang;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
/**
* 
*/
class ClassifiedConditionLang extends Eloquent {
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'classified_conditions_lang';

	public function classifiedCondition(){
		return $this->belongsTo('s4h\store\ClassifiedConditions\ClassifiedCondition','classified_conditions_id');
	}

	public function language(){
		return $this->belongsTo('s4h\store\Languages\Language','language_id');
	}
}