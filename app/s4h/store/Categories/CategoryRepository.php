<?php namespace s4h\store\Categories;


use s4h\store\Categories\Category;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;

class CategoryRepository {

	public function save(Category $category){
		return $category->save();
	}

	public function getAll(){
		return Category::all();
	}

	public function createNewCategory($data = array())
	{
		$category = new Category;

		if (!empty($data['parent_category'])) {
			$category->category_id = $data['parent_category'];
		}
		
		$category->save();

		$category->languages()->attach($data['language_id'], array('name'=> $data['name']));
	}

	public function updateCategory($data = array())
	{
		$category = $this->getCategoryId($data['category_id']);

		if (!empty($data['parent_category'])) {
			$category->category_id = $data['parent_category'];
		}

		$category->save();

		if (count($category->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$category->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name']));
		}else{
			$category->languages()->attach($data['language_id'], array('name' => $data['name']));
		}
	}

	public function deleteCategory($categories_id)
	{
		$category = $this->getCategoryId($categories_id);
		$category->delete();
	}

	public function get()
	{
		//dd($this->getNested($this->getCategoriesWithoutParents()));
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		if (!empty($language))
			return $language->categories()->lists('name', 'categories_id');
			// return $this->getNested($this->getCategoriesWithoutParents());
		else
			return array();
	}

	public function getNameArrayNested($nestedIds){
		$nameArrayNested = [];
		foreach ($nestedIds as $key => $value) {
			//if(is_int($key) && is_array())
		}
	}

	public function getCategoriesWithoutParents(){
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		if (!empty($language)) {
			return Category::whereNull('category_id')->lists('id');
		}else{
			return array();
		}
	}

	public function getNested($categories){
		$nested = [];
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		foreach ($categories as $categoryId) {
			$category = $language->categoriesLang()->whereCategoriesId($categoryId)->first();
			$array = $this->getChildrenCategories($category);
			if(!empty($category)) {
				if(!empty($array))
					$nested[$category->name] = $array;
				else
					$nested[$category->categories_id] = $category->name;
			}
		}
		return $nested;
	}

	public function getChildrenCategories($category){
		$categories = Category::whereCategoryId($category->categories_id)->get();
		$childrens = [];
		if(!empty($categories)) {
			$isoCode = LaravelLocalization::setLocale();
			$language = Language::select()->where('iso_code','=',$isoCode)->first();
			foreach ($categories as $category) {
				$category = $language->categoriesLang()->whereCategoriesId($category->id)->first();
				if(!empty($category)) {
					$array = $this->getChildrenCategories($category);
					if(!empty($array))
						$childrens[$category->name] = $array;
					else
						$childrens[$category->categories_id] = $category->name;
				}
			}
		}
		return $childrens;
	}

	public function searchIntoArray($target, $array){
		foreach($array as $key => $value) {
			if($value == $target)
				return $key;
			elseif(is_array($value))
				return $this->searchIntoArray($target, $value);
		}
	}

	public function getCategoryId($categories_id)
	{
		return Category::find($categories_id);
	}

}
