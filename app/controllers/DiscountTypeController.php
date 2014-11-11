<?php

use s4h\store\DiscountsTypes\DiscountType;
use s4h\store\DiscountsTypes\DiscountTypeRepository;
use s4h\store\Forms\RegisterDiscountTypeForm;
use Laracasts\Validation\FormValidationException;

class DiscountTypeController extends \BaseController {

	private $discountTypeRepository;
	private $registerDiscountTypeForm;

	function __construct(RegisterDiscountTypeForm $registerDiscountTypeForm, DiscountTypeRepository $discountTypeRepository){
		$this->discountTypeRepository = $discountTypeRepository;
		$this->registerDiscountTypeForm = $registerDiscountTypeForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//return "Hola";
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('discounts_types.create');
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
			$input = array();
			$input['name'] = Input::get('name');
			$input['language_id'] = Session::get('language_id');
			//dd($input);
			try
			{
				$this->registerDiscountTypeForm->validate($input);
				$this->discountTypeRepository->createNewDiscountType($input);
				return Response::json(trans('discounts.message1').' '.$input['name'].' '.trans('discounts.message2'));
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

	public function checkName()
	{
		$response = array();
		if(Request::ajax()) 
		{
			$discount_type = $this->discountTypeRepository->getName(Input::get('name'));
			if(count($discount_type) > 0){
				return Response::json(false);
			}else{
				 return Response::json(true);
			}
       	}
		return Response::json(array('respuesta' => 'false'));	
	}

}
