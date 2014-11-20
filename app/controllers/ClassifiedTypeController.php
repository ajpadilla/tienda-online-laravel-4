<?php

use Laracasts\Validation\FormValidationException;
use s4h\store\Languages\LanguageRepository;
use s4h\store\Forms\RegisterClassifiedTypesForm;
use s4h\store\ClassifiedTypes\ClassifiedTypesRepository;

class ClassifiedTypeController extends \BaseController {
	private $languageRepository;
	private $registerClassifiedTypesForm;
	private $classifiedTypesRepository;

	function __construct(LanguageRepository $languageRepository, RegisterClassifiedTypesForm $registerClassifiedTypesForm, ClassifiedTypesRepository $classifiedTypesRepository) {
		$this->languageRepository = $languageRepository;
		$this->registerClassifiedTypesForm = $registerClassifiedTypesForm;
		$this->classifiedTypesRepository = $classifiedTypesRepository;
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
				$this->classifiedTypesRepository->createNewDiscountType($input);
				return Response::json(trans('classifiedTypes.message1') . ' ' . $input['name'] . ' ' . trans('classifiedTypes.message2'));
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
