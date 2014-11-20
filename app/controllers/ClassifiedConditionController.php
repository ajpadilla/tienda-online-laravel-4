<?php

use Laracasts\Validation\FormValidationException;
use s4h\store\Languages\LanguageRepository;
use s4h\store\ClassifiedConditions\ClassifiedConditionsRepository;
use s4h\store\Forms\RegisterClassifiedConditionsForm;


class ClassifiedConditionController extends \BaseController {
	private $languageRepository;
	private $classifiedConditionsRepository;
	private $registerClassifiedConditionsForm;

	function __construct(LanguageRepository $languageRepository, ClassifiedConditionsRepository $classifiedConditionsRepository, RegisterClassifiedConditionsForm $registerClassifiedConditionsForm) {

		$this->languageRepository = $languageRepository ;
		$this->classifiedConditionsRepository = $classifiedConditionsRepository;
		$this->registerClassifiedConditionsForm = $registerClassifiedConditionsForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
				$this->classifiedConditionsRepository->createNewClassifiedType($input);
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
		//
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
