<?php

use s4h\store\PaymentCredentialDetails\PaymentCredentialDetailsRepository;
use Laracasts\Validation\FormValidationException;
use s4h\store\PaymentsTypes\PaymentsTypesRepository;
use s4h\store\CardBrands\CardBrandsRepository;
use s4h\store\Forms\RegisterCredentialsForm;
use s4h\store\Forms\EditCredentialForm;


class PaymentCredentialDetailsController extends \BaseController {

	protected $paymentCredentialDetailsRepository;
	protected $paymentsTypesRepository;
	protected $cardBrandsRepository;
	protected $registerCredentialsForm;
	protected $editCredentialForm;

	public function __construct(PaymentCredentialDetailsRepository $paymentCredentialDetailsRepository,
		PaymentsTypesRepository	$paymentsTypesRepository,
		CardBrandsRepository $cardBrandsRepository,
		RegisterCredentialsForm $registerCredentialsForm,
		EditCredentialForm $editCredentialForm
		) {
		$this->paymentCredentialDetailsRepository = $paymentCredentialDetailsRepository;
		$this->paymentsTypesRepository = $paymentsTypesRepository;
		$this->cardBrandsRepository = $cardBrandsRepository;
		$this->registerCredentialsForm = $registerCredentialsForm;
		$this->editCredentialForm = $editCredentialForm;
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
	public function update()
	{
		//return Input::all();
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$input['users_id'] = Auth::user()->id;
				$this->editCredentialForm->validate($input);
				$credential = $this->paymentCredentialDetailsRepository->update($input);
				return trans('PaymentCredentialDetails.response');
			}
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
			}
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		if (Request::ajax())
		{
			if (Input::has('credentialId'))
			{
				$this->paymentCredentialDetailsRepository->delete(Input::get('credentialId'));
				return Response::json(['success' => true]);
			}else{
				return Response::json(['success' => false]);
			}
		}
		return Response::json(['success' => false]);
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
			
			$links =  "<button href='#fancybox-show-credential' id='show_".$model->id."' class='btn btn-success btn-outline dim col-sm-8 show' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('PaymentCredentialDetails.actions.Show')."'  data-original-title='".trans('PaymentCredentialDetails.actions.Show')."' ><i class='fa fa-check fa-2x'></i>
					 </button><br/>";

			$links.= "<button href='#fancybox-edit-credential' id='edit_".$model->id."' class='btn btn-warning btn-outline dim col-sm-8 edit' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('PaymentCredentialDetails.actions.Edit')."'  data-original-title='".trans('PaymentCredentialDetails.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
					 </button><br/>";

			$links.= "<button href='#' class='btn btn-danger btn-outline dim col-sm-8' id='delet_".$model->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('PaymentCredentialDetails.actions.Delete')."'  data-original-title='".trans('PaymentCredentialDetails.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
					 </button><br/>";

			return $links;
		});

		return $collection->make();
	}

	public function getData()
	{
		if (Request::ajax())
		{
			if (Input::has('credentialId'))
			{
				 $credential = $this->paymentCredentialDetailsRepository->getById(Input::get('credentialId'));
				 return Response::json(['success' => true, 
				 	'credential' => $credential,
				 	'paymentTypes' => $credential->paymentsTypes->getInCurrentLangAttribute()->name,
				 	'cardBrand' => $credential->cardBrand->name
				 	]);
			}else{
				return Response::json(['success' => false]);
			}
		}
	}

}
