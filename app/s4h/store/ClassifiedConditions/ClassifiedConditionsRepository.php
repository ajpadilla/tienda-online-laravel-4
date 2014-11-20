<?php namespace s4h\store\ClassifiedConditions; 

use s4h\store\ClassifiedConditions\ClassifiedCondition;
use s4h\store\Languages\Language;
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

	public function createNewClassifiedCondition($data = array())
	{
		$classified_condition = new ClassifiedCondition;
		$classified_condition->save();
		$classified_condition->languages()->attach($data['language_id'], array('name'=> $data['name']));
	}

	public function updateClassifiedCondition($data = array())
	{
		$classified_condition = $this->getClassifiedConditionId($data['classified_condition_id']);
		$classified_condition->save();

		if (count($classified_condition->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$classified_condition->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name']));
		}else{
			$classified_condition->languages()->attach($data['language_id'], array('name' => $data['name']));
		}
	}

	public function delteClassifiedCondition($classified_condition_id)
	{
		$classified_condition = $this->getClassifiedConditionId($classified_condition_id);
		$classified_condition->delete();
		ClassifiedTypeLang::where('classified_conditions_id','=', $classified_condition_id)->delete();
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

	public function getClassifiedConditionId($classified_condition_id)
	{
		return ClassifiedCondition::find($classified_condition_id);
	}
		
}