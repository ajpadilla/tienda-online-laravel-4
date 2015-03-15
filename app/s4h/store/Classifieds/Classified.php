<?php namespace s4h\store\Classifieds;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\ClassifiedsLang\ClassifiedsLang;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseModel;

/**
* 
*/
class Classified extends BaseModel {
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'classifieds';

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','classifieds_lang','classified_id','language_id')->withPivot('name','description','address')->withTimestamps();
		
	}	

	public function address(){
		return $this->belongsTo('s4h\store\Address\Address','address_id');
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
		return $this->belongsToMany('s4h\store\Categories\Category', 'classified_classification','classified_id','category_id')->withTimestamps();
	}

	public function photos()
	{
		return $this->hasMany('s4h\store\Photos\ClassifiedPhotos');
	}

	public function hasPhotos(){
		return $this->photos->count();
	}

	public function hasCategories(){
		return $this->categories->count();
	}

	public function getFirstPhoto(){
		if($this->hasPhotos())
			foreach ($this->photos as $photo)
				return $photo;
		return false;
	}

	public function getCategories()
	{
		$categoriesNames = [];

		$language = $this->getCurrentLang();

		if($this->hasCategories())
			foreach ($this->categories as $category)
			{
				$categoriesLanguages =  $category->languages()->where('language_id','=',$language->id)->get();
				foreach ($categoriesLanguages as $categoryLanguage) 
				{
					$categoriesNames[] = $categoryLanguage->pivot->name;
				}
			}
			return $categoriesNames;
	}

	public function getCategorieIds()
	{
		$categorieIds = [];

		if($this->hasCategories())
			foreach ($this->categories as $category)
			{
				$categorieIds[] = $category->id;
			}
			return $categorieIds;
	}

	public function checkCategory($categoryId)
	{
		if($this->hasCategories())
			foreach ($this->categories as $category)
				if ($category->id == $categoryId)
					return true;
			return false;
		return false;
	}

	public function getDataForLanguage($languageId)
	{
		$classifiedLanguage = $this->languages()->where('language_id','=',$languageId)->first();
		return $classifiedLanguage;
	}

	/*
	*	Eliminar clasificado y relaciones
	*/
	public function delete()
	{
		if($this->hasPhotos())
			$this->photos()->delete();

		if ($this->hasCategories())
			//$this->categories()->delete();
			foreach ($this->categories as $category) {
				$category->delete();
			}


		ClassifiedsLang::where('classified_id','=', $this->id)->delete();
		return parent::delete();
	}

	public function getInCurrentLangAttribute(){
		$language = $this->getCurrentLang();
		return ClassifiedsLang::whereClassifiedId($this->id)->whereLanguageId($language->id)->first();
	}

	public function getAccessorInCurrentLang($languageId){
		return ClassifiedsLang::whereClassifiedId($this->id)->whereLanguageId($languageId)->first();
	}
}