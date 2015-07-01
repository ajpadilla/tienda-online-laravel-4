<?php namespace s4h\store\Categories;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\CategoriesLang\CategoryLang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseModel;

class Category extends BaseModel{

	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'categories';

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','categories_lang','categories_id','language_id')->withPivot('name');
	}

	public function getInCurrentLangAttribute(){
		$language = $this->getCurrentLang();
		return CategoryLang::whereCategoriesId($this->id)->whereLanguageId($language->id)->first();
	}


/*	public function parent(){
		return $this->belongsTo('s4h\store\Categories\Category');
	}

	public function childrens(){
		return $this->hasMany('s4h\store\Categories\Category');
	}*/

	public function categories()
	{
		return $this->hasMany('s4h\store\Categories\Category','category_id');
	}

	public function parent()
	{
		return $this->belongsTo('s4h\store\Categories\Category','category_id');
	}

	public function hasParent()
	{
		if (count($this->parent) > 0) {
			return true;
		}
		return false;
	}

	public function hasCategories()
	{
		return $this->categories->count();
	}

	public function getName()
	{
		$language = $this->getCurrentLang();
		$categoryLanguageNane = $this->languages()->where('language_id','=', $language->id)->first();
		return $categoryLanguageNane->pivot->name;
	}

	/*
	*	Eliminar categoria y relaciones
	*/
	public function delete()
	{
		if($this->hasCategories())
			$this->categories()->delete();
		CategoryLang::where('categories_id','=',$this->id)->delete();
		foreach ($this->categories as $category) {
			CategoryLang::where('categories_id','=',$category->id)->delete();
		}
		return parent::delete();
	}
}
