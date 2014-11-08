<?php

 use s4h\store\Languages\LanguageRepository;
 use s4h\store\Forms\RegisterLanguageForm;
 use Laracasts\Validation\FormValidationException;

class LanguageController extends \BaseController {
	
	private $registerLanguageForm;
	private $languageRepository;

	function __construct(RegisterLanguageForm $registerLanguageForm, LanguageRepository $languageRepository) {
		$this->registerLanguageForm = $registerLanguageForm;
		$this->languageRepository = $languageRepository;
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
		return View::make('languages.create');
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
			//dd($input);
			try
			{
				$this->registerLanguageForm->validate($input);
				$this->languageRepository->createNewLanguage($input);
				return Response::json(trans('languages.message1').' '.$input['name'].' '.trans('languages.message2'));
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

	public function checkIsoCodeLang()
	{
		if(Request::ajax()) 
		{
			$language = $this->languageRepository->getIsoCode(Input::get('iso_code'));
			if(count($language) > 0){
				return Response::json(false);
			}else{
				 return Response::json(true);
			}
       	}
		return Response::json(array('respuesta' => 'false'));
	}

}
