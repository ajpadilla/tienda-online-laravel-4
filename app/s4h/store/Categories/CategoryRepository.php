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

	public function getNameForLanguage()
	{
		$iso_code = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$iso_code)->first();
		return $language->categories()->lists('name','category_id');
	}

}
