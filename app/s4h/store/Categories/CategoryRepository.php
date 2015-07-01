<?php namespace s4h\store\Categories;


use s4h\store\Categories\Category;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseRepository;

class CategoryRepository extends BaseRepository{

	function __construct() {
		$this->columns = [
			trans('categories.list.Name'),
			trans('categories.list.Parent_category'),
			trans('categories.list.Actions')
		];
		$this->setModel(new Category);
		$this->setListAllRoute('categories.api.list');
	}

	public function create($data = array())
	{
		$category = new Category;

		if (!empty($data['parent_category'])) {
			$category->category_id = $data['parent_category'];
		}

		$category->save();

		$category->languages()->attach($data['language_id'], array('name'=> $data['name']));
	}

	public function update($data = array())
	{
		$category = $this->get($data['category_id']);

		if (!empty($data['parent_category'])) {
			$category->category_id = $data['parent_category'];
		}

		$category->save();

		if (count($category->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$category->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name']));
		}else{
			$category->languages()->attach($data['language_id'], array('name' => $data['name']));
		}

		return $category;
	}

	public function updateLanguage($data = array())
	{
		$category = $this->get($data['category_id']);

		if (count($category->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$category->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name']));
		}else{
			$category->languages()->attach($data['language_id'], array('name' => $data['name']));
		}
		return $category;
	}

	public function deleteCategory($categories_id)
	{
		$category = $this->getCategoryId($categories_id);
		$category->delete();
	}

	public function getAllForCurrentLang()
	{
		$language = $this->getCurrentLang();
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
					$nested[] = ['id' => $category->categories_id, 'name' => $category->name, 'array' => $array];
				else
					$nested[] = ['id' => $category->categories_id, 'name' => $category->name];
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
						$childrens[] = ['id' => $category->categories_id, 'name' => $category->name, 'array' => $array];
					else
						$childrens[] = ['id' => $category->categories_id, 'name' => $category->name];
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

	
	public function getArrayInCurrentLangData($categoryId)
	{
		$parentCategory = Null;
		$category = $this->get($categoryId);
		$categoryLanguage = $category->InCurrentLang;

		if($category->hasParent()) 
			$parentCategory = $category->parent->InCurrentLang;

		return[
			'attributes' => $category, 
			'categoryLang' => $categoryLanguage,
			'parentCategory' => $parentCategory
		];
	}

	public function getDataForLanguage($categoryId, $languageId)
	{
		$category = $this->get($categoryId);
		$categoryLang = $category->getAccessorInCurrentLang($languageId);
		return $categoryLang;
	}


	public function setDefaultActionColumn() 
	{
		$this->addColumnToCollection('Actions', function($model)
		{
			$language = $this->getCurrentLang();

			$this->cleanActionColumn();
			$this->addActionColumn("<form action='".route('categories.show',$model->id)."' method='get'>
				<button href='#'  class='btn btn-success btn-outline dim col-sm-4 show' style='margin-left: 20px;' type='submit' data-toggle='tooltip' data-placement='top' title='".trans('categories.actions.Show')."'  data-original-title='".trans('categories.actions.Show')."' ><i class='fa fa-check fa-2x'></i></button><br/>
			</form>");
			$this->addActionColumn("<button href='#fancybox-edit-category' id='edit_category_".$model->id."' class='edit-category btn btn-warning btn-outline dim col-sm-4' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('categories.actions.Edit')."'  data-original-title='".trans('categories.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
		</button><br/>");
			$this->addActionColumn("<button href='#' class='delete-category btn btn-danger btn-outline dim col-sm-4' id='delet_category_".$model->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('categories.actions.Delete')."'  data-original-title='".trans('categories.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
		</button><br/>");
			$this->addActionColumn("<button href='#fancybox-edit-language-category' id='language_category_".$model->id."'  class='edit-category-lang btn btn-success btn-outline dim col-sm-4' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('categories.actions.Language')."'  data-original-title='".trans('categories.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('name', 'parent_category');
		$this->collection->orderColumns('name', 'parent_category');

		$this->collection->addColumn('name', function($model)
		{
			if($model->InCurrentLang)
				return $model->InCurrentLang->name;
		});

		$this->collection->addColumn('parent_category', function($model)
		{
			if($model->hasParent()) 
				return $model->parent->InCurrentLang->name;
			else
				return '';
		});

	}

}
