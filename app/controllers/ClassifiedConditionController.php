<?php

use Laracasts\Validation\FormValidationException;
use s4h\store\Languages\LanguageRepository;
use s4h\store\ClassifiedConditions\ClassifiedConditionsRepository;
use s4h\store\Forms\RegisterClassifiedConditionsForm;
use s4h\store\ClassifiedConditionsLang\ClassifiedConditionLangRepository;

class ClassifiedConditionController extends \BaseController {
	private $languageRepository;
	private $classifiedConditionsRepository;
	private $registerClassifiedConditionsForm;
	private $classifiedConditionLangRepository;

	function __construct(LanguageRepository $languageRepository, ClassifiedConditionsRepository $classifiedConditionsRepository, RegisterClassifiedConditionsForm $registerClassifiedConditionsForm,
		ClassifiedConditionLangRepository $classifiedConditionLangRepository) {

		$this->languageRepository = $languageRepository ;
		$this->classifiedConditionsRepository = $classifiedConditionsRepository;
		$this->registerClassifiedConditionsForm = $registerClassifiedConditionsForm;
		$this->classifiedConditionLangRepository = $classifiedConditionLangRepository;
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
			$links = "<a href='" .route('classifiedConditions.show',$model->classifiedCondition->id). "'>View</a>
					<br />";
			$links .= "<a href='" .route('classifiedConditions.edit',$model->classifiedCondition->id). "'>Edit</a>
					<br />
					<a href='" .route('classifiedConditions.destroy',$model->classifiedCondition->id). "'>Delete</a>";

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
				$this->classifiedConditionsRepository->createNewClassifiedCondition($input);
				return Response::json(trans('classifiedConditions.message1') . ' ' . $input['name'] . ' ' . trans('classifiedConditions.message2'));
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
		$classified_condition = $this->classifiedConditionsRepository->getClassifiedConditionId($id);
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
		return "Edit:".$id;
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return "Update:".$id;
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return "destroy:".$id;
	}

	public function checkName() {
		$response = array();
		if (Request::ajax()) {
			$classified_condition = $this->classifiedConditionsRepository->getName(Input::all());
			if (count($classified_condition) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('respuesta' => 'false'));
	}

}
