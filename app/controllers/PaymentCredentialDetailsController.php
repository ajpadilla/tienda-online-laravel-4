<?php

use s4h\store\PaymentCredentialDetails\PaymentCredentialDetailsRepository;
use Laracasts\Validation\FormValidationException;
use s4h\store\PaymentsTypes\PaymentsTypesRepository;
use s4h\store\CardBrands\CardBrandsRepository;
use s4h\store\Forms\RegisterCredentialsForm;


class PaymentCredentialDetailsController extends \BaseController {

	protected $paymentCredentialDetailsRepository;
	protected $paymentsTypesRepository;
	protected $cardBrandsRepository;
	protected $registerCredentialsForm;

	public function __construct(PaymentCredentialDetailsRepository $paymentCredentialDetailsRepository,
		PaymentsTypesRepository	$paymentsTypesRepository,
		CardBrandsRepository $cardBrandsRepository,
		RegisterCredentialsForm $registerCredentialsForm
		) {
		$this->paymentCredentialDetailsRepository = $paymentCredentialDetailsRepository;
		$this->paymentsTypesRepository = $paymentsTypesRepository;
		$this->cardBrandsRepository = $cardBrandsRepository;
		$this->registerCredentialsForm = $registerCredentialsForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$paymentsTypes = $this->paymentsTypesRepository->getNameForLanguage();
		$cardBrands = $this->cardBrandsRepository->listAll();
		return View::make('payment_credential_details.index',compact('paymentsTypes','cardBrands'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$paymentsTypes = $this->paymentsTypesRepository->getNameForLanguage();
		$cardBrands = $this->cardBrandsRepository->listAll();
		return View::make('payment_credential_details.create', compact('paymentsTypes','cardBrands'));
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
				$input['users_id'] = Auth::user()->id;
				$this->registerCredentialsForm->validate($input);
				$credential = $this->paymentCredentialDetailsRepository->create($input);
				return Response::json([trans('PaymentCredentialDetails.response')]);
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
