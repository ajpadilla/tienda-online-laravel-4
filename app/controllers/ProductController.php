<?php

use s4h\store\Products\Product;
use s4h\store\Products\ProductRepository;
use s4h\store\Products\RegisterProductCommand;
use s4h\store\Categories\CategoryRepository;
use s4h\store\Conditions\ConditionRepository;
use s4h\store\Measures\MeasureRepository;
use s4h\store\Forms\RegisterProductForm;
use s4h\store\Forms\EditProductForm;
use s4h\store\Languages\LanguageRepository;
use Laracasts\Validation\FormValidationException;

class ProductController extends \BaseController {

	protected $productRepository;
	protected $registerProductForm;
	protected $EditProductForm;
	protected $categoryRepository;
	protected $conditionRepository;
	protected $measureRepository;
	protected $languageRepository;

	public function __construct(RegisterProductForm $registerProductForm,
										ProductRepository $productRepository,
										CategoryRepository $categoryRepository,
										ConditionRepository $conditionRepository,
										MeasureRepository $measureRepository,
										EditProductForm $editProductForm,
										LanguageRepository $languageRepository
	)
	{
		$this->registerProductForm = $registerProductForm;
		$this->productRepository = $productRepository;
		$this->editProductForm = $editProductForm;
		$this->categoryRepository = $categoryRepository;
		$this->conditionRepository = $conditionRepository;
		$this->measureRepository = $measureRepository;
		$this->languageRepository = $languageRepository;
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
		$categories = $this->categoryRepository->getNameForLanguage();;
		$condition = $this->conditionRepository->getNameForLanguage();
		$measures = $this->measureRepository->getNameForLanguage();;
		return View::make('products.create', compact('categories', 'condition', 'measures','languages'));
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
				$this->productRepository->createNewProduct($input);
				return Response::json('Producto'.' '.$input['name'].' '.'Agregado con exito!');
			}
			catch (FormValidationException $e)
			{
				return Response::json($e->getErrors()->all());
			}
		}
	}

	public function show()
	{
		return View::make('products.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$product = Product::find($id);
		$categories = $this->categoryRepository->getAll()->lists('name', 'id');
		$condition = $this->conditionRepository->getAll()->lists('name', 'id');
		$measures = $this->measureRepository->getAll()->lists('name', 'id');
		return View::make('products.edit',compact('product', 'categories', 'condition', 'measures'));
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
			$input = Input::all();
			try
			{
				$this->editProductForm->validate($input);
				$product = Product::find($id);
				$product->name = $input['name'];
				$product->description = $input['description'];
				$product->on_sale = $input['on_sale'];
				$product->quantity = $input['quantity'];
				$product->measure_id = $input['measure_id'];
				$product->price = $input['price'];
				$product->width = $input['width'];
				$product->height = $input['height'];
				$product->depth = $input['depth'];
				$product->weight = $input['weight'];
				$product->active = $input['active'];
				$product->available_for_order = $input['available_for_order'];
				$product->show_price = $input['show_price'];
				$product->accept_barter = $input['accept_barter'];
				$product->product_for_barter = $input['product_for_barter'];
				$product->condition_id = $input['condition_id'];

				$this->productRepository->save($product);
				if (isset($input['categories'])){
					$product->categories()->sync($input['categories']);
				}else{
					$product->categories()->detach();
				}
				return Response::json('Producto'.' '.$input['name'].' '.'Modificado con exito!');
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
		return Redirect::back();
	}




	public function getDatatable()
	{
		$collection = Datatable::collection($this->productRepository->getAll())
			->showColumns('photo', 'name','price', 'quantity', 'active', 'accept_barter', 'category', 'ratings')
			->searchColumns( 'name','price', 'quantity', 'active', 'accept_barter', 'category', 'ratings')
			->orderColumns('name','price', 'quantity', 'active', 'accept_barter');

		/*$collection->addColumn('photo', function($model)
		{
			$links = '';
			if($model->hasPhotos()){
					$photo = $model->getFirstPhoto();
					$links = "<a href='#'><img class='mini-photo' alt='" . $photo->name . "' src='" . asset($photo->path . $photo->name) . "'></a>";

			}
			return $links;
		});*/

		$collection->addColumn('name', function($model)
		{
			 return $model->name;
		});

		$collection->addColumn('price', function($model)
		{
			return $model->price;
		});

		$collection->addColumn('quantity', function($model)
		{
			return $model->quantity;
		});

		$collection->addColumn('active', function($model)
		{
			return $model->getActivoShow();
		});

		$collection->addColumn('accept_barter', function($model)
		{
			return $model->getAcceptBarterShow();
		});

		$collection->addColumn('category', function($model)
		{
			if($model->hasCategories())
			{
				$links = '<select class="form-control m-b">';
				foreach ($model->categories as $category) {
					$links .= '<option>'.$category->name.'</option>';
				}
				$links .='</select>';

				return $links;
			}
			return '';
		});

		$collection->addColumn('ratings', function($model)
		{
			if($model->hasRatings())
			{
				return $model->getRating();
			}
			return '';
		});

		$collection->addColumn('Actions',function($model){
			$links = "<a class='btn btn-info btn-circle' href='" .route('products.destroy', $model->id). "'><i class='fa fa-check'></i></a><br />";
			$links .= "<a class='btn btn-warning btn-circle' href='" .route('products.edit', $model->id). "'><i class='fa fa-pencil'></i></a><br />
					<form action=".route('products.destroy', $model->id)." method='POST' >
					<button class='btn btn-danger btn-circle' ><i class='fa fa-times'></i></button></form>";


			return $links;
		});

		return $collection->make();
	}

}
