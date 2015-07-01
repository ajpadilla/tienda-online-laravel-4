<?php

use s4h\store\Languages\LanguageRepository;
use s4h\store\CategoriesLang\CategoryLangRepository;
use s4h\store\Forms\RegisterCategorieForm;
use Laracasts\Validation\FormValidationException;

class CategoriesController extends \BaseController {
	private $languageRepository;
	private $categoryLangRepository;
	private $registerCategorieForm;

	function __construct(LanguageRepository $languageRepository, 
		CategoryLangRepository $categoryLangRepository,
		RegisterCategorieForm $registerCategorieForm) {

		$this->languageRepository = $languageRepository;
		$this->categoryLangRepository = $categoryLangRepository;
		$this->registerCategorieForm = $registerCategorieForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = $this->categoryRepository->getAllTable();
		$languages = $this->languageRepository->getAllForSelect();
		$categories = $this->categoryRepository->getAllForCurrentLang();
		array_unshift($categories,"");
		return View::make('categories.index',compact('table', 'languages', 'categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$languages = $this->languageRepository->getAllForSelect();
		$categories = $this->categoryRepository->getAllForCurrentLang();
		array_unshift($categories,"");
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
				$this->registerCategorieForm->validate($input);
				$this->categoryRepository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('categories.response'));
				return $this->getResponseArrayJson();
			} 
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errors', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
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
		$language = $this->languageRepository->returnLanguage();
		$category = $this->categoryRepository->getCategoryId($id);
		$categoryLanguage = $category->languages()->where('language_id','=',$language->id)->first();
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		$categories = $this->categoryRepository->get();
		array_unshift($categories,"");
		return View::make('categories.edit',compact('languages','categories','category','categoryLanguage'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateApi()
	{
		if (Request::ajax()) 
		{
			$input = Input::all();
			try
			{
				$this->registerCategorieForm->validate($input);
				$this->categoryRepository->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('categories.Update'));
				return $this->getResponseArrayJson();
			} 
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errors', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->categoryRepository->deleteCategory($id);
		Flash::message(trans('categories.Delete'));
		return Redirect::route('categories.index');
	}

	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->categoryRepository->delete(Input::get('categoryId')));
		return $this->getResponseArrayJson();
	}

	public function returnDataCategoriesLang()
	{
		if (Request::ajax()) 
		{
			$categories = $this->categoryRepository->getNameForLanguage();
			return Response::json(['success' =>true, 'categories' => $categories]);
		}
	}

	public function listApi()
	{
		return $this->categoryRepository->getDefaultTableForAll();
	}

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('categoryId'))
			{
				$category = $this->categoryRepository->getArrayInCurrentLangData(Input::get('categoryId'));
				$this->setSuccess(true);
				$this->addToResponseArray('category', $category);
				return $this->getResponseArrayJson();
			}else{
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
	}

	public function showApiLang()
	{
		if (Request::ajax())
		{
			if (Input::has('categoryId') && Input::has('languageId'))
			{
				$categoryLang = $this->categoryRepository->getDataForLanguage(Input::get('categoryId'), Input::get('languageId'));
				$this->setSuccess(true);
				$this->addToResponseArray('categoryLang', $categoryLang);
				return $this->getResponseArrayJson();
			}else{
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
	}

	public function updateApiLang()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->registerCategorieForm->validate($input);
				$category = $this->categoryRepository->updateLanguage($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('categories.Updated'));
				$this->addToResponseArray('category', $category);
				return $this->getResponseArrayJson();
			}
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errors', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
	}

}
