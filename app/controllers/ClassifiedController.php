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

class ClassifiedController extends \BaseController {

	private $classifiedRepository;
	private $classifiedConditionsRepository;
	private $classifiedTypesRepository;
	private $userRepository;
	private $languageRepository;
	private $registerClassifiedForm;
	private $editClassifiedForm;
	private $countryRepository;

	function __construct(ClassifiedRepository $classifiedRepository, 
		ClassifiedConditionsRepository $classifiedConditionsRepository, 
		ClassifiedTypesRepository $classifiedTypesRepository, 
		UserRepository $userRepository,
		LanguageRepository $languageRepository, 
		ClassifiedsLangRepository $classifiedLangRepository,
		RegisterClassifiedForm $registerClassifiedForm,
		EditClassifiedForm $editClassifiedForm,
		CountryRepository $countryRepository
	){

		$this->classifiedRepository = $classifiedRepository;
		$this->classifiedConditionsRepository = $classifiedConditionsRepository;
		$this->classifiedTypesRepository = $classifiedTypesRepository;
		$this->userRepository = $userRepository;
		$this->languageRepository = $languageRepository;
		$this->classifiedLangRepository = $classifiedLangRepository;
		$this->registerClassifiedForm = $registerClassifiedForm;
		$this->editClassifiedForm = $editClassifiedForm;
		$this->countryRepository = $countryRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('classifieds.index');
	}

	public function getDatatable()
	{
		$collection = Datatable::collection($this->classifiedLangRepository->getAllForLanguage($this->languageRepository->returnLanguage()->id))
			->searchColumns('name','description', 'address')
			->orderColumns('name','description', 'address');

		$collection->addColumn('photo', function($model)
		{
			$links = '';
			$i = 0;
			foreach ($model->classified->photos as $photo) {
				if ($i < 3) {
					$links .= "	<a href='#'>
									<img class='mini-photo' alt='" . $photo->filename . "' src='" . asset($photo->complete_path) . "'>
								</a>";
				} else {
					break;
				}
				$i++;
			}

			return $links;
		});

		$collection->addColumn('name', function($model)
		{
			return $model->name;
		});
		
		$collection->addColumn('description', function($model)
		{
			return $model->description;
		});

		$collection->addColumn('address', function($model)
		{
			return $model->address;
		});

		$collection->addColumn('address', function($model)
		{
			return $model->address;
		});

		$collection->addColumn('user', function($model)
		{
			return $model->classified->user->username;
		});

		$collection->addColumn('classified_type', function($model)
		{
			$language = $this->languageRepository->returnLanguage();
			$classified_type_language = $model->classified->classifiedType->languages()->where('language_id','=',$language->id)->first();
			return $classified_type_language->pivot->name;
		});

		$collection->addColumn('classified_condition', function($model)
		{
			$language = $this->languageRepository->returnLanguage();
			$classified_condition_language = $model->classified->classifiedCondition->languages()->where('language_id','=',$language->id)->first();
			return $classified_condition_language->pivot->name;
		});

		$collection->addColumn('Actions',function($model){
			
			$links = "<a class='btn btn-info btn-circle' href='" . route('classifieds.show', $model->classified->id) . "'><i class='fa fa-check'></i></a>
					<br />";
			$links .= "<a a class='btn btn-warning btn-circle' href='" . route('classifieds.edit', $model->classified->id) . "'><i class='fa fa-pencil'></i></a>
					<br />
					<a class='btn btn-danger btn-circle' href='" . route('classifieds.destroy', $model->classified->id) . "'><i class='fa fa-times'></i></a>";

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
		$classified_conditions = $this->classifiedConditionsRepository->getNameForLanguage(); 
		$classified_types = $this->classifiedTypesRepository->getNameForLanguage();
		return View::make('classifieds.create', compact('languages','classified_conditions','classified_types'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		try
		{
			$this->registerClassifiedForm->validate($input);
			$classified = $this->classifiedRepository->createNewClassified($input);
			if ($input['add_photos'] == 1) {
				Session::put('classified_id', $classified->id);
				Session::put('language_id', $input['language_id']);
				return Response::json(['message' => trans('classifieds.response'), 
										'add_photos'=>$input['add_photos']
				]);
			}
			return Response::json(['message' => trans('classifieds.response'), 'add_photos' => 0]);
		} 
		catch (FormValidationException $e)
		{
			return Response::json($e->getErrors()->all());
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
		$classified = $this->classifiedRepository->getClassifiedId($id);
		$language = $this->languageRepository->returnLanguage();
		$classifiedType = $classified->classifiedType->languages()->where('language_id','=',$language->id)->first();
		$classifiedConditions = $classified->classifiedCondition->languages()->where('language_id','=',$language->id)->first();
		$classified_language = $classified->languages()->where('language_id','=', $language->id)->first();
		return View::make('classifieds.show', compact('classified','classifiedType','classifiedConditions','classified_language'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$classified = $this->classifiedRepository->getClassifiedId($id);
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
	public function update($id)
	{
		$input = Input::all();
		//dd($input);
		$input['classified_id'] = $id;
		try
		{
			$this->editClassifiedForm->validate($input);
			$classified = $this->classifiedRepository->updateClassified($input);
			if ($input['add_photos'] == 1) {
				Session::put('classified_id', $classified->id);
				Session::put('language_id', $input['language_id']);
				return Response::json(['message' => trans('classifieds.response'), 
										'add_photos'=>$input['add_photos']
				]);
			}
			return Response::json(['message' => trans('classifieds.response'), 'add_photos' => 0]);
		} 
		catch (FormValidationException $e)
		{
			return Response::json($e->getErrors()->all());
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->classifiedRepository->delteClassified($id);
		Flash::message(trans('classifieds.Delete'));
		return Redirect::route('classifieds.index');
	}

	
	public function checkNameClassified() 
	{
		$response = array();
		if (Request::ajax()) {
			$classified = $this->classifiedRepository->getName(Input::all());
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
			$classified = $this->classifiedRepository->getNameForEdit(Input::all());
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
		$classifiedsResult = $this->classifiedRepository->search(Input::all());
		dd($classifiedsResult);
	}

	public function statesForCountry()
	{
		if (Request::ajax()) 
		{
			if (Input::has('countryId')) 
			{
				$states = $this->countryRepository->getListOfStates(Input::get('countryId'));
				if (count($states) > 0) {
					return Response::json(['success' => true, 'states' => $states]);
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
					return Response::json(['success' => true, 'cities' => $cities]);
				}else{
					return Response::json(['success' => false]);
				}
			}
		}
	}
}
