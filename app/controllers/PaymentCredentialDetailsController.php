<?php

use s4h\store\PaymentCredentialDetails\PaymentCredentialDetailsRepository;
use Laracasts\Validation\FormValidationException;
use s4h\store\PaymentsTypes\PaymentsTypesRepository;


class PaymentCredentialDetailsController extends \BaseController {

	protected $paymentCredentialDetailsRepository;
	protected $paymentsTypesRepository;

	public function __construct(PaymentCredentialDetailsRepository $paymentCredentialDetailsRepository,
		PaymentsTypesRepository	$paymentsTypesRepository
		) {
		$this->paymentCredentialDetailsRepository = $paymentCredentialDetailsRepository;
		$this->paymentsTypesRepository = $paymentsTypesRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$paymentsTypes = $this->paymentsTypesRepository->getNameForLanguage();
		return View::make('payment_credential_details.index',compact('paymentsTypes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$paymentsTypes = $this->paymentsTypesRepository->getNameForLanguage();
		return View::make('payment_credential_details.create', compact('paymentsTypes'));
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
				$this->registerProductForm->validate($input);
				$product = $this->productRepository->createNewProduct($input);
				if ($input['add_photos'] == 1) {
					return Response::json(['message' => trans('products.response'),
						'add_photos' => $input['add_photos'], 'url' => URL::route('photoProduct.create',$product->id)
					]);
				}
				return Response::json(['message' => trans('products.response'), 'add_photos' => 0]);
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

	public function getAllInCurrentLangData()
	{
		$collection = Datatable::collection($this->paymentCredentialDetailsRepository->getAll())
		->searchColumns('email','credit_cart_number','credit_cart_expire_date')
		->orderColumns('email','credit_cart_number','credit_cart_expire_date');

		$collection->addColumn('email', function($model)
		{
			return $model->email;
		});

		$collection->addColumn('credit_cart_number', function($model)
		{
			return $model->credit_cart_number;
		});

		$collection->addColumn('credit_cart_expire_date', function($model)
		{
			return $model->credit_cart_expire_date;
		});

		$collection->addColumn('payment_type', function($model)
		{
			return $model->paymentsTypes->getInCurrentLangAttribute()->name;
		});

		$collection->addColumn('user', function($model)
		{
			return $model->user->username;
		});

		$collection->addColumn('card_brand', function($model)
		{
			return $model->cardBrand->name;
		});

		$collection->addColumn('Actions', function($model)
		{
			return 0;
		});

		return $collection->make();
	}

}
