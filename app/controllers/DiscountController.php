<?php

use s4h\store\Discounts\Discount;
use s4h\store\Discounts\DiscountRepository;
use s4h\store\Discounts_types\DiscountTypeRepository;
use s4h\store\Forms\RegisterDiscountForm;
use Laracasts\Validation\FormValidationException;

class DiscountController extends \BaseController {

	private $registerDiscountForm;
	private $discountRepository;
	private $discountTypeRepository;

	function __construct(RegisterDiscountForm $registerDiscountForm,DiscountRepository $discountRepository, DiscountTypeRepository $discountTypeRepository)
	{
		$this->registerDiscountForm = $registerDiscountForm;
		$this->discountRepository = $discountRepository;	
		$this->discountTypeRepository = $discountTypeRepository;
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
		$discountTypes = $this->discountTypeRepository->getAll()->lists('name', 'id');
		return View::make('discounts.create',compact('discountTypes'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//dd(Input::all());
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->registerDiscountForm->validate($input);
				$this->createNewDiscount($input);
				return Response::json('Descuento'.' '.$input['name'].' '.'Agregado con exito!');
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

	public function createNewDiscount($data = array())
	{
		$discount = new Discount;
		$discount->name = $data['name'];
		$discount->description = $data['description'];
		$discount->value = $data['value'];
		$discount->percent = $data['percent'];
		$discount->quantity = $data['quantity'];
		$discount->quantity_per_user = $data['quantity_per_user'];
		$discount->code = $data['code'];
		$discount->active = $data['active'];
		$discount->from = $data['from'];
		$discount->to = $data['to'];
		$discount->discount_type_id = $data['discount_type_id'];
		$this->discountRepository->save($discount);
	}

}
