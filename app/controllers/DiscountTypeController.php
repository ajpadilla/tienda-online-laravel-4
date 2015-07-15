<?php

use Laracasts\Validation\FormValidationException;
use s4h\store\DiscountsTypes\DiscountTypeRepository;
use s4h\store\DiscountTypesLang\DiscountTypeLangRepository;
use s4h\store\Forms\RegisterDiscountTypeForm;
use s4h\store\Languages\LanguageRepository;
use s4h\store\Forms\EditDiscountTypeForm;

class DiscountTypeController extends \BaseController {

	private $repository;
	private $registerDiscountTypeForm;
	private $languageRepository;
	private $discountTypeLangRepository;
	private $editDiscountTypeForm;

	function __construct(RegisterDiscountTypeForm $registerDiscountTypeForm,
	 						DiscountTypeRepository $repository, 
	 						LanguageRepository $languageRepository,
	 						DiscountTypeLangRepository $discountTypeLangRepository,
	 						EditDiscountTypeForm $editDiscountTypeForm){

		$this->repository = $repository;
		$this->registerDiscountTypeForm = $registerDiscountTypeForm;
		$this->languageRepository = $languageRepository;
		$this->discountTypeLangRepository = $discountTypeLangRepository;
		$this->editDiscountTypeForm = $editDiscountTypeForm;
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
		return View::make('discounts_types.index', compact('languages', 'table'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$languages = $this->languageRepository->getAllForSelect();
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
				$this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('discountType.response'));
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
		$discount_type = $this->repository->getDiscountTypeId($id);
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
		$discount_type = $this->repository->getDiscountTypeId($id);
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

	/*public function update($id)
	{
		if(Request::ajax())
		{
			$input = array();
			$input = Input::all();
			$input['discount_type_id'] = $id;
			try
			{
				$this->editDiscountTypeForm->validate($input);
				$this->repository->updateDiscountType($input);

				return Response::json(trans('discountType.Updated'));
			}
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
			}
		}
	}*/

	public function updateApi() 
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editDiscountTypeForm->validate($input);
				$this->repository->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('discountType.Updated'));
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
		$this->repository->deletediscountType($id);
		Flash::message(trans('discountType.Delete'));
		return Redirect::route('discountType.index');
	}

	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('discountTypeId')));
		return $this->getResponseArrayJson();
	}


	public function checkName() {
		$response = array();
		if (Request::ajax()) {
			$discount_type = $this->repository->getName(Input::all());
			if (count($discount_type) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('response' => 'false'));
	}

	public function checkNameForEdit()
	{
		$response = array();
		if (Request::ajax()) {
			$discount_type = $this->repository->getNameForEdit(Input::all());
			if (count($discount_type) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('response' => 'false'));
	}

	public function listApi()
	{
		return $this->repository->getDefaultTableForAll();
	}

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('discountTypeId'))
			{
				$discountType = $this->repository->getArrayInCurrentLangData(Input::get('discountTypeId'));
				$this->setSuccess(true);
				$this->addToResponseArray('discountType', $discountType);
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
			if (Input::has('discountTypeId') && Input::has('languageId'))
			{
				$discountTypeLang = $this->repository->getDataForLanguage(Input::get('discountTypeId'), Input::get('languageId'));
				$this->setSuccess(true);
				$this->addToResponseArray('discountTypeLang', $discountTypeLang);
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
				$this->editDiscountTypeForm->validate($input);
				$discountType = $this->repository->updateLanguage($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('discountType.Updated'));
				$this->addToResponseArray('discountType', $discountType);
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
