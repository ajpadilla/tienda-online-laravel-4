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
	private $shipmentStatusRepository;
	private $shipmentStatusLangRepository;
	private $editShipmentStatusForm;
	function __construct(LanguageRepository $languageRepository, RegisterShipmentStatusForm $registerShipmentStatusForm, ShipmentStatusRepository $shipmentStatusRepository, ShipmentStatusLangRepository $shipmentStatusLangRepository, EditShipmentStatusForm $editShipmentStatusForm) {
		$this->languageRepository = $languageRepository;
		$this->registerShipmentStatusForm = $registerShipmentStatusForm;
		$this->shipmentStatusRepository = $shipmentStatusRepository;
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
		return View::make('shipment_status.index');
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
			
			$links = "<a class='btn btn-info btn-circle'' href='" . route('shipmentStatus.show', $model->shipmentStatus->id) . "'><i class='fa fa-check'></i></a>
					<br />";
			$links .= "<a a class='btn btn-warning btn-circle'' href='" . route('shipmentStatus.edit', $model->shipmentStatus->id) . "'><i class='fa fa-pencil'></i></a>
					<br />
					<a class='btn btn-danger btn-circle'' href='" . route('shipmentStatus.destroy', $model->shipmentStatus->id) . "'><i class='fa fa-times'></i></a>";

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
		return View::make('shipment_status.create',compact('languages'));
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
			//dd($input);
			try
			{
				$this->registerShipmentStatusForm->validate($input);
				$this->shipmentStatusRepository->createNewShipmentStatus($input);
				return Response::json(trans('shipmentStatus.response'));
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
		$shipmentStatus = $this->shipmentStatusRepository->getShipmentStatus($id);
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
		$shipmentStatus = $this->shipmentStatusRepository->getShipmentStatus($id);
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
	public function update($id)
	{
		if(Request::ajax())
		{
			$input = array();
			$input = Input::all();
			$input['shipment_status_id'] = $id;
			try
			{
				$this->editShipmentStatusForm->validate($input);
				$this->shipmentStatusRepository->updateShipmentStatu($input);
				return Response::json(trans('shipmentStatus.Updated'));
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
		$this->shipmentStatusRepository->deleteShipmentStatu($id);
		Flash::message(trans('shipmentStatus.Delete'));
		return Redirect::route('shipmentStatus.index');
	}

	public function checkNameShipmentStatus()
	{
		if (Request::ajax()) {
			$input = Input::all();
			$shipment_status = $this->shipmentStatusRepository->getNameShipmentStatus($input);
			if(count($shipment_status) > 0){
				return Response::json(false);
			}else{
				 return Response::json(true);
			}
		}
	}

	public function checkColorShipmentStatus()
	{
			$shipment_status = $this->shipmentStatusRepository->getColor(Input::get('color'));
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
			$shipment_status = $this->shipmentStatusRepository->getNameForEdit(Input::all());
			if (count($shipment_status) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('response' => 'false'));
	}

}
