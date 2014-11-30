<?php namespace s4h\store\ClassifiedTypes;

use s4h\store\ClassifiedTypes\ClassifiedType;
use s4h\store\Languages\Language;
use s4h\store\ClassifiedTypesLang\ClassifiedTypeLang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/**
* 
*/
class ClassifiedTypesRepository {
	
	public function save(ClassifiedType $classifiedType){
		return $classifiedType->save();
	}

	public function getAll(){
		return ClassifiedType::all();
	}

	public function createNewClassifiedType($data = array())
	{
		$classified_type = new ClassifiedType;
		$classified_type->save();
		$classified_type->languages()->attach($data['language_id'], array('name'=> $data['name']));
	}

	public function updateClassifiedType($data = array())
	{
		$classified_type = $this->getClassifiedTypeId($data['classified_type_id']);
		$classified_type->save();

		if (count($classified_type->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$classified_type->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name']));
		}else{
			$classified_type->languages()->attach($data['language_id'], array('name' => $data['name']));
		}
	}

	public function delteClassifiedType($classified_type_id)
	{
		$classified_type = $this->getClassifiedTypeId($classified_type_id);
		$classified_type->delete();
 	}

	public function getName($data)
	{
		$language = Language::select()->where('id','=',$data['language_id'])->first();
		if (count($language) > 0) {
			return $language->classifiedTypes()->wherePivot('name','=',$data['name'])->first();
		}else{
			return $language;
		}
	}

	public function getClassifiedTypeId($classified_type_id)
	{
		return ClassifiedType::find($classified_type_id);
	}
	public function getNameForLanguage()
	{
		$iso_code = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$iso_code)->first();
		return $language->classifiedTypes()->lists('name','classified_types_id');
	}
}