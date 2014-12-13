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

	public function get()
	{
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		if (!empty($language)) {
			return $language->categories()->lists('name', 'category_id');
			//return $this->getNested($language->categoriesLang());
		}else{
			return array();
		}
	}

	public function getNested($categories){
		$nested = [];
		$first = false;
		foreach ($categories as $categoryLang) {
			if(!$first) {
				$nested[] = $categoryLang->name;
				$first = true;
			}
			$category = $categoryLang->category();
			if($category->category_id) {
				$this->searchIntoArray($categoryLang->name, $nested);
			}
		}
	}

	public function searchIntoArray($target, $array){
		foreach($array as $key => $value) {
			if($value == $target)
				return $key;
			elseif(is_array($value))
				return $this->searchIntoArray($target, $value);
		}
	}

}
