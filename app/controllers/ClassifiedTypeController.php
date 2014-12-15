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
	private $classifiedTypesRepository;
	private $classifiedTypeLangRepository;
	private $editClassifiedTypeForm;

	function __construct(LanguageRepository $languageRepository, 
		RegisterClassifiedTypesForm $registerClassifiedTypesForm, 
		ClassifiedTypesRepository $classifiedTypesRepository, 
		ClassifiedTypeLangRepository $classifiedTypeLangRepository,
		EditClassifiedTypeForm $editClassifiedTypeForm) {

		$this->languageRepository = $languageRepository;
		$this->registerClassifiedTypesForm = $registerClassifiedTypesForm;
		$this->classifiedTypesRepository = $classifiedTypesRepository;
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
		return View::make('classified_types.index');
	}


	public function getDatatable()
	{
		$collection = Datatable::collection($this->classifiedTypeLangRepository->getAllForLanguage($this->languageRepository->returnLanguage()->id))
			->searchColumns('name')
			->orderColumns('name');

		$collection->addColumn('name', function($model)
		{
			return $model->name;
		});
	
		$collection->addColumn('Actions',function($model){
			
			$links = "<a class='btn btn-info btn-circle' href='" . route('classifiedTypes.show', $model->classifiedTypes->id) . "'><i class='fa fa-check'></i></a>
					<br />";
			$links .= "<a a class='btn btn-warning btn-circle' href='" . route('classifiedTypes.edit', $model->classifiedTypes->id) . "'><i class='fa fa-pencil'></i></a>
					<br />
					<a class='btn btn-danger btn-circle' href='" . route('classifiedTypes.destroy', $model->classifiedTypes->id) . "'><i class='fa fa-times'></i></a>";

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
				$this->classifiedTypesRepository->createNewClassifiedType($input);
				return Response::json(trans('classifiedTypes.response'));
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
		$classified_type = $this->classifiedTypesRepository->getClassifiedTypeId($id);
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
		$classified_type = $this->classifiedTypesRepository->getClassifiedTypeId($id);
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
	public function update($id)
	{
		if(Request::ajax())
		{
			$input = array();
			$input = Input::all();
			$input['classified_type_id'] = $id;
			try
			{
				$this->editClassifiedTypeForm->validate($input);
				$this->classifiedTypesRepository->updateClassifiedType($input);
				return Response::json(trans('classifiedTypes.Updated'));
			}
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
			}
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
		$this->classifiedTypesRepository->delteClassifiedType($id);
		Flash::message(trans('classifiedTypes.Delete'));
		return Redirect::route('classifiedTypes.index');
	}

	public function checkName() {
		$response = array();
		if (Request::ajax()) {
			$classified_type = $this->classifiedTypesRepository->getName(Input::all());
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
			$classified_type = $this->classifiedTypesRepository->getNameForEdit(Input::all());
			if (count($classified_type) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('response' => 'false'));
	}


}
