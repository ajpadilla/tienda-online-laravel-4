<?php

use s4h\store\Discounts\Discount;
use s4h\store\Discounts\DiscountRepository;
use s4h\store\Forms\RegisterDiscountForm;

class DiscountController extends \BaseController {

	private $registerDiscountForm;
	private $discountRepository;

	function __construct(RegisterDiscountForm $registerDiscountForm,DiscountRepository $discountRepository)
	{
		$this->registerDiscountForm = $registerDiscountForm;
		$this->discountRepository = $discountRepository;	
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
		return View::make('discounts.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		dd(Input::all());
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
