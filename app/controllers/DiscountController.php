<?php

use Laracasts\Validation\FormValidationException;
use s4h\store\DiscountsLang\DiscountLangRepository;
use s4h\store\DiscountsTypes\DiscountType;
use s4h\store\DiscountsTypes\DiscountTypeRepository;
use s4h\store\Discounts\Discount;
use s4h\store\Discounts\DiscountRepository;
use s4h\store\Forms\RegisterDiscountForm;
use s4h\store\Languages\LanguageRepository;
use s4h\store\Forms\EditDiscountForm;
use s4h\store\Forms\EditDiscountLangForm;

class DiscountController extends \BaseController {

	private $registerDiscountForm;
	private $repository;
	private $discountTypeRepository;
	private $languageRepository;
	private $discountLangRepository;
	private $editDiscountForm;
	private $editDiscountLangForm;

	function __construct(RegisterDiscountForm $registerDiscountForm, 
							DiscountRepository $repository, 
							DiscountTypeRepository $discountTypeRepository, 
							LanguageRepository $languageRepository, 
							DiscountLangRepository $discountLangRepository,
							EditDiscountForm $editDiscountForm,
							EditDiscountLangForm $editDiscountLangForm
						){

		$this->registerDiscountForm = $registerDiscountForm;
		$this->repository = $repository;
		$this->discountTypeRepository = $discountTypeRepository;
		$this->languageRepository = $languageRepository;
		$this->discountLangRepository = $discountLangRepository;
		$this->editDiscountForm = $editDiscountForm;
		$this->editDiscountLangForm = $editDiscountLangForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$discountTypes = $this->discountTypeRepository->getAllForCurrentLang();
		$languages = $this->languageRepository->getAllForSelect();
		$table = $this->repository->getAllTable();
		return View::make('discounts.index',compact('table', 'discountTypes', 'languages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$discountTypes = $this->discountTypeRepository->getAllForCurrentLang();
		$languages = $this->languageRepository->getAllForSelect();
		return View::make('discounts.create', compact('discountTypes', 'languages'));
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
				$this->registerDiscountForm->validate($input);
				$this->repository->create($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('discounts.response'));
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
	public function show($id) {
		$discount = $this->repository->getDiscountId($id);
		$language = $this->languageRepository->getAllForSelect();
		$discount_language = $discount->languages()->where('language_id','=',$language->id)->first();
		$discountTypes = $this->discountTypeRepository->getNameForLanguage();
		return View::make('discounts.show',compact('discount','discount_language','discountTypes','language'));
	}

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('discountId'))
			{
				$discount = $this->repository->getArrayInCurrentLangData(Input::get('discountId'));
				$this->setSuccess(true);
				$this->addToResponseArray('discount', $discount);
				return $this->getResponseArrayJson();
			}else{
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$discount = $this->repository->getDiscountId($id);
		$language = $this->languageRepository->getAllForSelect();
		$discount_language = $discount->languages()->where('language_id','=',$language->id)->first();
		$discountTypes = $this->discountTypeRepository->getNameForLanguage();
		$languages = $this->languageRepository->getAll()->lists('name','id');
		return View::make('discounts.edit',compact('discount','discount_language','discountTypes','language','languages'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateApi()
	{
		if(Request::ajax())
		{
			$input = array();
			$input = Input::all();
			try
			{
				$this->editDiscountForm->validate($input);
				$this->repository->update($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('discounts.Updated'));
				return $this->getResponseArrayJson();
			} catch (FormValidationException $e) {
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
	public function destroy($id) {
		$this->repository->deleteDiscount($id);
		Flash::message(trans('discounts.Delete'));
		return Redirect::route('discounts.index');
	}

	public function destroyApi()
	{
		if(Request::ajax())
			$this->setSuccess($this->repository->delete(Input::get('discountId')));
		return $this->getResponseArrayJson();
	}


	public function checkCode() {
		if (Request::ajax()) {
			$discount = $this->repository->getCode(Input::get('code'));
			if (count($discount) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('respuesta' => 'false'));
	}

	public function checkCodeForEdit() {
		if (Request::ajax()) {
			$discount = $this->repository->getCodeEdit(Input::all());
			if (count($discount) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
	}

	public function listApi()
	{
		return $this->repository->getDefaultTableForAll();
	}


	public function showApiLang()
	{
		if (Request::ajax())
		{
			if (Input::has('discountId') && Input::has('languageId'))
			{
				$discountLang = $this->repository->getDataForLanguage(Input::get('discountId'), Input::get('languageId'));
				$this->setSuccess(true);
				$this->addToResponseArray('discountLang', $discountLang);
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
				$this->editDiscountLangForm->validate($input);
				$discount = $this->repository->updateLanguage($input);
				$this->setSuccess(true);
				$this->addToResponseArray('message', trans('discounts.Updated'));
				$this->addToResponseArray('discount', $discount);
				return $this->getResponseArrayJson();
			}
			catch (FormValidationException $e)
			{
				$this->addToResponseArray('errors', $e->getErrors()->all());
				return $this->getResponseArrayJson();
			}
		}
	}
}
