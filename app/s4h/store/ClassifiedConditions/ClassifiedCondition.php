<?php namespace s4h\store\ClassifiedConditions;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\ClassifiedConditionsLang\ClassifiedConditionLang;
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

	public function classifieds()
	{
		return $this->hasMany('s4h\store\Classifieds\Classified');
	}

	// Override methods
	public function delete()
	{
		foreach ($this->classifieds as $classified) {
			$classified->delete();
		}
		ClassifiedConditionLang::where('classified_conditions_id','=', $this->id)->delete();
		return parent::delete();
	}

}