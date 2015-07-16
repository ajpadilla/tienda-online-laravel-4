<?php

use s4h\store\InvoiceStatus\InvoiceStatusRepository;
use s4h\store\InvoiceStatusLang\InvoiceStatusLangRepository;
use s4h\store\Languages\LanguageRepository;
use s4h\store\Forms\RegisterInvoiceStatusForm;
use s4h\store\Forms\EditInvoiceStatusForm;
use s4h\store\Forms\EditInvoiceStatusFormLang;
use Laracasts\Validation\FormValidationException;

class InvoiceStatusController extends \BaseController {

	private $repository;
	private $invoiceStatusLangRepository;
	private $languageRepository;
	private $registerInvoiceStatusForm;
	private $editInvoiceStatusForm;
	private $editInvoiceStatusFormLang;

	function __construct(InvoiceStatusRepository $repository, 
		InvoiceStatusLangRepository $invoiceStatusLangRepository, 
		LanguageRepository $languageRepository, 
		RegisterInvoiceStatusForm $registerInvoiceStatusForm, 
		EditInvoiceStatusForm $editInvoiceStatusForm,
		EditInvoiceStatusFormLang $editInvoiceStatusFormLang) {

		$this->repository = $repository;
		$this->invoiceStatusLangRepository = $invoiceStatusLangRepository;
		$this->languageRepository = $languageRepository;
		$this->registerInvoiceStatusForm = $registerInvoiceStatusForm;
		$this->editInvoiceStatusForm = $editInvoiceStatusForm;
		$this->editInvoiceStatusFormLang = $editInvoiceStatusFormLang;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		$table = $this->repository->getAllTable();
		return View::make('invoice_status.index',compact('languages', 'table'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$languages = $this->languageRepository->getAllForSelect();
		return View::make('invoice_status.create',compact('languages'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Request::ajax()) 
		{
			$input = Input::all();
			try
			{
				$this->registerInvoiceStatusForm->validate($input);
				$this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('invoiceStatus.response'));
				return $this->getResponseArrayJson();	
			} 
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errors', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$invoiceStatus = $this->repository->getById($id);
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
		$invoiceStatus = $this->repository->getById($id);
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
	public function update()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editInvoiceStatusForm ->validate($input);
				$this->repository->update($input);
				return Response::json(trans('invoiceStatus.Updated'));
			}
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
			}
		}
	}

	public function updateApi() 
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editInvoiceStatusForm->validate($input);
				$this->repository->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('invoiceStatus.Updated'));
				return $this->getResponseArrayJson();
			}
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errors', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->repository->deleteInvoiceStatu($id);
		Flash::message(trans('invoiceStatus.Delete'));
		return Redirect::route('invoiceStatus.index');
	}

	public function deleteAjax()
	{
		if (Request::ajax())
		{
			if (Input::has('invoiceStatusId')) 
			{
				$this->repository->deleteInvoiceStatu(Input::get('invoiceStatusId'));
				return Response::json(['success' => true]);
			} else {
			 	return Response::json(['success' => false]);
			}
		}
		return Response::json(['success' => false]);
	}

	public function checkNameInvoiceStatus()
	{
		if (Request::ajax()) 
		{
			$input = Input::all();
			$invoice_status = $this->repository->getNameInvoiceStatus($input);
			if(count($invoice_status) > 0){
				return Response::json(false);
			}else{
				 return Response::json(true);
			}
		}
	}

	public function checkNameForEdit()
	{
		$response = array();
		if (Request::ajax()) {
			$invoice_status = $this->repository->getNameForEdit(Input::all());
			if (count($invoice_status) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('response' => 'false'));
	}


	public function returnDataInvoiceStatus(){
		if (Request::ajax())
		{
			if (Input::has('invoiceStatusId'))
			{
				$shipmentStatus = $this->repository->getArrayInCurrentLangData(Input::get('invoiceStatusId'));
				return Response::json($shipmentStatus);
			}else{
				return Response::json(['success' => false]);
			}
		}
	}

	public function returnDatainvoiceStatusLang()
	{
		if (Request::ajax())
		{
			if (Input::has('invoiceStatusId') && Input::has('languageId'))
			{
				 $invoiceStatusLang = $this->repository->getDataForLanguage(Input::get('invoiceStatusId'), Input::get('languageId'));
				 return Response::json($invoiceStatusLang);
			}else{
				return Response::json(['success' => false]);
			}
		}
	}

	public function saveDataForLanguage()
	{

		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->repository->updateData($input);
				return Response::json([trans('invoiceStatus.Updated')]);
			}
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
			}
		}
	}

	public function listApi(){
		return $this->repository->getDefaultTableForAll();
	}

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('invoiceStatusId'))
			{
				$invoiceStatus = $this->repository->getArrayInCurrentLangData(Input::get('invoiceStatusId'));
				$this->setSuccess(true);
				$this->addToResponseArray('invoiceStatus', $invoiceStatus);
				return $this->getResponseArrayJson();
			}else{
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
	}

	public function showApiLang()
	{
		if (Request::ajax())
		{
			if (Input::has('invoiceStatusId') && Input::has('languageId'))
			{
				$invoiceStatusLang = $this->repository->getDataForLanguage(Input::get('invoiceStatusId'), Input::get('languageId'));
				$this->setSuccess(true);
				$this->addToResponseArray('invoiceStatusLang', $invoiceStatusLang);
				return $this->getResponseArrayJson();
			}else{
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
	}

	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('invoiceStatusId')));
		return $this->getResponseArrayJson();
	}

	public function updateApiLang()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editInvoiceStatusFormLang->validate($input);
				$this->repository->updateLanguage($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('invoiceStatus.Updated'));
				return $this->getResponseArrayJson();
			}
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errors', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
	}

}
