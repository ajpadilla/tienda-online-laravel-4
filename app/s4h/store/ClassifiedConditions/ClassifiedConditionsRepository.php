<?php namespace s4h\store\ClassifiedConditions; 

use s4h\store\ClassifiedConditions\ClassifiedCondition;
use s4h\store\Languages\Language;
use s4h\store\ClassifiedConditionsLang\ClassifiedConditionLang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Base\BaseRepository;
/**
* 
*/
class ClassifiedConditionsRepository extends BaseRepository{

	function __construct() {
		$this->columns = [
			trans('classifiedConditions.list.Name'),
			trans('classifiedConditions.list.Actions')
		];
		$this->setModel(new ClassifiedCondition);
		$this->setListAllRoute('classifiedConditions.api.list');
	}

	public function create($data = array())
	{
		$classifiedCondition = $this->model->create([]);
		$classifiedCondition->languages()->attach($data['language_id'], array('name'=> $data['name']));
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


	public function getName($data)
	{
		$language = Language::select()->where('id','=',$data['language_id'])->first();
		if (count($language) > 0) {
			return $language->classifiedConditions()->wherePivot('name','=',$data['name'])->first();
		}else{
			return $language;
		}
	}

	public function getClassifiedConditionId($classified_condition_id)
	{
		return ClassifiedCondition::find($classified_condition_id);
	}

	public function getAllForCurrentLang()
	{
		$language = $this->getCurrentLang();
		if (!empty($language))
			return $language->classifiedConditions()->lists('name','classified_conditions_id');
		else
			return array();
	}

	public function getNameForEdit($data = array())
	{
		return ClassifiedConditionLang::select()->where('classified_conditions_id','!=',$data['classified_conditions_id'])->where('name','=',$data['name'])->first();
	}
		
}