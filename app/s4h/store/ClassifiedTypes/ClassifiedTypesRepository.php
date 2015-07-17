<?php namespace s4h\store\ClassifiedTypes;

use s4h\store\ClassifiedTypes\ClassifiedType;
use s4h\store\Languages\Language;
use s4h\store\ClassifiedTypesLang\ClassifiedTypeLang;
use s4h\store\Base\BaseRepository;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/**
* 
*/
class ClassifiedTypesRepository extends BaseRepository{
	
	function __construct() {
		$this->columns = [
			trans('classifiedTypes.list.Name'),
			trans('classifiedTypes.list.Actions')
		];
		$this->setModel(new ClassifiedType);
		$this->setListAllRoute('classifiedTypes.api.list');
	}

	public function create($data = array())
	{
		$classifiedType = $this->model->create([]);
		$classifiedType->languages()->attach($data['language_id'], array('name'=> $data['name']));
	}

	public function update($data = array())
	{
		$classifiedType = $this->get($data['classified_type_id']);
		$classifiedType->save();

		if (count($classifiedType->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$classifiedType->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name']));
		}else{
			$classifiedType->languages()->attach($data['language_id'], array('name' => $data['name']));
		}
	}

	public function updateLanguage($data = array())
	{
		$classifiedType = $this->get($data['classified_type_id']);

		if (count($classifiedType->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$classifiedType->languages()->updateExistingPivot($data['language_id'], array('name'=> $data['name'])
				);
		}else{
			$classifiedType->languages()->attach($data['language_id'], array('name'=> $data['name'])
				);
		}
		return $classifiedType;
	}

	public function getArrayInCurrentLangData($classifiedTypeId)
	{
		$classifiedType = $this->get($classifiedTypeId);
		$classifiedTypeLang = $classifiedType->InCurrentLang;
		return[
			'attributes' => $classifiedType, 
			'classifiedTypeLang' => $classifiedTypeLang,
		];
	}

	public function getDataForLanguage($classifiedTypeId, $languageId)
	{
		$classifiedType = $this->get($classifiedTypeId);
		$classifiedTypeLang = $classifiedType->getAccessorInCurrentLang($languageId);
		return $classifiedTypeLang;
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
	public function getAllForCurrentLang()
	{
		$language = $this->getCurrentLang();
		if (!empty($language))
			return $language->classifiedTypes()->lists('name','classified_types_id');
		else
			return array();
	}

	public function getNameForEdit($data = array())
	{
		return ClassifiedTypeLang::select()->where('classified_types_id','!=',$data['classified_types_id'])->where('name','=',$data['name'])->first();
	}

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Actions', function($model)
		{
			$language = $this->getCurrentLang();

			$this->cleanActionColumn();
			
			$this->addActionColumn("<button href='#fancybox-edit-classified-type' id='edit_classified-type_".$model->id."' class='edit-classified-type btn btn-warning btn-outline dim col-sm-8' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Edit')."'  data-original-title='".trans('discountType.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#' class='delete-classified-type btn btn-danger btn-outline dim col-sm-8' id='delete_classified-type_".$model->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Delete')."'  data-original-title='".trans('discountType.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#fancybox-language-edit-classified-type' id='language_classified-type_".$model->id."'  class='edit-classified-type-lang btn btn-success btn-outline dim col-sm-8' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Language')."'  data-original-title='".trans('discountType.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />");
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