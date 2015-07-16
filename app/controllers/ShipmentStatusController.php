<?php

use s4h\store\Languages\LanguageRepository;
use s4h\store\Forms\RegisterShipmentStatusForm;
use s4h\store\Forms\EditShipmentStatusForm;
use s4h\store\ShipmentStatus\ShipmentStatusRepository;
use s4h\store\ShipmentStatusLang\ShipmentStatusLangRepository;
use Laracasts\Validation\FormValidationException;

class ShipmentStatusController extends \BaseController {

	private $languageRepository;
	private $registerShipmentStatusForm;
	private $repository;
	private $shipmentStatusLangRepository;
	private $editShipmentStatusForm;
	function __construct(LanguageRepository $languageRepository, 
		RegisterShipmentStatusForm $registerShipmentStatusForm, 
		ShipmentStatusRepository $repository, 
		ShipmentStatusLangRepository $shipmentStatusLangRepository, 
		EditShipmentStatusForm $editShipmentStatusForm) 
	{
		$this->languageRepository = $languageRepository;
		$this->registerShipmentStatusForm = $registerShipmentStatusForm;
		$this->repository = $repository;
		$this->shipmentStatusLangRepository = $shipmentStatusLangRepository;
		$this->editShipmentStatusForm = $editShipmentStatusForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$languages = $this->languageRepository->getAllForSelect();
		$table = $this->repository->getAllTable();
		return View::make('shipment_status.index',compact('languages', 'table'));
	}

	public function getDatatable(){

		$collection = Datatable::collection($this->shipmentStatusLangRepository->getAllForLanguage($this->languageRepository->returnLanguage()->id))
			->searchColumns('color','name','description')
			->orderColumns('color','name','description');

		$collection->addColumn('color', function($model)
		{
			return  "<input type='text' class='form-control' STYLE='background-color: ".$model->shipmentStatus->color.";' size='5' readonly>";
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

			$links = "<form action='".route('shipmentStatus.show',$model->shipment_status->id)."' method='get'>
						<button href='#'  class='btn btn-success btn-outline dim col-sm-8 show' style='margin-left: 20px;' type='submit' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Show')."'  data-original-title='".trans('products.actions.Show')."' ><i class='fa fa-check fa-2x'></i></button><br/>
					  </form>";

			$links.= "<button href='#fancybox-edit-shipment-status' id='edit_".$model->shipment_status->id."' class='btn btn-warning btn-outline dim col-sm-8 edit' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Edit')."'  data-original-title='".trans('products.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
					 </button><br/>";

			$links.= "<button href='#' class='btn btn-danger btn-outline dim col-sm-8' id='delet_".$model->shipment_status->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Delete')."'  data-original-title='".trans('products.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
					 </button><br/>";
			
			$links.= "<button href='#fancybox-edit-language-shipment-status' id='language_".$model->shipment_status->id."'  class='btn btn-success btn-outline dim col-sm-8 language' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Language')."'  data-original-title='".trans('products.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />";

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
		return View::make('shipment_status.create',compact('languages'));
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
				$this->registerShipmentStatusForm->validate($input);
				$this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('shipmentStatus.response'));
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
		$shipmentStatus = $this->repository->getById($id);
		$language_id = $this->languageRepository->returnLanguage()->id;
		$shipmentStatusLanguage = $shipmentStatus->languages()->where('language_id','=',$language_id)->first();
		return View::make('shipment_status.show',compact('shipmentStatus','shipmentStatusLanguage'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$shipmentStatus = $this->repository->getById($id);
		$language_id = $this->languageRepository->returnLanguage()->id;
		$shipmentStatusLanguage = $shipmentStatus->languages()->where('language_id','=',$language_id)->first();
		$languages = $this->languageRepository->getAll()->lists('name','id');
		return View::make('shipment_status.edit',compact('shipmentStatus','shipmentStatusLanguage','languages'));
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
				$this->editShipmentStatusForm->validate($input);
				$this->repository->updateData($input);
				return Response::json(trans('shipmentStatus.Updated'));
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
				$this->editShipmentStatusForm->validate($input);
				$this->repository->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('shipmentStatus.Updated'));
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
		$this->repository->deleteShipmentStatu($id);
		Flash::message(trans('shipmentStatus.Delete'));
		return Redirect::route('shipmentStatus.index');
	}

	public function deleteAjax()
	{
		if (Request::ajax()){
			$this->repository->deleteShipmentStatu(Input::get('shipmentStatusId'));
			return Response::json(['success' => true]);
		}
		return Response::json(['success' => false]);
	}

	public function checkNameShipmentStatus()
	{
		if (Request::ajax()) {
			$input = Input::all();
			$shipmentStatus = $this->repository->getNameShipmentStatus($input);
			if(count($shipmentStatus) > 0){
				return Response::json(false);
			}else{
				 return Response::json(true);
			}
		}
	}

	public function checkColorShipmentStatus()
	{
			$shipment_status = $this->repository->getColor(Input::get('color'));
			if(count($shipment_status) > 0){
				return Response::json(false);
			}else{
				 return Response::json(true);
			}
	}


	public function checkNameForEdit()
	{
		$response = array();
		if (Request::ajax()) {
			$shipment_status = $this->repository->getNameForEdit(Input::all());
			if (count($shipment_status) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('response' => 'false'));
	}

	public function returnDataShipmentStatus(){
		if (Request::ajax())
		{
			if (Input::has('shipmentStatusId'))
			{
				$shipmentStatus = $this->repository->getArrayInCurrentLangData(Input::get('shipmentStatusId'));
				return Response::json($shipmentStatus);
			}else{
				return Response::json(['success' => false]);
			}
		}
	}

	public function returnDataShipmentStatusLang()
	{
		if (Request::ajax())
		{
			if (Input::has('shipmentStatusId') && Input::has('languageId'))
			{
				 $shipmentStatusLang = $this->repository->getDataForLanguage(Input::get('shipmentStatusId'), Input::get('languageId'));
				 return Response::json($shipmentStatusLang);
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
				//$this->editLangProductoForm->validate($input);
				$this->repository->updateData($input);
				return Response::json([trans('shipmentStatus.Updated')]);
			}
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
			}
		}
	}

	public function listApi()
	{
		return $this->repository->getDefaultTableForAll();
	}

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('shipmentStatusId'))
			{
				$shipmentStatus = $this->repository->getArrayInCurrentLangData(Input::get('shipmentStatusId'));
				$this->setSuccess(true);
				$this->addToResponseArray('shipmentStatus', $shipmentStatus);
				return $this->getResponseArrayJson();
			}else{
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
	}

}
