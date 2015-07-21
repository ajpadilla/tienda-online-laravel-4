<?php

use Laracasts\Validation\FormValidationException;
use s4h\store\Languages\LanguageRepository;
use s4h\store\Forms\RegisterClassifiedTypesForm;
use s4h\store\Forms\EditClassifiedTypeForm;
use s4h\store\ClassifiedTypes\ClassifiedTypesRepository;
use s4h\store\ClassifiedTypesLang\ClassifiedTypeLangRepository;

class ClassifiedTypeController extends \BaseController {
	private $languageRepository;
	private $registerClassifiedTypesForm;
	private $repository;
	private $classifiedTypeLangRepository;
	private $editClassifiedTypeForm;

	function __construct(LanguageRepository $languageRepository, 
		RegisterClassifiedTypesForm $registerClassifiedTypesForm, 
		ClassifiedTypesRepository $repository, 
		ClassifiedTypeLangRepository $classifiedTypeLangRepository,
		EditClassifiedTypeForm $editClassifiedTypeForm) {

		$this->languageRepository = $languageRepository;
		$this->registerClassifiedTypesForm = $registerClassifiedTypesForm;
		$this->repository = $repository;
		$this->classifiedTypeLangRepository = $classifiedTypeLangRepository;
		$this->editClassifiedTypeForm = $editClassifiedTypeForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$languages = $this->languageRepository->getAllForSelect();
		$table = $this->repository->getAllTable();
		return View::make('classified_types.index', compact('languages','table'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$languages = $this->languageRepository->getAllForSelect();
		return View::make('classified_types.create',compact('languages'));
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
				$this->registerClassifiedTypesForm->validate($input);
				$this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('classifiedTypes.response'));
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
		$classified_type = $this->repository->getClassifiedTypeId($id);
		$language = $this->languageRepository->returnLanguage();
		$classified_type_language = $classified_type->languages()->where('language_id','=', $language->id)->first();
		return View::make('classified_types.show',compact('classified_type_language'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$classified_type = $this->repository->getClassifiedTypeId($id);
		$language_id = $this->languageRepository->returnLanguage()->id;
		$classified_type_language = $classified_type->languages()->where('language_id','=',$language_id)->first();
		$languages = $this->languageRepository->getAll()->lists('name','id');
		return View::make('classified_types.edit',compact('classified_type','classified_type_language','languages'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateApi() 
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editClassifiedTypeForm->validate($input);
				$this->repository->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('classifiedTypes.Updated'));
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
		//
	}

	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('classifiedTypeId')));
		return $this->getResponseArrayJson();
	}

	public function checkName() {
		$response = array();
		if (Request::ajax()) {
			$classified_type = $this->repository->getName(Input::all());
			if (count($classified_type) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('respuesta' => 'false'));
	}

	public function checkNameForEdit()
	{
		$response = array();
		if (Request::ajax()) {
			$classified_type = $this->repository->getNameForEdit(Input::all());
			if (count($classified_type) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('response' => 'false'));
	}


	public function returnAllForCurrentLang()
	{
		if (Request::ajax()) 
		{
			$classifiedsTypes = $this->repository->getAllForCurrentLang();
			array_unshift($classifiedsTypes, trans('classifiedTypes.all-conditions'));
			$this->setSuccess(true);
			$this->addToResponseArray('data', $classifiedsTypes);
			return $this->getResponseArrayJson();
		}
		return $this->getResponseArrayJson();
	}

	public function listApi(){
		return $this->repository->getDefaultTableForAll();
	}

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('classifiedTypeId'))
			{
				$classifiedType = $this->repository->getArrayInCurrentLangData(Input::get('classifiedTypeId'));
				$this->setSuccess(true);
				$this->addToResponseArray('classifiedType', $classifiedType);
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
			if (Input::has('classifiedTypeId') && Input::has('languageId'))
			{
				$classifiedTypeLang = $this->repository->getDataForLanguage(Input::get('classifiedTypeId'), Input::get('languageId'));
				$this->setSuccess(true);
				$this->addToResponseArray('classifiedTypeLang', $classifiedTypeLang);
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
				$this->editClassifiedTypeForm->validate($input);
				$this->repository->updateLanguage($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('classifiedTypes.Updated'));
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
