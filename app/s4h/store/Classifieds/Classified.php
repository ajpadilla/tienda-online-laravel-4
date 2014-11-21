<?php namespace s4h\store\Classifieds;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
/**
* 
*/
class Classified extends Eloquent {
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'classifieds';

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','classifieds_lang','classified_id','language_id')->withPivot('name','description','address');
	}	

	public function user(){
		return $this->belongsTo('s4h\store\Users\User','user_id');
	}

	public function classifiedType(){
		return $this->belongsTo('s4h\store\ClassifiedTypes\ClassifiedType','classified_type_id');
	}

	public function classifiedCondition(){
		return $this->belongsTo('s4h\store\ClassifiedConditions\ClassifiedCondition','classified_condition_id');
	}

}