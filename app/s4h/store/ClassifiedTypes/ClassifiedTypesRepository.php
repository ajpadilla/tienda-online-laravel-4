<?php namespace s4h\store\ClassifiedTypes;

use s4h\store\ClassifiedTypes\ClassifiedType;
use s4h\store\Languages\Language;
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

	public function getName($data)
	{
		$language = Language::select()->where('id','=',$data['language_id'])->first();
		if (count($language) > 0) {
			return $language->classifiedTypes()->wherePivot('name','=',$data['name'])->first();
		}else{
			return $language;
		}
	}
}