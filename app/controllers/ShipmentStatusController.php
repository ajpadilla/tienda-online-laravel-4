<?php

use s4h\store\Languages\LanguageRepository;
use s4h\store\Forms\RegisterShipmentStatusForm;
use s4h\store\Forms\EditShipmentStatusForm;
use s4h\store\Forms\EditShipmentStatusFormLang;
use s4h\store\ShipmentStatus\ShipmentStatusRepository;
use s4h\store\ShipmentStatusLang\ShipmentStatusLangRepository;
use Laracasts\Validation\FormValidationException;

class ShipmentStatusController extends \BaseController {

	private $languageRepository;
	private $registerShipmentStatusForm;
	private $repository;
	private $shipmentStatusLangRepository;
	private $editShipmentStatusForm;
	private $editShipmentStatusFormLang;

	function __construct(LanguageRepository $languageRepository, 
		RegisterShipmentStatusForm $registerShipmentStatusForm, 
		ShipmentStatusRepository $repository, 
		ShipmentStatusLangRepository $shipmentStatusLangRepository, 
		EditShipmentStatusForm $editShipmentStatusForm,
		EditShipmentStatusFormLang $editShipmentStatusFormLang) 
	{
		$this->languageRepository = $languageRepository;
		$this->registerShipmentStatusForm = $registerShipmentStatusForm;
		$this->repository = $repository;
		$this->shipmentStatusLangRepository = $shipmentStatusLangRepository;
		$this->editShipmentStatusForm = $editShipmentStatusForm;
		$this->editShipmentStatusFormLang = $editShipmentStatusFormLang;
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

	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('shipmentStatusId')));
		return $this->getResponseArrayJson();
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

	public function showApiLang()
	{
		if (Request::ajax())
		{
			if (Input::has('shipmentStatusId') && Input::has('languageId'))
			{
				$shipmentStatusLang = $this->repository->getDataForLanguage(Input::get('shipmentStatusId'), Input::get('languageId'));
				$this->setSuccess(true);
				$this->addToResponseArray('shipmentStatusLang', $shipmentStatusLang);
				return $this->getResponseArrayJson();
			}else{
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
	}

	public function updateApiLang()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editShipmentStatusFormLang->validate($input);
				$this->repository->updateLanguage($input);
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

}
