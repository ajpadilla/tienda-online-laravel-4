<?php namespace s4h\store\AttributeTypes;

use s4h\store\AttributeTypes\AttributeType;
use s4h\store\Languages\Language;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/**
* 
*/
class AttributeTypeRepository {
	
	public function save(AttributeType $AttributeType){
		return $AttributeType->save();
	}

	public function getAll(){
		return AttributeType::all();
	}

	public function createNewAttributeType($data = array())
	{
		$attribute_type = new AttributeType;
		$attribute_type->save();
		$attribute_type->languages()->attach($data['language_id'], array('name'=> $data['name']));
	}

	public function updateAttributeType($data = array())
	{
		$attribute_type = $this->getAttributeTypeId($data['attribute_type_id']);
		$attribute_type->save();

		if (count($attribute_type->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$attribute_type->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name']));
		}else{
			$attribute_type->languages()->attach($data['language_id'], array('name' => $data['name']));
		}
	}

	public function delteAttributeType($classified_type_id)
	{
		$classified_type = $this->getAttributeTypeId($classified_type_id);
		$classified_type->delete();
	}

	public function getName($data)
	{
		$language = Language::select()->where('id','=',$data['language_id'])->first();
		if (count($language) > 0) {
			return $language->AttributeTypes()->wherePivot('name','=',$data['name'])->first();
		}else{
			return $language;
		}
	}

	public function getAttributeTypeId($classified_type_id)
	{
		return AttributeType::find($classified_type_id);
	}
	public function getNameForLanguage()
	{
		$iso_code = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$iso_code)->first();
		return $language->AttributeTypes()->lists('name','classified_types_id');
	}
}