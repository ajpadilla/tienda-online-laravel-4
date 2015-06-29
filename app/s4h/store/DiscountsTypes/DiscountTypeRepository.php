<?php namespace s4h\store\DiscountsTypes;

use s4h\store\DiscountsTypes\DiscountType;
use s4h\store\Languages\Language;
use s4h\store\DiscountTypesLang\DiscountTypeLang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Base\BaseRepository;

class DiscountTypeRepository extends BaseRepository{

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

	public function createNewDiscountType($data = array())
	{
		$discount_type = new DiscountType;
		$discount_type->save();
		$discount_type->languages()->attach($data['language_id'], array('name'=> $data['name']));	
	}

	public function updateDiscountType($data = array())
	{
		$discount_type = $this->getDiscountTypeId($data['discount_type_id']);
		$discount_type->save();

		if (count($discount_type->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$discount_type->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name']));
		}else{
			$discount_type->languages()->attach($data['language_id'], array('name' => $data['name']));
		}
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
}