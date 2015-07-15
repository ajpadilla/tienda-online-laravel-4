<?php namespace s4h\store\DiscountsTypes;

use s4h\store\DiscountsTypes\DiscountType;
use s4h\store\Languages\Language;
use s4h\store\DiscountTypesLang\DiscountTypeLang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Base\BaseRepository;

class DiscountTypeRepository extends BaseRepository{

	function __construct() {
		$this->columns = [
			trans('discountType.list.Name'),
			trans('discountType.list.Actions')
		];
		$this->setModel(new DiscountType);
		$this->setListAllRoute('discountType.api.list');
	}

	public function getName($data)
	{
		$language = Language::select()->where('id','=',$data['language_id'])->first();
		if (count($language) > 0) {
			return $language->discounts_types()->wherePivot('name','=',$data['name'])->first();
		}else{
			return $language;
		}
	}
	
	public function getAllForCurrentLang()
	{
		$language = $this->getCurrentLang();
		if (!empty($language))
			return $language->discounts_types()->lists('name','discount_type_id');
		else
			return array();
	}

	public function getArrayInCurrentLangData($discountTypeId)
	{
		$discountType = $this->get($discountTypeId);
		$discountTypeLanguage = $discountType->InCurrentLang;
		return[
			'attributes' => $discountType, 
			'discountTypeLang' => $discountTypeLanguage,
		];
	}

	public function create($data = array())
	{
		$discountType = $this->model->create([]);
		$discountType->languages()->attach($data['language_id'], array('name'=> $data['name']));	
		return $discountType;
	}

	public function update($data = array())
	{
		$discountType = $this->get($data['discount_type_id']);
		$discountType->save();

		if (count($discountType->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$discountType->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name']));
		}else{
			$discountType->languages()->attach($data['language_id'], array('name' => $data['name']));
		}
		return $discountType;
	}

	public function deletediscountType($discount_type_id)
	{
		$discount_type = $this->getDiscountTypeId($discount_type_id);
		$discount_type->delete();
	}

	public function getDiscountTypeId($discount_type_id)
	{
		return DiscountType::find($discount_type_id);
	}


	public function getNameForEdit($data = array())
	{
		return DiscountTypeLang::select()->where('discount_type_id','!=',$data['discount_type_id'])->where('name','=',$data['name'])->first();
	}

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Actions', function($model)
		{
			$language = $this->getCurrentLang();

			$this->cleanActionColumn();
			
			$this->addActionColumn("<button href='#fancybox-edit-discount-type' id='edit_discount-type_".$model->id."' class='edit-discount-type btn btn-warning btn-outline dim col-sm-8' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Edit')."'  data-original-title='".trans('discountType.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#' class='delete-discount-type btn btn-danger btn-outline dim col-sm-8' id='delet_discount-type_".$model->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Delete')."'  data-original-title='".trans('discountType.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#fancybox-edit-language-discount-type' id='language_discount-type_".$model->id."'  class='edit-discount-type-lang btn btn-success btn-outline dim col-sm-8' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discountType.actions.Language')."'  data-original-title='".trans('discountType.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />");
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