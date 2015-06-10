<?php

use Laracasts\Validation\FormValidationException;
use s4h\store\Languages\LanguageRepository;
use s4h\store\Classifieds\ClassifiedRepository;
use s4h\store\ClassifiedConditions\ClassifiedConditionsRepository;
use s4h\store\ClassifiedTypes\ClassifiedTypesRepository;
use s4h\store\Users\UserRepository;
use s4h\store\ClassifiedsLang\ClassifiedsLangRepository;
use s4h\store\Forms\RegisterClassifiedForm;
use s4h\store\Forms\EditClassifiedForm;
use s4h\store\Countries\CountryRepository;
use s4h\store\Forms\EditClassifiedLangForm;

class ClassifiedController extends \BaseController {

	private $repository;
	private $classifiedConditionsRepository;
	private $classifiedTypesRepository;
	private $userRepository;
	private $languageRepository;
	private $registerClassifiedForm;
	private $editClassifiedForm;
	private $countryRepository;
	private $editClassifiedLangForm;

	function __construct(ClassifiedRepository $repository, 
		ClassifiedConditionsRepository $classifiedConditionsRepository, 
		ClassifiedTypesRepository $classifiedTypesRepository, 
		UserRepository $userRepository,
		LanguageRepository $languageRepository, 
		ClassifiedsLangRepository $classifiedLangRepository,
		RegisterClassifiedForm $registerClassifiedForm,
		EditClassifiedForm $editClassifiedForm,
		CountryRepository $countryRepository,
		EditClassifiedLangForm $editClassifiedLangForm
	){

		$this->repository = $repository;
		$this->classifiedConditionsRepository = $classifiedConditionsRepository;
		$this->classifiedTypesRepository = $classifiedTypesRepository;
		$this->userRepository = $userRepository;
		$this->languageRepository = $languageRepository;
		$this->classifiedLangRepository = $classifiedLangRepository;
		$this->registerClassifiedForm = $registerClassifiedForm;
		$this->editClassifiedForm = $editClassifiedForm;
		$this->countryRepository = $countryRepository;
		$this->editClassifiedLangForm = $editClassifiedLangForm;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		$classified_conditions = $this->classifiedConditionsRepository->getNameForLanguage(); 
		$classified_types = $this->classifiedTypesRepository->getNameForLanguage();
		$categories = $this->categoryRepository->getNameForLanguage();
		return View::make('classifieds.index', compact('languages','classified_conditions','classified_types','categories'));
	}

	public function getDatatable()
	{
		$collection = Datatable::collection($this->classifiedLangRepository->getAllForLanguage($this->languageRepository->returnLanguage()->id))
			->searchColumns('name','description', 'address')
			->orderColumns('name','description', 'address');

		$collection->addColumn('photo', function($model)
		{
			$links = '';
			
			$photo = $model->classified->getFirstPhoto();

			if ($photo != false) {
				$links .= "	<a href='#'>
									<img class='mini-photo' alt='" . $photo->filename . "' src='" . asset($photo->complete_path) . "'>
				</a>";
			}
				
			return $links;
		});

		$collection->addColumn('name', function($model)
		{
			return $model->name;
		});
		
		$collection->addColumn('description', function($model)
		{
			return $model->description;
		});

		$collection->addColumn('address', function($model)
		{
			return $model->address;
		});

		$collection->addColumn('price', function($model)
		{
			return $model->classified->price;
		});

		
		$collection->addColumn('user', function($model)
		{
			return $model->classified->user->username;
		});

		$collection->addColumn('category', function($model)
		{
			$language = $this->languageRepository->returnLanguage();

			if($model->classified->hasCategories())
			{
				$classifiedsCategoriesName = $model->classified->getCategories();
				$links = '<select class="form-control m-b">';
				foreach ($classifiedsCategoriesName as $category) {
					$links .= '<option>'.$category.'</option>';
				}
				$links .='</select>';
				return $links;
			}
			return '';
		});

		$collection->addColumn('classified_type', function($model)
		{
			$language = $this->languageRepository->returnLanguage();
			$classified_type_language = $model->classified->classifiedType->languages()->where('language_id','=',$language->id)->first();
			return $classified_type_language->pivot->name;
		});

		$collection->addColumn('classified_condition', function($model)
		{
			$language = $this->languageRepository->returnLanguage();
			$classified_condition_language = $model->classified->classifiedCondition->languages()->where('language_id','=',$language->id)->first();
			return $classified_condition_language->pivot->name;
		});

		$collection->addColumn('Actions',function($model){
			
			$languageId = $this->languageRepository->returnLanguage()->id;

			$links = "<form action='".route('classifieds.show',$model->classified->id)."' method='get'>
						<button href='#'  class='btn btn-success btn-outline dim col-sm-8 show' style='margin-left: 20px;' type='submit' data-toggle='tooltip' data-placement='top' title='".trans('classifieds.actions.Show')."'  data-original-title='".trans('classifieds.actions.Show')."' ><i class='fa fa-check fa-2x'></i></button><br/>
					  </form>";

			$links.= "<button href='#fancybox-edit-classified' id='edit_".$model->classified->id."' class='btn btn-warning btn-outline dim col-sm-8 edit' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Edit')."'  data-original-title='".trans('products.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
					 </button><br/>";

			$links.= "<button href='#' class='btn btn-danger btn-outline dim col-sm-8 delete' id='delet_".$model->classified->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Delete')."'  data-original-title='".trans('products.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
					 </button><br/>";
					 
			if ($model->classified->active)
			{
				$links.= "<button href='#' class='btn btn-primary btn-outline dim col-sm-8 deactivated' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Activate')."'  data-original-title='".trans('products.actions.Deactivated')."'> <i class='fa fa-check fa-2x'></i></button><br />";
			}
			else
			{
				$links.= "<button href='#' class='btn btn-danger btn-outline dim col-sm-8 activate' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Deactivated')."'  data-original-title='".trans('products.actions.Activate')."'> <i class='fa fa-check fa-2x'></i></button><br />";
			}

			$links.= "<form action='".route('photoClassified.create',array($model->classified->id, $languageId))."' method='get'>
							<button href='#' class='btn btn-info btn-outline dim col-sm-8 photo' style='margin-left: 20px' type='submit' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Photo')."'  data-original-title='".trans('products.actions.Photo')."'> <i class='fa fa-camera fa-2x'></i></button><br />
					  </form>";

			$links.= "<button href='#fancybox-edit-language-classified' id='language_".$model->classified->id."'  class='btn btn-success btn-outline dim col-sm-8 language' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Language')."'  data-original-title='".trans('products.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />";

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
		$languages = $this->languageRepository->getAllForSelect();
		$classified_conditions = $this->classifiedConditionsRepository->getAllForCurrentLang(); 
		$classified_types = $this->classifiedTypesRepository->getAllForCurrentLang();
		$categories = $this->categoryRepository->getAllForCurrentLang();
		return View::make('classifieds.create', compact('languages','classified_conditions','classified_types','categories'));
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
			$input = [];

			$input = Input::all();
			try
			{
				$this->registerClassifiedForm->validate($input);
				$classified = $this->repository->createNewClassified($input);
				if ($input['add_photos'] == 1) {
					return Response::json(['message' => trans('classifieds.response'),
						'add_photos' => $input['add_photos'], 'url' => URL::route('photoClassified.create',$classified->id)
					]);
				}
				return Response::json(['message' => trans('classifieds.response'), 'add_photos' => 0]);
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
		$classified = $this->repository->getById($id);
		$language = $this->languageRepository->returnLanguage();
		$classifiedType = $classified->classifiedType->languages()->where('language_id','=',$language->id)->first();
		$classifiedConditions = $classified->classifiedCondition->languages()->where('language_id','=',$language->id)->first();
		$classified_language = $classified->languages()->where('language_id','=', $language->id)->first();
		return View::make('classifieds.show', compact('classified','classifiedType','classifiedConditions','classified_language'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$classified = $this->repository->getById($id);
		$language = $this->languageRepository->returnLanguage();
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		$classified_conditions = $this->classifiedConditionsRepository->getNameForLanguage();
		$classified_types = $this->classifiedTypesRepository->getNameForLanguage();
		$classified_language = $classified->languages()->where('language_id','=', $language->id)->first();
		return View::make('classifieds.edit', compact('classified','languages','classified_conditions','classified_types','classified_language'));
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
			$input = [];
			$input = Input::all();
			
			try
			{
				$this->editClassifiedForm->validate($input);
				$classified = $this->repository->updateClassified($input);
				
				if ($input['add_photos'] == 1) 
				{
					return Response::json(['message' => trans('classifieds.Actualiced'),
						'add_photos' => $input['add_photos'], 'url' => URL::route('photoClassified.create',$classified->id)
						]);
				}else{
					return Response::json(['message' => trans('classifieds.response'), 'add_photos' => 0]);

				}
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
		$this->repository->delteClassified($id);
		Flash::message(trans('classifieds.Delete'));
		return Redirect::route('classifieds.index');
	}

	
	public function checkNameClassified() 
	{
		$response = array();
		if (Request::ajax()) {
			$classified = $this->repository->getName(Input::all());
			if (count($classified) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('respuesta' => 'false'));
	}


	public function checkNameForEdit()
	{
		$response = array();
		if (Request::ajax()) {
			$classified = $this->repository->getNameForEdit(Input::all());
			if (count($classified) > 0) {
				return Response::json(false);
			} else {
				return Response::json(true);
			}
		}
		return Response::json(array('response' => 'false'));
	}


	public function viewSearchClassifieds()
	{
		$country = $this->countryRepository->getNameForLanguage();
		$classifiedConditions = $this->classifiedConditionsRepository->getNameForLanguage(); 
		$classifiedTypes = $this->classifiedTypesRepository->getNameForLanguage();
		return View::make('classifieds.search-classified',compact('country','classifiedConditions','classifiedTypes'));
	}

	public function searchClassified()
	{
		$classifiedsResult = $this->repository->search(Input::all());
		//dd($classifiedsResult);
		return View::make('classifieds.filtered-classisied',compact('classifiedsResult'));
	}

	public function countries()
	{
		if (Request::ajax()) 
		{
			$countries = $this->countryRepository->getNameForLanguage();
			array_unshift($countries,trans('classifieds.all-conditions'));
			return Response::json(['success' => true, 'data'=> $countries]);
		}else{
			return Response::json(['success' => false]);
		}
	}

	public function statesForCountry()
	{
		if (Request::ajax()) 
		{
			if (Input::has('countryId')) 
			{
				$states = $this->countryRepository->getListOfStates(Input::get('countryId'));
				if (count($states) > 0) {
					array_unshift($states,trans('classifieds.all-conditions'));
					return Response::json(['success' => true, 'location' => $states]);
				}else{
					return Response::json(['success' => false]);
				}
			}
		}
	}

	public function citiesForState()
	{
		if (Request::ajax()) 
		{
			if (Input::has('stateId')) 
			{
				$cities = $this->countryRepository->getListOfCities(Input::get('stateId'));
				if (count($cities) > 0) {
					array_unshift($cities,trans('classifieds.all-conditions'));
					return Response::json(['success' => true, 'location' => $cities]);
				}else{
					return Response::json(['success' => false]);
				}
			}
		}
	}


	public function returnDataClassified()
	{
		if (Request::ajax()) 
		{
			if (Input::has('classifiedId')) 
			{
				$classified = $this->repository->getById(Input::get('classifiedId'));
				$classifiedLanguage = $classified->getInCurrentLangAttribute();
				$categories = $classifiedLanguage->classified->getCategorieIds();
				return Response::json(['success'=>true, 'classified' => $classifiedLanguage->toArray(), 'categories' => $categories,'url'=> URL::route('products.update',Input::get('productId'))]);
			}else{
				return Response::json(['success' => false]);
			}
		}
	}

	public function returnDataClassifiedLang()
	{
		if (Request::ajax()) 
		{
			if (Input::has('classifiedId') && Input::has('languageId')) 
			{
				 $classified = $this->repository->getById(Input::get('classifiedId'));

				 $classifiedLang = $classified->getAccessorInCurrentLang(Input::get('languageId'));

				 if (count($classifiedLang) > 0) 
				 {
				 	return Response::json(['success' => true, 'classifiedLang' => $classifiedLang->toArray()]);
				 }else{
				 	return Response::json(['success' => false]);
				 }
			}else{
				return Response::json(['success' => false]);
			}
		}
	}

	public function saveCurrentLangAttribute()
	{

		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editClassifiedLangForm->validate($input);
				$classified = $this->repository->getById($input['classified_id']);
				$this->repository->updateAttributeLang($classified, $input);
				return Response::json([trans('classifieds.Actualiced')]);
			}
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
			}
		}
	}

	public function deleteAjax()
	{
		if (Request::ajax())
		{
			$this->repository->delteClassified(Input::get('classifiedId'));
			return Response::json(['success' => true]);
		}
		return Response::json(['success' => false]);
	}

}
