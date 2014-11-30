<?php namespace s4h\store\ClassifiedTypes;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\ClassifiedTypesLang\ClassifiedTypeLang;
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
		ClassifiedTypeLang::where('classified_types_id','=', $this->id)->delete();
		return parent::delete();
	}

}