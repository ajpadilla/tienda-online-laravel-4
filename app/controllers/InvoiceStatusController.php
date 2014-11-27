<?php

use s4h\store\InvoiceStatus\InvoiceStatusRepository;
use s4h\store\InvoiceStatusLang\InvoiceStatusLangRepository;
use s4h\store\Languages\LanguageRepository;
use s4h\store\Forms\RegisterInvoiceStatusForm;
use s4h\store\Forms\EditInvoiceStatusForm;
use Laracasts\Validation\FormValidationException;

class InvoiceStatusController extends \BaseController {

	private $invoiceStatusRepository;
	private $invoiceStatusLangRepository;
	private $languageRepository;
	private $registerInvoiceStatusForm;
	private $editInvoiceStatusForm;

	function __construct(InvoiceStatusRepository $invoiceStatusRepository, InvoiceStatusLangRepository $invoiceStatusLangRepository, LanguageRepository $languageRepository, RegisterInvoiceStatusForm $registerInvoiceStatusForm, EditInvoiceStatusForm $editInvoiceStatusForm) {
		$this->invoiceStatusRepository = $invoiceStatusRepository;
		$this->invoiceStatusLangRepository = $invoiceStatusLangRepository;
		$this->languageRepository = $languageRepository;
		$this->registerInvoiceStatusForm = $registerInvoiceStatusForm;
		$this->editInvoiceStatusForm = $editInvoiceStatusForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('invoice_status.index');
	}

	public function getDatatable(){

		$collection = Datatable::collection($this->invoiceStatusLangRepository->getAllForLanguage($this->languageRepository->returnLanguage()->id))
			->searchColumns('color','name','description')
			->orderColumns('color','name','description');

		$collection->addColumn('color', function($model)
		{
			return  "<input type='text' class='form-control' STYLE='background-color: ".$model->invoiceStatus->color.";' size='5' readonly>";
		});

		$collection->addColumn('name', function($model)
		{
			return $model->name;
		});

		$collection->addColumn('description', function($model)
		{
			return $model->description;
		});
	
		$collection->addColumn('Actions',function($model){
			
			$links = "<a class='btn btn-info' href='" . route('invoiceStatus.show', $model->invoiceStatus->id) . "'>".trans('invoiceStatus.actions.Show')." <i class='fa fa-check'></i></a>
					<br />";
			$links .= "<a a class='btn btn-warning' href='" . route('invoiceStatus.edit', $model->invoiceStatus->id) . "'>".trans('invoiceStatus.actions.Edit')." <i class='fa fa-pencil'></i></a>
					<br />
					<a class='btn btn-danger' href='" . route('invoiceStatus.destroy', $model->invoiceStatus->id) . "'>".trans('invoiceStatus.actions.Delete')." <i class='fa fa-times'></i></a>";

			return $links;
		});

		return $collection->make();
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$languages = $this->languageRepository->getAll()->lists('name','id');
		return View::make('invoice_status.create',compact('languages'));
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
				$this->registerInvoiceStatusForm->validate($input);
				$this->invoiceStatusRepository->createNewInvoiceStatus($input);
				return Response::json(trans('invoiceStatus.response'));
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
		$invoiceStatus = $this->invoiceStatusRepository->getInvoicetStatus($id);
		$language_id = $this->languageRepository->returnLanguage()->id;
		$invoiceStatusLanguage = $invoiceStatus->languages()->where('language_id','=',$language_id)->first();
		return View::make('invoice_status.show',compact('invoiceStatus','invoiceStatusLanguage'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$invoiceStatus = $this->invoiceStatusRepository->getInvoicetStatus($id);
		$language_id = $this->languageRepository->returnLanguage()->id;
		$invoiceStatusLanguage = $invoiceStatus->languages()->where('language_id','=',$language_id)->first();
		$languages = $this->languageRepository->getAll()->lists('name','id');
		return View::make('invoice_status.edit',compact('invoiceStatus','invoiceStatusLanguage','languages'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(Request::ajax())
		{
			$input = array();
			$input = Input::all();
			$input['invoice_status_id'] = $id;
			try
			{
				$this->editInvoiceStatusForm ->validate($input);
				$this->invoiceStatusRepository->updateInvoiceStatu($input);
				return Response::json(trans('invoiceStatus.updated'));
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
	public function destroy($id)
	{
		$this->invoiceStatusRepository->deleteInvoiceStatu($id);
		Flash::message(trans('invoiceStatus.delete'));
		return Redirect::route('invoiceStatus.index');
	}

	public function checkNameInvoiceStatus()
	{
		if (Request::ajax()) 
		{
			$input = Input::all();
			$invoice_status = $this->invoiceStatusRepository->getNameInvoiceStatus($input);
			if(count($invoice_status) > 0){
				return Response::json(false);
			}else{
				 return Response::json(true);
			}
		}
	}

}
