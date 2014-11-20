<?php namespace s4h\store\ClassifiedTypesLang;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
/**
* 
*/
class ClassifiedTypeLang extends Eloquent {
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'classified_types_lang';

	public function classifiedTypes(){
		return $this->belongsTo('s4h\store\ClassifiedTypes\ClassifiedType','classified_types_id');
	}

	public function language(){
		return $this->belongsTo('s4h\store\Languages\Language','language_id');
	}
}