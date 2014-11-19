<?php

use Laracasts\Validation\FormValidationException;
use s4h\store\DiscountsLang\DiscountLangRepository;
use s4h\store\DiscountsTypes\DiscountType;
use s4h\store\DiscountsTypes\DiscountTypeRepository;
use s4h\store\Discounts\Discount;
use s4h\store\Discounts\DiscountRepository;
use s4h\store\Forms\RegisterDiscountForm;
<<<<<<< HEAD
use s4h\store\Languages\LanguageRepository;
=======
use Laracasts\Validation\FormValidationException;
use s4h\store\Languages\LanguageRepository;
use s4h\store\DiscountsLang\DiscountLangRepository;
>>>>>>> ee2d1554b91f0bcb19e45b2ca190dc78a6213dd4

class DiscountController extends \BaseController {

	private $registerDiscountForm;
	private $discountRepository;
	private $discountTypeRepository;
	private $languageRepository;
	private $discountLangRepository;

	function __construct(RegisterDiscountForm $registerDiscountForm, DiscountRepository $discountRepository, DiscountTypeRepository $discountTypeRepository, LanguageRepository $languageRepository, DiscountLangRepository $discountLangRepository) {
		$this->registerDiscountForm = $registerDiscountForm;
		$this->discountRepository = $discountRepository;
		$this->discountTypeRepository = $discountTypeRepository;
		$this->languageRepository = $languageRepository;
		$this->discountLangRepository = $discountLangRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		return View::make('discounts.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$discountTypes = $this->discountTypeRepository->getNameForLanguage();
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		return View::make('discounts.create', compact('discountTypes', 'languages'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		if (Request::ajax()) {
			$input = Input::all();
			try
			{
				$this->registerDiscountForm->validate($input);
<<<<<<< HEAD
				/*$this->discountRepository->createNewDiscount($input);
			return Response::json(trans('discounts.message1').' '.$input['name'].' '.trans('discounts.message2'));*/
			} catch (FormValidationException $e) {
=======
				$this->discountRepository->createNewDiscount($input);
				return Response::json(trans('discounts.message1').' '.$input['name'].' '.trans('discounts.message2'));
			}
			catch (FormValidationException $e)
			{
>>>>>>> ee2d1554b91f0bcb19e45b2ca190dc78a6213dd4
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
	public function show($id) {
		$discount = $this->discountRepository->getDiscountId($id);
<<<<<<< HEAD
		$language_id = $this->languageRepository->returnLanguage()->id;
		$discount_language = $discount->languages()->where('language_id', '=', $language_id)->first();
		$discountTypes = $this->discountTypeRepository->getNameForLanguage();
		return View::make('discounts.show', compact('discount', 'discount_language', 'discountTypes'));
=======
		$language = $this->languageRepository->returnLanguage();
		$discount_language = $discount->languages()->where('language_id','=',$language->id)->first();
		$discountTypes = $this->discountTypeRepository->getNameForLanguage();
		return View::make('discounts.show',compact('discount','discount_language','discountTypes','language'));
>>>>>>> ee2d1554b91f0bcb19e45b2ca190dc78a6213dd4
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$discount = $this->discountRepository->getDiscountId($id);
<<<<<<< HEAD
		$language_id = $this->languageRepository->returnLanguage()->id;
		$discount_language = $discount->languages()->where('language_id', '=', $language_id)->first();
		$discountTypes = $this->discountTypeRepository->getNameForLanguage();
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		return View::make('discounts.edit', compact('discount', 'discount_language', 'discountTypes', 'languages'));
=======
		$language = $this->languageRepository->returnLanguage();
		$discount_language = $discount->languages()->where('language_id','=',$language->id)->first();
		$discountTypes = $this->discountTypeRepository->getNameForLanguage();
		$languages = $this->languageRepository->getAll()->lists('name','id');
		return View::make('discounts.edit',compact('discount','discount_language','discountTypes','language','languages'));
>>>>>>> ee2d1554b91f0bcb19e45b2ca190dc78a6213dd4

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
<<<<<<< HEAD
	public function update($id) {
		if (Request::ajax()) {
=======
	public function update($id)
	{
		if(Request::ajax())
		{
			$input = array();
>>>>>>> ee2d1554b91f0bcb19e45b2ca190dc78a6213dd4
			$input = Input::all();
			$input['discount_id'] = $id;
			try
			{
				//$this->registerDiscountForm->validate($input);
				$this->discountRepository->updateDiscount($input, $id);
				return Response::json(trans('discounts.message1') . ' ' . $input['name'] . ' ' . trans('discounts.message2'));
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
		$this->discountRepository->deleteDiscount($id);
		Flash::message('¡Descuento borrado  con éxito!');
		return Redirect::route('discounts.index');
	}

	public function getDatatable() {
		$collection = Datatable::collection($this->discountLangRepository->getAllForLanguage($this->languageRepository->returnLanguage()->id))
<<<<<<< HEAD
=======
			->searchColumns('code','name','discount_type_id','name','value','percent','active','from','to')
			->orderColumns('code','name','discount_type_id','name','value','percent','active','from','to');
>>>>>>> ee2d1554b91f0bcb19e45b2ca190dc78a6213dd4

		->searchColumns('name', 'code', 'discount_type_id', 'name', 'value', 'percent', 'active', 'from', 'to')
		->orderColumns('code');

		$collection->addColumn('code', function ($model) {
			return $model->discount->code;
		});

<<<<<<< HEAD
		$collection->addColumn('discount_type_id', function ($model) {
			foreach ($model->discount->discountType->languages as $language) {
				return $language->pivot->name;
			}
=======
		$collection->addColumn('discount_type_id', function($model)
		{
			$language = $this->languageRepository->returnLanguage();
			$discount_type_language = $model->discount->discountType->languages()->where('language_id','=',$language->id)->first();
			return $discount_type_language->pivot->name;
>>>>>>> ee2d1554b91f0bcb19e45b2ca190dc78a6213dd4
		});

		$collection->addColumn('name', function ($model) {
			return $model->name;
		});

		$collection->addColumn('value', function ($model) {
			return $model->discount->value;
		});

		$collection->addColumn('percent', function ($model) {
			return $model->discount->percent;
		});

		$collection->addColumn('active', function ($model) {
			return $model->discount->getActivoShow();
		});

<<<<<<< HEAD
		$collection->addColumn('from', function ($model) {
			return date(trans('discounts.date2'), strtotime($model->discount->from));
		});

		$collection->addColumn('to', function ($model) {
			return date(trans('discounts.date2'), strtotime($model->discount->to));
=======
		$collection->addColumn('from', function($model)
		{
			return date($model->language->date_format ,strtotime($model->discount->from));
		});

		$collection->addColumn('to', function($model)
		{
			return date($model->language->date_format ,strtotime($model->discount->to));
>>>>>>> ee2d1554b91f0bcb19e45b2ca190dc78a6213dd4
		});

		$collection->addColumn('Actions', function ($model) {
			$links = "<a href='" . route('discounts.show', $model->discount->id) . "'>View</a>
					<br />";
			$links .= "<a href='" . route('discounts.edit', $model->discount->id) . "'>Edit</a>
					<br />
					<a href='" . route('discounts.destroy', $model->discount->id) . "'>Delete</a>";

			return $links;
		});

		return $collection->make();
	}

	public function checkCode() {
		if (Request::ajax()) {
			$discount = $this->discountRepository->getCode(Input::get('code'));
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
			$discount = $this->discountRepository->getCodeEdit(Input::all());
			if (count($discount) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
	}
}
