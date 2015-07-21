<?php
use s4h\store\States\StateRepository;
use Laracasts\Validation\FormValidationException;

class StateController extends \BaseController {

	private $repository;

	function __construct(StateRepository $repository) {
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

	public function getAllCitiesValue()
	{
		if (Request::ajax()) 
		{
			if (Input::has('stateId') && Input::get('stateId') > 0) 
			{
				$cities = $this->repository->getListOfCities(Input::get('stateId'));
				if (count($cities) > 0) {
					array_unshift($cities,trans('classifieds.all-conditions'));
					$this->setSuccess(true);
					$this->addToResponseArray('location', $cities);
					return $this->getResponseArrayJson();
				}else{
					return $this->getResponseArrayJson();
				}
			}
		}
		return $this->getResponseArrayJson();
	}


}
