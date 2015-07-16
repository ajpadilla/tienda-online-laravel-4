<?php

use s4h\store\InvoiceStatus\InvoiceStatusRepository;
use s4h\store\InvoiceStatusLang\InvoiceStatusLangRepository;
use s4h\store\Languages\LanguageRepository;
use s4h\store\Forms\RegisterInvoiceStatusForm;
use s4h\store\Forms\EditInvoiceStatusForm;
use Laracasts\Validation\FormValidationException;

class InvoiceStatusController extends \BaseController {

	private $repository;
	private $invoiceStatusLangRepository;
	private $languageRepository;
	private $registerInvoiceStatusForm;
	private $editInvoiceStatusForm;

	function __construct(InvoiceStatusRepository $repository, 
		InvoiceStatusLangRepository $invoiceStatusLangRepository, 
		LanguageRepository $languageRepository, 
		RegisterInvoiceStatusForm $registerInvoiceStatusForm, 
		EditInvoiceStatusForm $editInvoiceStatusForm) {
		$this->repository = $repository;
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
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		$table = $this->repository->getAllTable();
		return View::make('invoice_status.index',compact('languages', 'table'));
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
			
			$languageId = $this->languageRepository->returnLanguage()->id;

			$links = "<form action='".route('invoiceStatus.show',$model->invoiceStatus->id)."' method='get'>
						<button href='#'  class='btn btn-success btn-outline dim col-sm-8 show' style='margin-left: 20px;' type='submit' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Show')."'  data-original-title='".trans('products.actions.Show')."' ><i class='fa fa-check fa-2x'></i></button><br/>
					  </form>";

			$links.= "<button href='#fancybox-edit-invoice-status' id='edit_".$model->invoiceStatus->id."' class='btn btn-warning btn-outline dim col-sm-8 edit' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Edit')."'  data-original-title='".trans('products.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
					 </button><br/>";

			$links.= "<button href='#' class='btn btn-danger btn-outline dim col-sm-8' id='delet_".$model->invoiceStatus->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Delete')."'  data-original-title='".trans('products.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
					 </button><br/>";
			
			$links.= "<button href='#fancybox-edit-language-invoice-status' id='language_".$model->invoiceStatus->id."'  class='btn btn-success btn-outline dim col-sm-8 language' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Language')."'  data-original-title='".trans('products.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />";

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

	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('invoiceStatusId')));
		return $this->getResponseArrayJson();
	}

}
