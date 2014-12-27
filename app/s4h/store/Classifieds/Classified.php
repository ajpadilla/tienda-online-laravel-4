<?php namespace s4h\store\Classifieds;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\ClassifiedsLang\ClassifiedsLang;
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

	public function categories()
	{
		return $this->belongsToMany('s4h\store\Categories\Category', 'classified_classification','classified_id','category_id');
	}

	public function photos()
	{
		return $this->hasMany('s4h\store\Photos\ClassifiedPhotos');
	}

	public function hasPhotos(){
		return $this->photos->count();
	}

	public function getFirstPhoto(){
		if($this->hasPhotos())
			foreach ($this->photos as $photo)
				return $photo;
		return false;
	}

	/*
	*	Eliminar clasificado y relaciones
	*/
	public function delete()
	{
		if($this->hasPhotos())
			$this->photos()->delete();
		ClassifiedsLang::where('classified_id','=', $this->id)->delete();
		return parent::delete();
	}

}