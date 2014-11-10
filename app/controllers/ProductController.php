<?php

use s4h\store\Products\Product;
use s4h\store\Products\ProductRepository;
use s4h\store\Products\RegisterProductCommand;
use s4h\store\Categories\CategoryRepository;
use s4h\store\Conditions\ConditionRepository;
use s4h\store\Forms\RegisterProductForm;
use Laracasts\Validation\FormValidationException;

class ProductController extends \BaseController {

	protected $productRepository;
	protected $registerProductForm;
	protected $categoryRepository;
	protected $conditionRepository;

	public function __construct(RegisterProductForm $registerProductForm, ProductRepository $productRepository, CategoryRepository $categoryRepository, ConditionRepository $conditionRepository)
	{
		$this->RegisterProductForm = $registerProductForm;
		$this->productRepository = $productRepository;
		$this->categoryRepository = $categoryRepository;
		$this->conditionRepository = $conditionRepository;
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
		$categories = $this->categoryRepository->getAll()->lists('name', 'id');
		$condition = $this->conditionRepository->getAll()->lists('name', 'id');
		return View::make('products.create', compact('categories', 'condition'));
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
				$this->RegisterProductForm->validate($input);
				$this->createNewProduct($input);
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
		return false;
	}

	public function destroy($id)
	{
		$product = Product::find($id);
		$product->delete();
		Flash::message('producto borrado  con éxito!');
		return Redirect::to('products');
	}

	public function createNewProduct($data = array())
	{
		$product = new Product;
		$product->name = $data['name'];
		$product->description = $data['description'];
		$product->on_sale = $data['on_sale'];
		$product->quantity = $data['quantity'];
		$product->price = $data['price'];
		$product->width = $data['width'];
		$product->height = $data['height'];
		$product->depth = $data['depth'];
		$product->weight = $data['weight'];
		$product->active = $data['active'];
		$product->available_for_order = $data['available_for_order'];
		$product->show_price = $data['show_price'];
		$product->accept_barter = $data['accept_barter'];
		$product->product_for_barter = $data['product_for_barter'];
		$product->condition_id = $data['condition_id'];


		/*$user = Auth::user();
		$product->associate($user);*/
		$this->productRepository->save($product);
		if (!is_null($data['categories']))
			$product->categories()->sync($data['categories']);

	}

	public function getDatatable()
	{
		$collection = Datatable::collection($this->productRepository->getAll())
			->showColumns('photo', 'name','price', 'quantity', 'active', 'accept_barter', 'category', 'ratings')
			->searchColumns( 'name','price', 'quantity', 'active', 'accept_barter', 'category', 'ratings')
			->orderColumns('name','price', 'quantity', 'active', 'accept_barter');

		$collection->addColumn('photo', function($model)
		{
			$links = '';
			if($model->hasPhotos()){
					$photo = $model->getFirstPhoto();
					$links = "<a href='#'><img class='mini-photo' alt='" . $photo->name . "' src='" . asset($photo->path . $photo->name) . "'></a>";

			}
			return $links;
		});

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
			$links = "<a class='btn btn-info btn-circle' href='" .route('products.show', $model->id). "'><i class='fa fa-check'></i></a>
					<br />";
			$links .= "<a class='btn btn-warning btn-circle' href='" .route('products.show', $model->id). "'><i class='fa fa-pencil'></i></a>
					<br />
					<form action=".route('products.destroy', $model->id)." method='delete' >
					<button class='btn btn-danger btn-circle' ><i class='fa fa-times'></i></button></form>";

			return $links;
		});

		return $collection->make();
	}

}
