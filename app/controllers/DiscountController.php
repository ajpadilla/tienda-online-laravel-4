<?php

use s4h\store\Discounts\Discount;
use s4h\store\Discounts\DiscountRepository;
use s4h\store\DiscountsTypes\DiscountType;
use s4h\store\DiscountsTypes\DiscountTypeRepository;
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
		return View::make('discounts.index');
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
			//dd($input);
			try
			{
				$this->registerDiscountForm->validate($input);
				$this->discountRepository->createNewDiscount($input);
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
		return "Show:".$id;
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
		return "Destroy:".$id;
	}

	public function getDatatable()
	{
		$collection = Datatable::collection($this->discountRepository->getAll())
			->showColumns('code','discount_type_id','name', 'value', 'percent', 'active', 'from', 'to')
			->searchColumns('code','discount_type_id','name', 'value', 'percent', 'active', 'from', 'to')
			->orderColumns('code','discount_type_id','name', 'value', 'percent', 'active', 'from', 'to');

		$collection->addColumn('code', function($model)
		{
			return $model->code;
		});

		$collection->addColumn('discount_type_id', function($model)
		{
			 return $model->discountType->name;
		});
		
		$collection->addColumn('name', function($model)
		{
			return $model->name;
		});

		$collection->addColumn('value', function($model)
		{
			return $model->value;
		});

		$collection->addColumn('percent', function($model)
		{
			return $model->percent;
		});

		$collection->addColumn('active', function($model)
		{
			return $model->getActivoShow();
		});

		$collection->addColumn('from', function($model)
		{
			return date( trans('discounts.date2') ,strtotime($model->from));
		});

		$collection->addColumn('to', function($model)
		{
			return date(trans('discounts.date2') ,strtotime($model->to));
		});

		$collection->addColumn('Actions',function($model){
			/*$links = "<a href='" .route('discounts.show', $model->id). "'>View</a>
					<br />";
			$links .= "<a href='" .route('discounts.edit', $model->id). "'>Edit</a>
					<br />
					<a href='" .URL::to('delete', $model->id). "'>Delete</a>";

			return $links;*/
		});

		return $collection->make();
	}

	public function checkCode()
	{
		if(Request::ajax()) 
		{
			$discount = $this->discountRepository->getCode(Input::get('code'));
			if(count($discount) > 0){
				return Response::json(false);
			}else{
				 return Response::json(true);
			}
       	}
		return Response::json(array('respuesta' => 'false'));
	}

}
