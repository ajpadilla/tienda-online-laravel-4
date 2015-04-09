<?php namespace s4h\store\ClassifiedsLang;

use s4h\store\ClassifiedsLang\ClassifiedsLang;
use s4h\store\Classifieds\Classified;
use s4h\store\Languages\Language;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Base\BaseRepository;
/**
* 
*/
class ClassifiedsLangRepository extends BaseRepository{

	public function getAllForLanguage($languageId)
	{
		return ClassifiedsLang::where('language_id','=',$languageId)->get();
	}

	public function getModel()
    {
      return new ClassifiedsLang;
    }

    public $filters = ['filterWord'];
}
