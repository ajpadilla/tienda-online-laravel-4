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

	public function getNameForLanguage()
	{
		$iso_code = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$iso_code)->first();
		if (!empty($language)) {
			return $language->categories()->lists('name','categories_id');
		}else{
			return array();
		}
	}

	public function getCategoryId($categories_id)
	{
		return Category::find($categories_id);
	}
}
