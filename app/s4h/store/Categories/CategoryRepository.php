<?php namespace s4h\store\Categories;


use s4h\store\Categories\Category;

class CategoryRepository {

	public function save(Category $category){
		return $category->save();
	}

	public function getAll(){
		return Category::all();
	}

}
