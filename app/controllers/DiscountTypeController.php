<?php

use s4h\store\Discounts_types\DiscountType;
use s4h\store\Discounts_types\DiscountTypeRepository;
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
			$input = Input::all();
			try
			{
				$this->registerDiscountTypeForm->validate($input);
				$discount_type = new DiscountType;
				$discount_type->name = $input['name'];
				$this->discountTypeRepository->save($discount_type);
				return Response::json('Typo de descuento'.' '.$input['name'].' '.'Agregado con exito!');
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
