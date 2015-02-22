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
	protected $editLangProductoForm;
	protected $classifiedsLangRepository;

	public function __construct(RegisterProductForm $registerProductForm,
										ProductRepository $productRepository,
										CategoryRepository $categoryRepository,
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
		$this->productRepository = $productRepository;
		$this->editProductForm = $editProductForm;
		$this->categoryRepository = $categoryRepository;
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
		$languages = $this->languageRepository->getAll()->lists('name', 'id');
		$categories = $this->categoryRepository->getNameForLanguage();
		$condition = $this->conditionRepository->getNameForLanguage();
		$measures = $this->measureRepository->getNameForLanguage();
		$weights = $this->weightRepository->getNameForLanguage();
		return View::make('products.index',compact('languages','categories','condition','measures','weights'));
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
			try
			{
				$this->registerProductForm->validate($input);
				$product = $this->productRepository->createNewProduct($input);
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
	public function update()
	{
		if(Request::ajax())
		{
			$input = Input::all();
			try
			{
				$this->editProductForm->validate($input);
				$product = $this->productRepository->updateProduct($input);
				if ($input['add_photos'] == 1) {
					return Response::json(['message' => trans('products.Updated'),
						'add_photos' => $input['add_photos'], 'url' => URL::route('photoProduct.create',$product->id)
					]);
				}
				return Response::json(['message' => trans('products.Updated'), 'add_photos' => 0]);
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

			$links = "<form action='".route('products.show',$model->product->id)."' method='get'>
						<button href='#'  class='btn btn-success btn-outline dim col-sm-6 show' style='margin-left: 20px;' type='submit' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Show')."'  data-original-title='".trans('products.actions.Show')."' ><i class='fa fa-check fa-2x'></i></button><br/>
					  </form>";

			$links.= "<button href='#fancybox-edit-product' id='edit_".$model->product->id."' class='btn btn-warning btn-outline dim col-sm-6 edit' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Edit')."'  data-original-title='".trans('products.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
					 </button><br/>";

			$links.= "<button href='#' class='btn btn-danger btn-outline dim col-sm-6' id='delet_".$model->product->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Delete')."'  data-original-title='".trans('products.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
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

			$links.= "<button href='#fancybox-edit-language-product' id='language_".$model->product->id."'  class='btn btn-success btn-outline dim col-sm-6 language' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Language')."'  data-original-title='".trans('products.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />";

			return $links;
		});

		return $collection->make();
	}

	public function search() {
		$products = null;
		if(Request::ajax()) {
			$productsSearch= $this->productRepository->search(Input::all(),'s4h\store\Base\BaseRepository::PAGINATE');

			return Response::json($productsSearch);
		} else {

			/*$productsSearch = $this->productRepository->search(Input::all(),'s4h\store\Base\BaseRepository::PAGINATE');

			if (!$productsSearch->isEmpty()) 
			{
				$products = $productsSearch;
				return View::make('products.search-result', compact('products','categoryResults'));
			} else {
				Flash::warning('No se encontraron resultados que coincidan con la información suministrada para la búsqueda');
				return View::make('products.search');
			}*/

			return View::make('products.search-result', compact('products','categoryResults'));

		}
	}

	public function returnDataProduct()
	{
		if (Request::ajax())
		{
			if (Input::has('productId'))
			{
				$product = $this->productRepository->getById(Input::get('productId'));
				$productLanguage = $product->getInCurrentLangAttribute();
				$categories = $productLanguage->product->getCategorieIds();
				return Response::json(['success'=>true, 'product' => $productLanguage->toArray(), 'categories' => $categories,'url'=> URL::route('products.update',Input::get('productId'))]);
			}else{
				return Response::json(['success' => false]);
			}
		}
	}

	public function returnDataProductLang()
	{
		if (Request::ajax())
		{
			if (Input::has('productId') && Input::has('languageId'))
			{
				 $productLang = $this->productLangRepository->getProductForLanguage(Input::get('productId'), Input::get('languageId'));
				 if (count($productLang) > 0)
				 {
				 	return Response::json(['success' => true, 'productLang' => $productLang->toArray()]);
				 }else{
				 	return Response::json(['success' => false]);
				 }
			}else{
				return Response::json(['success' => false]);
			}
		}
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
}
