<?php

use Laracasts\Validation\FormValidationException;
use s4h\store\Languages\LanguageRepository;
use s4h\store\ClassifiedConditions\ClassifiedConditionsRepository;
use s4h\store\Forms\RegisterClassifiedConditionsForm;
use s4h\store\ClassifiedConditionsLang\ClassifiedConditionLangRepository;
use s4h\store\Forms\EditClassifiedConditionForm;


class ClassifiedConditionController extends \BaseController {
	private $languageRepository;
	private $repository;
	private $registerClassifiedConditionsForm;
	private $classifiedConditionLangRepository;
	private $editClassifiedConditionForm;

	function __construct(LanguageRepository $languageRepository, 
		ClassifiedConditionsRepository $repository, 
		RegisterClassifiedConditionsForm $registerClassifiedConditionsForm,
		ClassifiedConditionLangRepository $classifiedConditionLangRepository,
		EditClassifiedConditionForm $editClassifiedConditionForm) {

		$this->languageRepository = $languageRepository ;
		$this->repository = $repository;
		$this->registerClassifiedConditionsForm = $registerClassifiedConditionsForm;
		$this->classifiedConditionLangRepository = $classifiedConditionLangRepository;
		$this->editClassifiedConditionForm = $editClassifiedConditionForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('classified_conditions.index');
	}

	public function getDatatable()
	{
		$collection = Datatable::collection($this->classifiedConditionLangRepository->getAllForLanguage($this->languageRepository->returnLanguage()->id))
			->searchColumns('name')
			->orderColumns('name');

		$collection->addColumn('name', function($model)
		{
			return $model->name;
		});
	
		$collection->addColumn('Actions',function($model){
		
			$links = "<a class='btn btn-info btn-circle' href='" . route('classifiedConditions.show', $model->classifiedCondition->id) . "'><i class='fa fa-check'></i></a>
					<br />";
			$links .= "<a a class='btn btn-warning btn-circle' href='" . route('classifiedConditions.edit', $model->classifiedCondition->id) . "'><i class='fa fa-pencil'></i></a>
					<br />
					<a class='btn btn-danger btn-circle' href='" . route('classifiedConditions.destroy', $model->classifiedCondition->id) . "'><i class='fa fa-times'></i></a>";

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
		return View::make('classified_conditions.create',compact('languages'));
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
				$this->registerClassifiedConditionsForm->validate($input);
				$this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('classifiedConditions.response'));
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
		$classified_condition = $this->repository->getClassifiedConditionId($id);
		$language = $this->languageRepository->returnLanguage();
		$classified_condition_language = $classified_condition->languages()->where('language_id','=', $language->id)->first();
		return View::make('classified_conditions.show',compact('classified_condition_language'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$classified_condition = $this->repository->getClassifiedConditionId($id);
		$language_id = $this->languageRepository->returnLanguage()->id;
		$classified_condition_language = $classified_condition->languages()->where('language_id','=',$language_id)->first();
		$languages = $this->languageRepository->getAll()->lists('name','id');
		return View::make('classified_conditions.edit',compact('classified_condition','classified_condition_language','languages'));
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
			$input['classified_condition_id'] = $id;
			try
			{
				$this->editClassifiedConditionForm->validate($input);
				$this->repository->updateClassifiedCondition($input);
				return Response::json(trans('classifiedConditions.Actualiced'));
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
		//
	}

	public function checkNameClassifiedCondition() 
	{
		$response = array();
		if (Request::ajax()) {
			$classified_condition = $this->repository->getName(Input::all());
			if (count($classified_condition) > 0) {
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
			$classified_condition = $this->repository->getNameForEdit(Input::all());
			if (count($classified_condition) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('response' => 'false'));
	}

	public function returnDataForLang()
	{
		if (Request::ajax()) 
		{
			$classifiedsCoonditionsLang = $this->repository->getNameForLanguage();
			array_unshift($classifiedsCoonditionsLang,trans('classifiedConditions.all-conditions'));
			return Response::json(['success' => true, 'data'=> $classifiedsCoonditionsLang]);
		}
		return Response::json(['success' => false]);
	}

	public function listApi(){
		return $this->repository->getDefaultTableForAll();
	}

}
