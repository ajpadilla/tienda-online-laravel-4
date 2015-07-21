<?php
	
use Laracasts\Validation\FormValidationException;
use s4h\store\Countries\CountryRepository;

class CountryController extends \BaseController {

	private $repository;

	function __construct(CountryRepository $repository) {
		$this->repository = $repository;
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
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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

	public function getAllValues()
	{
		if(Request::ajax()) 
		{
			$countries = $this->repository->getAllForSelect();
			array_unshift($countries,trans('countries.all-conditions'));
			$this->setSuccess(true);
			$this->addToResponseArray('data', $countries);
			return $this->getResponseArrayJson();
		}
		return $this->getResponseArrayJson();
	}

	public function getAllStatesValue()
	{
		if (Request::ajax()) 
		{
			if (Input::has('countryId') && Input::get('countryId') > 0) 
			{
				$states = $this->repository->getListOfStates(Input::get('countryId'));
				if (count($states) > 0) {
					array_unshift($states,trans('classifieds.all-conditions'));
					$this->setSuccess(true);
					$this->addToResponseArray('location', $states);
					return $this->getResponseArrayJson();
				}else{
					return $this->getResponseArrayJson();
				}
			}
			return $this->getResponseArrayJson();
		}
		return $this->getResponseArrayJson();
	}


}
