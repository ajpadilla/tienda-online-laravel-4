<?php

use Laracasts\Validation\FormValidationException;
use s4h\store\Languages\LanguageRepository;
use s4h\store\Classifieds\ClassifiedRepository;
use s4h\store\ClassifiedConditions\ClassifiedConditionsRepository;
use s4h\store\ClassifiedTypes\ClassifiedTypesRepository;
use s4h\store\Users\UserRepository;
use s4h\store\ClassifiedsLang\ClassifiedsLangRepository;

class ClassifiedsController extends \BaseController {

	private $classifiedRepository;
	private $classifiedConditionsRepository;
	private $classifiedTypesRepository;
	private $userRepository;
	private $languageRepository;

	function __construct(ClassifiedRepository $classifiedRepository, ClassifiedConditionsRepository $classifiedConditionsRepository, ClassifiedTypesRepository $classifiedTypesRepository, UserRepository $userRepository,LanguageRepository $languageRepository, ClassifiedsLangRepository $classifiedLangRepository) {
		$this->classifiedRepository = $classifiedRepository;
		$this->classifiedConditionsRepository = $classifiedConditionsRepository;
		$this->classifiedTypesRepository = $classifiedTypesRepository;
		$this->userRepository = $userRepository;
		$this->languageRepository = $languageRepository;
		$this->classifiedLangRepository = $classifiedLangRepository;
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
			$links = "<a href='" .route('classifieds.show',$model->classified->id). "'>View</a>
					<br />";
			$links .= "<a href='" .route('classifieds.edit',$model->classified->id). "'>Edit</a>
					<br />
					<a href='" .route('classifieds.destroy',$model->classified->id). "'>Delete</a>";

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
		//dd($input);
		try
		{
			$classified = $this->classifiedRepository->createNewClassified($input);
			return Response::json(trans('classifieds.message1') . ' ' . $input['name'] . ' ' . trans('classifieds.message2'));
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
			$classified = $this->classifiedRepository->updateClassified($input);
			return Response::json(trans('classifieds.message1') . ' ' . $input['name'] . ' ' . trans('classifieds.message2'));
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
		Flash::message('¡Clasificado borrado con éxito!');
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
}
