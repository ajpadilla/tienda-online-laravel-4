<?php namespace s4h\store\ClassifiedConditions; 

use s4h\store\ClassifiedConditions\ClassifiedCondition;
/**
* 
*/
class ClassifiedConditionsRepository {

	public function save(ClassifiedCondition $classifiedCondition){
		return $classifiedCondition->save();
	}

	public function getAll(){
		return ClassifiedCondition::all();
	}

	public function createNewClassifiedType($data = array())
	{
		$classified_condition = new ClassifiedCondition;
		$classified_condition->save();
		$classified_condition->languages()->attach($data['language_id'], array('name'=> $data['name']));
	}

	public function updateClassifiedType($data = array())
	{
		$classified_type = $this->getClassifiedConditionId($data['classified_type_id']);
		$classified_type->save();

		if (count($classified_type->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$classified_type->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name']));
		}else{
			$classified_type->languages()->attach($data['language_id'], array('name' => $data['name']));
		}
	}

	public function delteClassifiedType($classified_type_id)
	{
		$classified_type = $this->getClassifiedConditionId($classified_type_id);
		$classified_type->delete();
		ClassifiedTypeLang::where('classified_types_id','=', $classified_type_id)->delete();
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

	public function getClassifiedConditionId($classified_type_id)
	{
		return ClassifiedCondition::find($classified_type_id);
	}
		
}