
<?php

use s4h\store\Products\Product;
use s4h\store\Products\ProductRepository;
use s4h\store\ProductsLang\ProductLangRepository;
use s4h\store\ClassifiedsLang\ClassifiedsLangRepository;
use s4h\store\Products\RegisterProductCommand;
use s4h\store\Categories\CategoryRepository;
use s4h\store\Conditions\ConditionRepository;
use s4h\store\Measures\MeasureRepository;
use s4h\store\Forms\RegisterProductForm;
use s4h\store\Forms\EditProductForm;
use s4h\store\Languages\LanguageRepository;
use s4h\store\Weights\WeightRepository;
use s4h\store\Classifieds\ClassifiedRepository;
use Laracasts\Validation\FormValidationException;
use s4h\store\Forms\EditLangProductoForm;

class ProductController extends \BaseController {

	protected $registerProductForm;
	protected $EditProductForm;
	protected $conditionRepository;
	protected $measureRepository;
	protected $languageRepository;
	protected $productLangRepository;
	protected $weightRepository;
	protected $classifiedRepository;
	protected $editLangProductoForm;
	protected $classifiedsLangRepository;

	public function __construct(RegisterProductForm $registerProductForm,
										ConditionRepository $conditionRepository,
										MeasureRepository $measureRepository,
										EditProductForm $editProductForm,
										LanguageRepository $languageRepository,
										ProductLangRepository $productLangRepository,
										WeightRepository $weightRepository,
										ClassifiedRepository $classifiedRepository,
										EditLangProductoForm $editLangProductoForm,
										ClassifiedsLangRepository $classifiedsLangRepository
	)
	{
		$this->registerProductForm = $registerProductForm;
		$this->editProductForm = $editProductForm;
		$this->conditionRepository = $conditionRepository;
		$this->measureRepository = $measureRepository;
		$this->languageRepository = $languageRepository;
		$this->productLangRepository = $productLangRepository;
		$this->weightRepository = $weightRepository;
		$this->classifiedRepository = $classifiedRepository;
		$this->editLangProductoForm = $editLangProductoForm;
		$this->classifiedsLangRepository = $classifiedsLangRepository;
	}

	public function index()
	{
		$languages = $this->languageRepository->getAllForSelect();
		$categories = $this->categoryRepository->getAllForCurrentLang();
		$condition = $this->conditionRepository->getAllForCurrentLang();
		$measures = $this->measureRepository->getAllForCurrentLang();
		$weights = $this->weightRepository->getAllForCurrentLang();
		$table = $this->productRepository->getAllTable();
		return View::make('products.index',compact('languages','categories','condition','measures','weights','table'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$languages = $this->languageRepository->getAllForSelect();
		$categories = $this->categoryRepository->getAllForCurrentLang();
		$condition = $this->conditionRepository->getAllForCurrentLang();
		$measures = $this->measureRepository->getAllForCurrentLang();
		$weights = $this->weightRepository->getAllForCurrentLang();
		return View::make('products.create', compact('categories', 'condition', 'measures','weights','languages'));
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
			try
			{
				$input['user_id'] = Auth::user()->id;
				$this->registerProductForm->validate($input);
				$product = $this->productRepository->create($input);
				$this->setSuccess(true);
				if ($input['add_photos'] == 1) 
				{
					$this->addToResponseArray('message', trans('products.response'));
					$this->addToResponseArray('add_photos', $input['add_photos']);
					$this->addToResponseArray('url', URL::route('photoProduct.create',[$product->id, $input['language_id'] ]));
					$this->addToResponseArray('data', $input);
					return $this->getResponseArrayJson();	
				}
				$this->addToResponseArray('message', trans('products.response'));
				$this->addToResponseArray('add_photos', 0);
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

	public function prueba()
	{
		var_dump($this->productRepository);		
	}

	public function show($id)
	{
		$product = $this->productRepository->getById($id);
		return View::make('products.show', compact('product'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$productLanguage = $this->productRepository->getById($id);
		$language_id = $this->languageRepository->returnLanguage()->id;
		//$product_language = $product->languages()->where('language_id','=', $language_id)->first();
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		$categories = $this->categoryRepository->getNameForLanguage();
		$condition = $this->conditionRepository->getNameForLanguage();
		$measures = $this->measureRepository->getNameForLanguage();
		return View::make('products.edit',compact('productLanguage','categories', 'condition', 'measures','languages'));
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
			$input = Input::all();
			try
			{
				$input['user_id'] = Auth::user()->id;
				$this->editProductForm->validate($input);
				$product = $this->productRepository->update($input);
				$this->setSuccess(true);
				if($input['add_photos'] == 1) 
				{
					$this->addToResponseArray('message', trans('products.Updated'));
					$this->addToResponseArray('add_photos', $input['add_photos']);
					$this->addToResponseArray('url', URL::route('photoProduct.create',[$product->id, $input['language_id'] ]));
					$this->addToResponseArray('data', $input);
					return $this->getResponseArrayJson();	
				}
				$this->addToResponseArray('message', trans('products.Updated'));
				$this->addToResponseArray('add_photos', 0);
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

	public function destroy($id)
	{
		$this->productRepository->deleteProduct($id);
		Flash::message(trans('products.Delete'));
		return Redirect::route('products.index');
		return Response::json(['response' => $id]);
	}

	public function deleteAjax()
	{
		if (Request::ajax())
		{
			//if($productRepository->isInAnyBuy(Input::get('productId'))
			$this->productRepository->deleteProduct(Input::get('productId'));
			return Response::json(['success' => true]);
		}
		return Response::json(['success' => false]);
	}

	public function search() 
	{
		$productsResultsSearch = null;
		$classifiedsResultsSearch = null;
		$categories = $this->categoryRepository->getNameForLanguage();
		$input = null;

		if(Request::ajax()) 
		{
			if(Input::has('check'))
			{
				if (count(Input::get('check')) == 1 && Input::get('check.0.value') == 'product'){
					$productsResultsSearch = $this->productRepository->search(Input::all(),'s4h\store\Base\BaseRepository::PAGINATE',Input::get('paginate'));
				}elseif (count(Input::get('check')) == 1  && Input::get('check.0.value') == 'classified') {
					$classifiedsResultsSearch = $this->classifiedRepository->search(Input::all(),'s4h\store\Base\BaseRepository::PAGINATE',Input::get('paginate'));
				}else{
					$productsResultsSearch = $this->productRepository->search(Input::all(),'s4h\store\Base\BaseRepository::PAGINATE',Input::get('paginate'));
					$classifiedsResultsSearch = $this->classifiedRepository->search(Input::all(),'s4h\store\Base\BaseRepository::PAGINATE',Input::get('paginate'));
				}	
			}else{
				$productsResultsSearch = $this->productRepository->search(Input::all(),'s4h\store\Base\BaseRepository::PAGINATE',Input::get('paginate'));
				$classifiedsResultsSearch = $this->classifiedRepository->search(Input::all(),'s4h\store\Base\BaseRepository::PAGINATE',Input::get('paginate'));
			}	
			
			$view = View::make('products.result-search-tpl',['products' => $productsResultsSearch, 'classifieds' => $classifiedsResultsSearch])->render();
			return Response::json([
				'success' => true, 
				'view' => $view,
				'input' => Input::all(),
			]);
		} 
		else {
			$input = Input::all();
			$input['orderBy'] = 'rating-desc'; 
			$productsResultsSearch = $this->productRepository->search($input,'s4h\store\Base\BaseRepository::PAGINATE');
			$classifiedsResultsSearch  = $this->classifiedRepository->search(Input::all(),'s4h\store\Base\BaseRepository::PAGINATE');

			if (!$productsResultsSearch->isEmpty() || !$classifiedsResultsSearch->isEmpty()) 
			{
				Session::put('word', Input::get('filterWord'));
				$products = $productsResultsSearch;
				$classifieds = $classifiedsResultsSearch;
				return View::make('products.search-result', compact('products','classifieds','categories'));
			} else {
				Flash::warning('No se encontraron resultados que coincidan con la información suministrada para la búsqueda');
			}
		}

	}

	public function sortSearchResults(){
		$productsResultsSearch = $this->productRepository->search(Input::all(),'s4h\store\Base\BaseRepository::PAGINATE',Input::get('paginate'));
		$classifiedsResultsSearch = $this->classifiedRepository->search(Input::all(),'s4h\store\Base\BaseRepository::PAGINATE',Input::get('paginate'));
	}

	public function getCurrentFilterWorld(){
		return Response::json(['success' => true, 'word' =>  Session::get('word')]);
	}

	public function showApi()
	{
		if (Request::ajax())
		{
			if (Input::has('productId'))
			{
				$product = $this->productRepository->getArrayInCurrentLangData(Input::get('productId'));
				$this->setSuccess(true);
				$this->addToResponseArray('product', $product);
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
			if (Input::has('productId') && Input::has('languageId'))
			{
				$productLang = $this->productRepository->getDataForLanguage(Input::get('productId'), Input::get('languageId'));
				$this->setSuccess(true);
				$this->addToResponseArray('productLang', $productLang);
				return $this->getResponseArrayJson();
			}else{
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
	}

	public function saveDataForLanguage()
	{

		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editLangProductoForm->validate($input);
				$this->productRepository->updateDataForProduct($input);
				return Response::json([trans('products.Updated')]);
			}
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
			}
		}
	}

	public function saveRating()
	{
		if(Request::ajax()) {
			$data = Input::all();
			return Response::json([
				'success' => $this->productRepository->saveRating($data['product_id'], $data['points'], $data['description'])
			]);
		}
		return Response::json(['success' => false]);
	}

	public function listApi()
	{
		return $this->productRepository->getDefaultTableForAll();
	}
}
