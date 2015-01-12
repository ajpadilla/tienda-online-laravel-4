<?php

use s4h\store\Products\Product;
use s4h\store\Products\ProductRepository;
use s4h\store\ProductsLang\ProductLangRepository;
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

class ProductController extends \BaseController {

	protected $productRepository;
	protected $registerProductForm;
	protected $EditProductForm;
	protected $categoryRepository;
	protected $conditionRepository;
	protected $measureRepository;
	protected $languageRepository;
	protected $productLangRepository;
	protected $weightRepository;
	protected $classifiedRepository;

	public function __construct(RegisterProductForm $registerProductForm,
										ProductRepository $productRepository,
										CategoryRepository $categoryRepository,
										ConditionRepository $conditionRepository,
										MeasureRepository $measureRepository,
										EditProductForm $editProductForm,
										LanguageRepository $languageRepository,
										ProductLangRepository $productLangRepository,
										WeightRepository $weightRepository,
										ClassifiedRepository $classifiedRepository
	)
	{
		$this->registerProductForm = $registerProductForm;
		$this->productRepository = $productRepository;
		$this->editProductForm = $editProductForm;
		$this->categoryRepository = $categoryRepository;
		$this->conditionRepository = $conditionRepository;
		$this->measureRepository = $measureRepository;
		$this->languageRepository = $languageRepository;
		$this->productLangRepository = $productLangRepository;
		$this->weightRepository = $weightRepository;
		$this->classifiedRepository = $classifiedRepository;
	}

	public function index()
	{
		return View::make('products.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		$categories = $this->categoryRepository->getNameForLanguage();
		$condition = $this->conditionRepository->getNameForLanguage();
		$measures = $this->measureRepository->getNameForLanguage();
		$weights = $this->weightRepository->getNameForLanguage();
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
			$dataProduct = [];
			try
			{
				$this->registerProductForm->validate($input);
				$product = $this->productRepository->createNewProduct($input);
				$dataProduct['product_id'] = $product->id;
				$dataProduct['language_id'] = $input['language_id'];
				if ($input['add_photos'] == 1) {
					return Response::json(['message' => trans('products.response'),
						'add_photos' => $input['add_photos'], 'url' => URL::route('photoProduct.create',$product->id)
					]);
				}
				return Response::json(['message' => trans('products.response'), 'add_photos' => 0]);
			}
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
			}
		}
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

		$product = $this->productRepository->getById($id);
		$language_id = $this->languageRepository->returnLanguage()->id;
		$product_language = $product->languages()->where('language_id','=', $language_id)->first();
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		$categories = $this->categoryRepository->getNameForLanguage();
		$condition = $this->conditionRepository->getNameForLanguage();
		$measures = $this->measureRepository->getNameForLanguage();
		return View::make('products.edit',compact('product','product_language','categories', 'condition', 'measures','languages'));
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
			$input['product_id'] = $id;
			try
			{
				$this->editProductForm->validate($input);
				$product = $this->productRepository->updateProduct($input);
				if ($input['add_photos'] == 1) {
					return Response::json(['message' => trans('products.response'),
						'add_photos' => $input['add_photos'],'productId' => $product->id,
						'languageId' => $input['language_id']
						]);
				}
				return Response::json(['message' => trans('products.response'), 'add_photos' => 0]);
			}
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
			}
		}
	}

	public function destroy($id)
	{
		$this->productRepository->deleteProduct($id);
		Flash::message(trans('products.Delete'));
		return Redirect::route('products.index');
	}



	public function getDatatable()
	{
		$collection = Datatable::collection($this->productLangRepository->getAllForLanguage($this->languageRepository->returnLanguage()->id))
			->searchColumns( 'name','price', 'quantity', 'active', 'accept_barter', 'category', 'ratings')
			->orderColumns('name','price', 'quantity', 'active', 'accept_barter');

		$collection->addColumn('photo', function($model)
		{
			$links = '';
			
			$photo = $model->product->getFirstPhoto();

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

		$collection->addColumn('price', function($model)
		{
			return $model->product->price;
		});

		$collection->addColumn('quantity', function($model)
		{
			return $model->product->quantity;
		});

		$collection->addColumn('active', function($model)
		{
			return $model->product->getActivoShow();
		});

		$collection->addColumn('accept_barter', function($model)
		{
			return $model->product->getAcceptBarterShow();
		});

		$collection->addColumn('category', function($model)
		{
			$language = $this->languageRepository->returnLanguage();

			if($model->product->hasCategories())
			{
				$product_categories = $model->product->categories()->get();
				$links = '<select class="form-control m-b">';
				foreach ($product_categories as $category) {
					$categories_languages =  $category->languages()->where('language_id','=',$language->id)->get();
					foreach ($categories_languages as $language) {
						$links .= '<option>'.$language->pivot->name.'</option>';
					}
				}
				$links .='</select>';

				return $links;
			}
			return '';
		});

		$collection->addColumn('ratings', function($model)
		{
			if($model->product->hasRatings())
			{
				return $model->product->getRating();
			}
			return '';
		});

		$collection->addColumn('Actions',function($model){

			$languageId = $this->languageRepository->returnLanguage()->id;

			$links = "<a class='btn btn-info' href='" .route('products.show', $model->product->id). "'> ".trans('products.actions.Show')." <i class='fa fa-check'></i></a><br />";
			$links .= "<a class='btn btn-warning' href='" .route('products.edit', $model->product->id). "'> ".trans('products.actions.Edit')." <i class='fa fa-pencil'></i></a><br />
					<form action=".route('products.destroy', $model->id)." method='POST' >
					<button class='btn btn-danger' > ".trans('products.actions.Delete')." <i class='fa fa-times'></i></button></form>";

			if ($model->product->active)
			{
				$links.= "<a class='btn btn-primary' href='#'> ".trans('products.actions.Activate')." <i class='fa fa-check'></i></a><br />";
			}
			else
			{
				$links.= "<a class='btn btn-danger' href='#'> ".trans('products.actions.Deactivated')." <i class='fa fa-check'></i></a><br />";
			}

			$links.= "<a class='btn btn-success' href='" .route('photoProduct.create',array($model->product->id, $languageId)). "'> ".trans('products.actions.Photo')." <i class='fa fa-camera'></i></a><br />";

			return $links;
		});

		return $collection->make();
	}

	public function showWhistList() {
		return View::make('products.whistlist');
	}

	public function search() {

		$productResults = [];

		$categoryResult = [];

		$filterWord = (Input::has('filter_word') ? Input::get('filter_word') : '');

		$language_id = $this->languageRepository->returnLanguage()->id;

		$categories = $this->categoryRepository->getAll();

		$productsSearch = $this->productRepository->filterProducts($filterWord, $language_id);

		$classifiedsSearch = $this->classifiedRepository->filterClassifieds($filterWord, $language_id);

		foreach ($categories as $category)
		{
			foreach ($productsSearch as $productSearch)
			{
				if ($productSearch->product->checkCategory($category->id)){
					$productResults[$category->getName($language_id)][] = $productSearch;
				}
			}
		}

		foreach ($categories as $category)
		{
			foreach ($classifiedsSearch as $classifiedSearch)
			{
				if ($classifiedSearch->classified->checkCategory($category->id)){
					$categoryResults[$category->getName($language_id)][] = $classifiedSearch;
				}
			}
		}

		//dd($productResults);

		if (!$productsSearch->isEmpty() || !$classifiedsSearch->isEmpty()) {
			return View::make('products.search', compact('productResults','categoryResults','language_id'));
		} else {
			Flash::warning('No se encontraron resultados que coincidan con la información suministrada para la búsqueda: ' . $filterWord);
			return View::make('products.search');
		}

	}

}
