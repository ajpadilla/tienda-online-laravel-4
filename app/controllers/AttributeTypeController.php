<?php

use s4h\store\Languages\LanguageRepository;
use s4h\store\AttributeTypes\AttributeTypeRepository;
use s4h\store\AttributeTypesLang\AttributeTypeLangRepository;

class AttributeTypeController extends \BaseController {

	private $languageRepository;
	private $attributeTypeRepository;
	private $attributeTypeLangRepository;

	function __construct(LanguageRepository $languageRepository, AttributeTypeRepository $attributeTypeRepository, AttributeTypeLangRepository $attributeTypeLangRepository) {
		$this->languageRepository = $languageRepository;
		$this->attributeTypeRepository = $attributeTypeRepository;
		$this->attributeTypeLangRepository = $attributeTypeLangRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('attribute_types.index');
	}


	public function getDatatable()
	{
		$collection = Datatable::collection($this->attributeTypeLangRepository->getAllForLanguage($this->languageRepository->returnLanguage()->id))
			->searchColumns('name')
			->orderColumns('name');

		$collection->addColumn('name', function($model)
		{
			$language = $this->languageRepository->returnLanguage();
			$attributeTypeLanguage = $model->attributeType->languages()->where('language_id','=',$language->id)->first();
			return $attributeTypeLanguage->pivot->name;
		});

		$collection->addColumn('Actions',function($model){
		
			$links = "<a class='btn btn-info btn-circle' href='" . route('attributeType.show', $model->attributeType->id) . "'><i class='fa fa-check'></i></a>
					<br />";
			$links .= "<a a class='btn btn-warning btn-circle' href='" . route('attributeType.edit', $model->attributeType->id) . "'><i class='fa fa-pencil'></i></a>
					<br />
					<a class='btn btn-danger btn-circle' href='" . route('attributeType.destroy', $model->attributeType->id) . "'><i class='fa fa-times'></i></a>";

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
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		return View::make('attribute_types.create',compact('languages'));
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
				//$this->registerClassifiedConditionsForm->validate($input);
				$this->attributeTypeRepository->createNewAttributeType($input);
				return Response::json(trans('attributeType.response'));
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
		$attribute_type = $this->attributeTypeRepository->getAttributeTypeId($id);
		$language = $this->languageRepository->returnLanguage();
		$attribute_type_language = $attribute_type->languages()->where('language_id','=', $language->id)->first();
		return View::make('attribute_types.show',compact('attribute_type_language'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$attribute_type = $this->attributeTypeRepository->getAttributeTypeId($id);
		$language = $this->languageRepository->returnLanguage();
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		$attribute_types = $this->attributeTypeRepository->getNameForLanguage();
		$attribute_type_language = $attribute_type->languages()->where('language_id','=', $language->id)->first();
		return View::make('attribute_types.edit', compact('attribute_type','languages','attribute_type_language'));
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
			$input['attribute_type_id'] = $id;
			try
			{
				//$this->registerDiscountForm->validate($input);
				$this->attributeTypeRepository->updateAttributeType($input);
				return Response::json(trans('attributeType.Actualiced'));
			} catch (FormValidationException $e) {
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
		$this->attributeTypeRepository->delteAttributeType($id);
		Flash::message(trans('attributeType.Delete'));
		return Redirect::route('attribute_types.index');
	}


}
