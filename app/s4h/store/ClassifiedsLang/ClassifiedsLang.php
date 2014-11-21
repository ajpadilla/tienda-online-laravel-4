<?php namespace s4h\store\ClassifiedsLang;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
/**
* 
*/
class Classified extends Eloquent {
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'classifieds_lang';

	public function classified(){
		return $this->belongsTo('s4h\store\Classifieds\Classified','classified_id');
	}

	public function language(){
		return $this->belongsTo('s4h\store\Languages\Language','language_id');
	}
}