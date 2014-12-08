<?php

use s4h\store\Categories\CategoryRepository;
use s4h\store\Languages\LanguageRepository;
use s4h\store\CategoriesLang\CategoryLangRepository;

class CategoriesController extends \BaseController {
	private $categoryRepository;
	private $languageRepository;
	private $categoryLangRepository;

	function __construct(CategoryRepository $categoryRepository, LanguageRepository $languageRepository, CategoryLangRepository $categoryLangRepository) {
		$this->categoryRepository = $categoryRepository;
		$this->languageRepository = $languageRepository;
		$this->categoryLangRepository = $categoryLangRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('categories.index');
	}


	public function getDatatable()
	{
		$collection = Datatable::collection($this->categoryLangRepository->getAllForLanguage($this->languageRepository->returnLanguage()->id))
			->searchColumns('name','parent_category')
			->orderColumns('name','parent_category');

		$collection->addColumn('name', function($model)
		{
			$language = $this->languageRepository->returnLanguage();
			$categoryLanguage = $model->category->languages()->where('language_id','=',$language->id)->first();
			return $categoryLanguage->pivot->name;
		});

		$collection->addColumn('parent_category', function($model)
		{
			$language = $this->languageRepository->returnLanguage();

			if ($model->category->hasParent()) {
				$parentCategoryLanguage = $model->category->parent->languages()->where('language_id','=',$language->id)->first();
				return $parentCategoryLanguage->pivot->name;
			}else{
				$categoryLanguage = $model->category->languages()->where('language_id','=',$language->id)->first();
				return $categoryLanguage->pivot->name;
			}
		});

		$collection->addColumn('Actions',function($model){
		
			$links = "<a class='btn btn-info btn-circle' href='" . route('categories.show', $model->category->id) . "'><i class='fa fa-check'></i></a>
					<br />";
			$links .= "<a a class='btn btn-warning btn-circle' href='" . route('categories.edit', $model->category->id) . "'><i class='fa fa-pencil'></i></a>
					<br />
					<a class='btn btn-danger btn-circle' href='" . route('categories.destroy', $model->category->id) . "'><i class='fa fa-times'></i></a>";

			return $links;
		});

		return $collection->make();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		$categories = $this->categoryRepository->getNameForLanguage();
		return View::make('categories.create',compact('categories','languages'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Request::ajax()) 
		{
			$input = Input::all();
			try
			{
				//$this->registerClassifiedConditionsForm->validate($input);
				$this->categoryRepository->createNewCategory($input);
				return Response::json(trans('categories.response'));
			} 
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
			}
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$language = $this->languageRepository->returnLanguage();
		$category = $this->categoryRepository->getCategoryId($id);
		$categoryLanguage = $category->languages()->where('language_id','=',$language->id)->first();
		if ($category->hasParent()) {
			$parentCategoryLanguage = $category->parent->languages()->where('language_id','=',$language->id)->first();
		}
		return View::make('categories.show',compact('categoryLanguage','category','parentCategoryLanguage'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
