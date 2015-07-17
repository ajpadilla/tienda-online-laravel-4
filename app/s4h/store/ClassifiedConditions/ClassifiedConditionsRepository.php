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

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Actions', function($model)
		{
			$language = $this->getCurrentLang();

			$this->cleanActionColumn();
			
			$this->addActionColumn("<button href='#fancybox-edit-classified-condition' id='edit_classified-condition_".$model->id."' class='edit-classified-condition btn btn-warning btn-outline dim col-sm-8' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Edit')."'  data-original-title='".trans('discountType.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#' class='delete-classified-condition btn btn-danger btn-outline dim col-sm-8' id='delete_classified-condition_".$model->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Delete')."'  data-original-title='".trans('discountType.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#fancybox-language-edit-classified-condition' id='language_classified-condition_".$model->id."'  class='edit-classified-condition-lang btn btn-success btn-outline dim col-sm-8' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Language')."'  data-original-title='".trans('discountType.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('name');
		$this->collection->orderColumns('name');
		$this->collection->addColumn('name', function($model)
		{
			return $model->InCurrentLang->name;
		});
	}

		
}