<?php namespace s4h\store\ClassifiedTypes;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\ClassifiedTypesLang\ClassifiedTypeLang;
use s4h\store\Base\BaseModel;
/**
* 
*/
class ClassifiedType extends BaseModel {
	
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

	public function getInCurrentLangAttribute(){
		$language = $this->getCurrentLang();
		return ClassifiedTypeLang::whereClassifiedTypesId($this->id)->whereLanguageId($language->id)->first();
	}

	public function getAccessorInCurrentLang($languageId = ''){
		return ClassifiedTypeLang::whereClassifiedTypesId($this->id)->whereLanguageId($languageId)->first();
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