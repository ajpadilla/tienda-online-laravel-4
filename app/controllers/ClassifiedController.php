<?php

use Laracasts\Validation\FormValidationException;
use s4h\store\Languages\LanguageRepository;
use s4h\store\Classifieds\ClassifiedRepository;
use s4h\store\ClassifiedConditions\ClassifiedConditionsRepository;
use s4h\store\ClassifiedTypes\ClassifiedTypesRepository;
use s4h\store\Users\UserRepository;
use s4h\store\ClassifiedsLang\ClassifiedsLangRepository;
use s4h\store\Forms\RegisterClassifiedForm;
use s4h\store\Forms\EditClassifiedForm;
use s4h\store\Countries\CountryRepository;
use s4h\store\Forms\EditClassifiedLangForm;

class ClassifiedController extends \BaseController {

	private $repository;
	private $classifiedConditionsRepository;
	private $classifiedTypesRepository;
	private $userRepository;
	private $languageRepository;
	private $registerClassifiedForm;
	private $editClassifiedForm;
	private $countryRepository;
	private $editClassifiedLangForm;

	function __construct(ClassifiedRepository $repository, 
		ClassifiedConditionsRepository $classifiedConditionsRepository, 
		ClassifiedTypesRepository $classifiedTypesRepository, 
		UserRepository $userRepository,
		LanguageRepository $languageRepository, 
		ClassifiedsLangRepository $classifiedLangRepository,
		RegisterClassifiedForm $registerClassifiedForm,
		EditClassifiedForm $editClassifiedForm,
		CountryRepository $countryRepository,
		EditClassifiedLangForm $editClassifiedLangForm
	){

		$this->repository = $repository;
		$this->classifiedConditionsRepository = $classifiedConditionsRepository;
		$this->classifiedTypesRepository = $classifiedTypesRepository;
		$this->userRepository = $userRepository;
		$this->languageRepository = $languageRepository;
		$this->classifiedLangRepository = $classifiedLangRepository;
		$this->registerClassifiedForm = $registerClassifiedForm;
		$this->editClassifiedForm = $editClassifiedForm;
		$this->countryRepository = $countryRepository;
		$this->editClassifiedLangForm = $editClassifiedLangForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$languages = $this->languageRepository->getAllForSelect();
		$classifiedConditions = $this->classifiedConditionsRepository->getAllForCurrentLang(); 
		$classifiedTypes = $this->classifiedTypesRepository->getAllForCurrentLang();
		$categories = $this->categoryRepository->getAllForCurrentLang();
		$table = $this->repository->getAllTable();
		return View::make('classifieds.index', compact('languages','classifiedConditions','classifiedTypes','categories','table'));
	}

	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$languages = $this->languageRepository->getAllForSelect();
		$classifiedConditions = $this->classifiedConditionsRepository->getAllForCurrentLang(); 
		$classifiedTypes = $this->classifiedTypesRepository->getAllForCurrentLang();
		$categories = $this->categoryRepository->getAllForCurrentLang();
		return View::make('classifieds.create', compact('languages','classifiedConditions','classifiedTypes','categories'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$input['user_id'] = Auth::user()->id;
				$this->registerClassifiedForm->validate($input);
				$classified = $this->repository->create($input);
				$this->setSuccess(true);
				if ($input['add_photos'] == 1) {
					$this->addToResponseArray('message', trans('classifieds.response'));
					$this->addToResponseArray('add_photos', $input['add_photos']);
					$this->addToResponseArray('url', URL::route('photoClassified.create',[$classified->id, $input['language_id'] ]));
					$this->addToResponseArray('data', $input);
					return $this->getResponseArrayJson();
				}
				$this->addToResponseArray('message', trans('classifieds.response'));
				$this->addToResponseArray('add_photos', 0);
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
		$classified = $this->repository->get($id);
		$classifiedType = $classified->classifiedType->InCurrentLang;
		$classifiedConditions = $classified->classifiedCondition->InCurrentLang;
		$classifiedLanguage = $classified->InCurrentLang;
		return View::make('classifieds.show', compact('classified','classifiedType','classifiedConditions','classifiedLanguage'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$classified = $this->repository->getById($id);
		$language = $this->languageRepository->returnLanguage();
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		$classified_conditions = $this->classifiedConditionsRepository->getNameForLanguage();
		$classified_types = $this->classifiedTypesRepository->getNameForLanguage();
		$classified_language = $classified->languages()->where('language_id','=', $language->id)->first();
		return View::make('classifieds.edit', compact('classified','languages','classified_conditions','classified_types','classified_language'));
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
				$input['user_id'] = Auth::user()->id;
				$this->registerClassifiedForm->validate($input);
				$classified = $this->repository->update($input);
				$this->setSuccess(true);
				if ($input['add_photos'] == 1) {
					$this->addToResponseArray('message', trans('classifieds.Actualiced'));
					$this->addToResponseArray('add_photos', $input['add_photos']);
					$this->addToResponseArray('url', URL::route('photoClassified.create',[$classified->id, $input['language_id'] ]));
					$this->addToResponseArray('data', $input);
					return $this->getResponseArrayJson();
				}
				$this->addToResponseArray('message', trans('classifieds.Actualiced'));
				$this->addToResponseArray('add_photos', 0);
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
		$this->repository->delteClassified($id);
		Flash::message(trans('classifieds.Delete'));
		return Redirect::route('classifieds.index');
	}

	
	public function checkNameClassified() 
	{
		$response = array();
		if (Request::ajax()) {
			$classified = $this->repository->getName(Input::all());
			if (count($classified) > 0) {
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
			$classified = $this->repository->getNameForEdit(Input::all());
			if (count($classified) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('response' => 'false'));
	}


	public function viewSearchClassifieds()
	{
		$country = $this->countryRepository->getNameForLanguage();
		$classifiedConditions = $this->classifiedConditionsRepository->getNameForLanguage(); 
		$classifiedTypes = $this->classifiedTypesRepository->getNameForLanguage();
		return View::make('classifieds.search-classified',compact('country','classifiedConditions','classifiedTypes'));
	}

	public function searchClassified()
	{
		$classifiedsResult = $this->repository->search(Input::all());
		//dd($classifiedsResult);
		return View::make('classifieds.filtered-classisied',compact('classifiedsResult'));
	}

	public function countries()
	{
		if (Request::ajax()) 
		{
			$countries = $this->countryRepository->getNameForLanguage();
			array_unshift($countries,trans('classifieds.all-conditions'));
			return Response::json(['success' => true, 'data'=> $countries]);
		}else{
			return Response::json(['success' => false]);
		}
	}

	public function statesForCountry()
	{
		if (Request::ajax()) 
		{
			if (Input::has('countryId')) 
			{
				$states = $this->countryRepository->getListOfStates(Input::get('countryId'));
				if (count($states) > 0) {
					array_unshift($states,trans('classifieds.all-conditions'));
					return Response::json(['success' => true, 'location' => $states]);
				}else{
					return Response::json(['success' => false]);
				}
			}
		}
	}

	public function citiesForState()
	{
		if (Request::ajax()) 
		{
			if (Input::has('stateId')) 
			{
				$cities = $this->countryRepository->getListOfCities(Input::get('stateId'));
				if (count($cities) > 0) {
					array_unshift($cities,trans('classifieds.all-conditions'));
					return Response::json(['success' => true, 'location' => $cities]);
				}else{
					return Response::json(['success' => false]);
				}
			}
		}
	}


	public function showApi()
	{
		if (Request::ajax()) 
		{
			if (Input::has('classifiedId')) 
			{
				$classified = $this->repository->get(Input::get('classifiedId'));
				$classifiedLanguage = $classified->InCurrentLang;
				$categories = $classifiedLanguage->classified->getCategorieIds();
				$this->setSuccess(true);
				$this->addToResponseArray('classified', $classifiedLanguage);
				$this->addToResponseArray('categories',  $categories);
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
			if (Input::has('classifiedId') && Input::has('languageId')) 
			{
				 $classified = $this->repository->get(Input::get('classifiedId'));
				 $classifiedLang = $classified->getAccessorInCurrentLang(Input::get('languageId'));

				 if (count($classifiedLang) > 0) 
				 {
				 	$this->setSuccess(true);
					$this->addToResponseArray('classifiedLang', $classifiedLang);
					return $this->getResponseArrayJson();	
				 }else{
				 	return $this->getResponseArrayJson();	
				 }
			}else{
				return $this->getResponseArrayJson();	
			}
		}
		return $this->getResponseArrayJson();	
	}

	public function updateLangApi()
	{

		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editClassifiedLangForm->validate($input);
				$classified = $this->repository->get($input['classified_id']);
				$this->repository->updateLanguage($classified, $input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('classifieds.Actualiced'));
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

	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('classifiedId')));
		return $this->getResponseArrayJson();
	}

	public function listApi()
	{
		return $this->repository->getDefaultTableForAll();
	}

}
