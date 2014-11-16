<?php

use s4h\store\Languages\LanguageRepository;
use s4h\store\Forms\RegisterShipmentStatusForm;
use s4h\store\ShipmentStatus\ShipmentStatusRepository;
use s4h\store\ShipmentStatusLang\ShipmentStatusLangRepository;
use Laracasts\Validation\FormValidationException;

class ShipmentStatusController extends \BaseController {

	private $languageRepository;
	private $registerShipmentStatusForm;
	private $shipmentStatusRepository;
	private $shipmentStatusLangRepository;

	function __construct(LanguageRepository $languageRepository, RegisterShipmentStatusForm $registerShipmentStatusForm, ShipmentStatusRepository $shipmentStatusRepository, ShipmentStatusLangRepository $shipmentStatusLangRepository) {
		$this->languageRepository = $languageRepository;
		$this->registerShipmentStatusForm = $registerShipmentStatusForm;
		$this->shipmentStatusRepository = $shipmentStatusRepository;
		$this->shipmentStatusLangRepository = $shipmentStatusLangRepository;
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
			return $model->shipmentStatus->color;
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
			$links = "<a href='" .route('discounts.show',$model->shipmentStatus->id). "'>View</a>
					<br />";
			$links .= "<a href='" .route('discounts.edit',$model->shipmentStatus->id). "'>Edit</a>
					<br />
					<a href='" .route('discounts.destroy',$model->shipmentStatus->id). "'>Delete</a>";

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
				return Response::json(trans('shipmentStatus.message1').' '.$input['name'].' '.trans('shipmentStatus.message2'));
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

}
