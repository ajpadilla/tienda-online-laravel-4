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

class DiscountController extends \BaseController {

	private $registerDiscountForm;
	private $repository;
	private $discountTypeRepository;
	private $languageRepository;
	private $discountLangRepository;
	private $editDiscountForm;

	function __construct(RegisterDiscountForm $registerDiscountForm, 
							DiscountRepository $repository, 
							DiscountTypeRepository $discountTypeRepository, 
							LanguageRepository $languageRepository, 
							DiscountLangRepository $discountLangRepository,
							EditDiscountForm $editDiscountForm
						){

		$this->registerDiscountForm = $registerDiscountForm;
		$this->repository = $repository;
		$this->discountTypeRepository = $discountTypeRepository;
		$this->languageRepository = $languageRepository;
		$this->discountLangRepository = $discountLangRepository;
		$this->editDiscountForm = $editDiscountForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$table = $this->repository->getAllTable();
		return View::make('discounts.index',compact('table'));
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
		$language = $this->languageRepository->returnLanguage();
		$discount_language = $discount->languages()->where('language_id','=',$language->id)->first();
		$discountTypes = $this->discountTypeRepository->getNameForLanguage();
		return View::make('discounts.show',compact('discount','discount_language','discountTypes','language'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$discount = $this->repository->getDiscountId($id);
		$language = $this->languageRepository->returnLanguage();
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
	public function update($id)
	{
		if(Request::ajax())
		{
			$input = array();
			$input = Input::all();
			$input['discount_id'] = $id;
			try
			{
				$this->editDiscountForm->validate($input);
				$this->repository->updateDiscount($input);
				return Response::json(trans('discounts.Updated'));
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
	public function destroy($id) {
		$this->repository->deleteDiscount($id);
		Flash::message(trans('discounts.Delete'));
		return Redirect::route('discounts.index');
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
}
