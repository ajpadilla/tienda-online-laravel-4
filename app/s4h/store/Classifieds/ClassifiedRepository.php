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

	public $filters = ['filterWord','price','priceRange','firstValue','secondValue','categories','conditionsClassifieds',
    'cityId','classifiedType','operator','orderBy'];

	public function filterByPrice($query, $data = array()){
		$query->where('price',$data['operator'],$data['price']);
	}

    public function filterByPriceRange($query, $data = array()){
		$query->whereBetween('price',[$data['firstValue'], $data['secondValue']]);
	}

	public function filterByConditionsClassifieds($query, $data = array()){
		$query->where('classified_condition_id','=',$data['conditionsClassifieds']);
	}

	public function filterByFilterWord($query, $data = array())
	{
		$language = $this->getCurrentLang();
		$query->whereHas('languages', function($q) use ($data, $language){
    		$q->where('language_id', '=', $language->id)
    			->where('classifieds_lang.name', 'LIKE', '%' . $data['filterWord'] . '%')
    			->orWhere('classifieds_lang.description', 'LIKE', '%' . $data['filterWord'] . '%')
    			->where('language_id', '=', $language->id);
		});
	}

	public function filterByCategories($query, $data = array())
	{
		$query->whereHas('categories', function($q) use ($data){
    		$q->whereIn('classified_classification.category_id', $data['categories']);
		});
	}

	public function filterByClassifiedType($query, $data = array()){
		$query->where('classified_type_id','=',$data['classifiedType']);
	}

	public function filterByCityId($query, $data = array()){
		$query->whereHas('address', function($q) use ($data){
    		$q->where('city_id', '=', $data['cityId']);
		});
	}

	public function orderByName($query, $order){
		$language = $this->getCurrentLang();
		$query->with(array('languages' => function($q) use ($language, $order){
			$q->where('language_id', '=', $language->id)
    		->orderBy('classifieds_lang.name',$order);
		}));
	}

	public function orderByPrice($query, $order){
		$query->orderBy('price',$order);
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

		if (!is_null($data['categories']))
			$classified->categories()->sync($data['categories']);

		return $classified;
	}

	public function updateClassified($data = array())
	{
		$classified = $this->getById($data['classified_id']);
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

		if (isset($data['categories'])){
			$classified->categories()->sync($data['categories']);
		}else{
			$classified->categories()->detach();
		}

		return $classified;
	}

	public function delteClassified($classifiedId)
	{
		$classified = $this->getById($classifiedId);
		$classified->delete();
 	}

	public function getById($classifiedId)
	{
		return Classified::findOrFail($classifiedId);
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


	public function updateAttributeLang(Classified $classified, $data = array()){

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

	}

}
