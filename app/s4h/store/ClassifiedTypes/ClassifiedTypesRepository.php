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
			trans('shipmentStatus.list.Actions')
		];
		$this->setModel(new ClassifiedType);
		$this->setListAllRoute('classifiedTypes.api.list');
	}

	public function create($data = array())
	{
		$classifiedType = $this->model->create([]);
		$classifiedType->save();
		$classifiedType->languages()->attach($data['language_id'], array('name'=> $data['name']));
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
			
			$this->addActionColumn("<button href='#fancybox-edit-shipment-status' id='edit_shipment-status_".$model->id."' class='edit-shipment-status btn btn-warning btn-outline dim col-sm-8' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Edit')."'  data-original-title='".trans('discountType.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#' class='delete-shipment-status btn btn-danger btn-outline dim col-sm-8' id='delet_shipment-status_".$model->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Delete')."'  data-original-title='".trans('discountType.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#fancybox-edit-language-shipment-status' id='language_shipment-status_".$model->id."'  class='edit-shipment-status-lang btn btn-success btn-outline dim col-sm-8' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Language')."'  data-original-title='".trans('discountType.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />");
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