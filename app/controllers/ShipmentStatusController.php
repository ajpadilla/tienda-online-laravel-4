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
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		return View::make('shipment_status.index',compact('languages'));
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

			/*$links.= "<button href='#' class='btn btn-danger btn-outline dim col-sm-6' id='delet_".$model->product->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Delete')."'  data-original-title='".trans('products.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
					 </button><br/>";

			if ($model->product->active)
			{
				$links.= "<button href='#' class='btn btn-primary btn-outline dim col-sm-6 deactivated' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Activate')."'  data-original-title='".trans('products.actions.Deactivated')."'> <i class='fa fa-check fa-2x'></i></button><br />";
			}
			else
			{
				$links.= "<button href='#' class='btn btn-danger btn-outline dim col-sm-6 activate' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Deactivated')."'  data-original-title='".trans('products.actions.Activate')."'> <i class='fa fa-check fa-2x'></i></button><br />";
			}

			$links.= "<form action='".route('photoProduct.create',array($model->product->id, $languageId))."' method='get'>
							<button href='#' class='btn btn-info btn-outline dim col-sm-6 photo' style='margin-left: 20px' type='submit' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Photo')."'  data-original-title='".trans('products.actions.Photo')."'> <i class='fa fa-camera fa-2x'></i></button><br />
					  </form>";

			$links.= "<button href='#fancybox-edit-language-product' id='language_".$model->product->id."'  class='btn btn-success btn-outline dim col-sm-6 language' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Language')."'  data-original-title='".trans('products.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />";*/

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
		$shipmentStatus = $this->shipmentStatusRepository->getById($id);
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
		$shipmentStatus = $this->shipmentStatusRepository->getById($id);
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

	public function returnDataShipmentStatus(){
		if (Request::ajax())
		{
			if (Input::has('shipmentStatusId'))
			{
				$shipmentStatus = $this->shipmentStatusRepository->getArrayInCurrentLangData(Input::get('shipmentStatusId'));
				return Response::json($shipmentStatus);
			}else{
				return Response::json(['success' => false]);
			}
		}
	}

}
