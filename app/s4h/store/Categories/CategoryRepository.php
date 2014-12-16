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
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		if (!empty($language)) {
			return $language->categories()->lists('name', 'category_id');
		}else{
			return array();
		}
	}

	public function getNameArrayNested($nestedIds){

	}

	public function getCategoriesWithoutParents(){
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		if (!empty($language)) {
			return Category::whereNull('category_id')->get();
		}else{
			return array();
		}
	}

	public function getNested($categories){
		$nested = [];
		foreach ($categories as $category) {
			$nested[$category->name] = $this->getChildrenCategories($category->id);
		}
		return $nested;
	}

	public function getChildrenCategories($categoryId){
		$categories = Category::whereCategoryId($categoryId)->lists('id');
		$childrens = [];
		if($categories) {
			foreach ($categories as $category) {
				$childrens[$category] = $this->getChildrenCategories($category);
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
