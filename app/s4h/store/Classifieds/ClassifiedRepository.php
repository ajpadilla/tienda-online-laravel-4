<?php namespace s4h\store\Classifieds;

use s4h\store\Classifieds\Classified;
use s4h\store\Languages\Language;
use s4h\store\Photos\ClassifiedPhotos;
use s4h\store\ClassifiedsLang\ClassifiedsLang;
use s4h\store\Base\BaseRepository;
/**
* 
*/
class ClassifiedRepository extends BaseRepository
{

	public function getModel()
	{
		return new Classified;
	}

	public $filters = ['cityId','price','classifiedTypeId','classifiedConditionId'];

	//public $filters = ['cityId'];

	public function filterByCityId($query, $value)
	{
		$query->where('city_id','=',$value);
	}

	public function filterByPrice($query, $value)
	{
		$query->where('price','>=',$value);
	}

	public function filterByClassifiedTypeId($query, $value)
	{
		$query->where('classified_type_id','=',$value);
	}

	public function filterByClassifiedConditionId($query, $value)
	{
		$query->where('classified_condition_id','=',$value);
	}


	public function createNewClassified($data = array())
	{
		$classified = new Classified;
		$classified->price = $data['price'];
		$classified->user_id = 1;
		$classified->classified_type_id = $data['classified_type_id'];
		$classified->classified_condition_id = $data['classified_condition_id'];
		$classified->save();
		$classified->languages()->attach($data['language_id'], array('name'=> $data['name'],
			'description'=> $data['description'],
			'address' => $data['address']
		));
		return $classified;
	}

	public function updateClassified($data = array())
	{
		$classified = $this->getClassifiedId($data['classified_id']);
		$classified->price = $data['price'];
		$classified->user_id = 1;
		$classified->classified_type_id = $data['classified_type_id'];
		$classified->classified_condition_id = $data['classified_condition_id'];
		$classified->save();

		if (count($classified->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$classified->languages()->updateExistingPivot($data['language_id'], array('name'=> $data['name'],
				'description'=> $data['description'],
				'address' => $data['address']
			));
		}else{
			$classified->languages()->attach($data['language_id'], array('name'=> $data['name'],
				'description'=> $data['description'],
				'address' => $data['address']
			));
		}

		return $classified;
	}

	public function delteClassified($classified_id)
	{
		$classified = $this->getClassifiedId($classified_id);
		$classified->delete();
 	}

	public function getClassifiedId($classified_id)
	{
		return Classified::findOrFail($classified_id);
	}	

	public function getName($data)
	{
		$language = Language::select()->where('id','=',$data['language_id'])->first();
		if (count($language) > 0) {
			return $language->classifieds()->wherePivot('name','=',$data['name'])->first();
		}else{
			return $language;
		}
	}

	public function getNameForEdit($data = array())
	{
		return ClassifiedsLang::select()->where('classified_id','!=',$data['classified_id'])->where('name','=',$data['name'])->first();
	}

	public function filterClassifieds($filterWord, $language_id) {
		$query = ClassifiedsLang::select();
		if (!empty($filterWord)) {
			$query->where('language_id', '=', $language_id)->where('name', 'LIKE', '%' . $filterWord . '%')->orWhere('description', 'LIKE', '%' . $filterWord . '%');
		}
		return $query->get();
	}

}
