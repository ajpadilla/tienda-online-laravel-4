<?php namespace s4h\store\ClassifiedTypes;

use s4h\store\ClassifiedTypes\ClassifiedType;
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
}