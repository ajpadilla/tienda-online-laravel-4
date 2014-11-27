<?php

use Laracasts\Validation\FormValidationException;
use s4h\store\DiscountsTypes\DiscountTypeRepository;
use s4h\store\DiscountTypesLang\DiscountTypeLangRepository;
use s4h\store\Forms\RegisterDiscountTypeForm;
use s4h\store\Languages\LanguageRepository;

class DiscountTypeController extends \BaseController {

	private $discountTypeRepository;
	private $registerDiscountTypeForm;
	private $languageRepository;
	private $discountTypeLangRepository;

	function __construct(RegisterDiscountTypeForm $registerDiscountTypeForm, DiscountTypeRepository $discountTypeRepository, LanguageRepository $languageRepository, DiscountTypeLangRepository $discountTypeLangRepository){
		$this->discountTypeRepository = $discountTypeRepository;
		$this->registerDiscountTypeForm = $registerDiscountTypeForm;
		$this->languageRepository = $languageRepository;
		$this->discountTypeLangRepository = $discountTypeLangRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		return View::make('discounts_types.index');
	}

	public function getDatatable()
	{
		$collection = Datatable::collection($this->discountTypeLangRepository->getAllForLanguage($this->languageRepository->returnLanguage()->id))
			->searchColumns('name')
			->orderColumns('name');

		$collection->addColumn('name', function($model)
		{
			return $model->name;
		});
	
		$collection->addColumn('Actions',function($model){
		
			$links = "<a class='btn btn-info' href='" . route('discountType.show', $model->discountType->id) . "'>".trans('discountType.actions.Show')." <i class='fa fa-check'></i></a>
					<br />";
			$links .= "<a a class='btn btn-warning' href='" . route('discountType.edit', $model->discountType->id) . "'>".trans('discountType.actions.Edit')." <i class='fa fa-pencil'></i></a>
					<br />
					<a class='btn btn-danger' href='" . route('discountType.destroy', $model->discountType->id) . "'>".trans('products.actions.Delete')." <i class='fa fa-times'></i></a>";

			return $links;
		});

		return $collection->make();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		return View::make('discounts_types.create', compact('languages'));
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
				$this->registerDiscountTypeForm->validate($input);
				$this->discountTypeRepository->createNewDiscountType($input);
				return Response::json(trans('discounts.response'));
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
		$discount_type = $this->discountTypeRepository->getDiscountTypeId($id);
		$language = $this->languageRepository->returnLanguage();
		$discount_type_language = $discount_type->languages()->where('language_id','=', $language->id)->first();
		return View::make('discounts_types.show',compact('discount_type_language'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
		//
	public function edit($id)
	{
		$discount_type = $this->discountTypeRepository->getDiscountTypeId($id);
		$language_id = $this->languageRepository->returnLanguage()->id;
		$discount_type_language = $discount_type->languages()->where('language_id','=',$language_id)->first();
		$languages = $this->languageRepository->getAll()->lists('name','id');
		return View::make('discounts_types.edit',compact('discount_type','discount_type_language','languages'));
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
			$input['discount_type_id'] = $id;
			try
			{
				$this->discountTypeRepository->updateDiscountType($input);
				return Response::json(trans('discountType.Updated'));
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
		$this->discountTypeRepository->deletediscountType($id);
		Flash::message(trans('discountType.Delete'));
		return Redirect::route('discountType.index');
	}

	public function checkName() {
		$response = array();
		if (Request::ajax()) {
			$discount_type = $this->discountTypeRepository->getName(Input::all());
			if (count($discount_type) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('respuesta' => 'false'));
	}

}
