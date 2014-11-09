<?php

use s4h\store\Products\Product;
use s4h\store\Products\ProductRepository;
use s4h\store\Products\RegisterProductCommand;
use s4h\store\Categories\CategoryRepository;
use s4h\store\Conditions\ConditionRepository;
use s4h\store\Forms\RegisterProductForm;
use Laracasts\Validation\FormValidationException;

class ProductController extends \BaseController {

	protected $productRepo;
	protected $RegisterProductForm;
	protected $categoryRepository;
	protected $conditionRepository;

	public function __construct(RegisterProductForm $registerProductForm, ProductRepository $productRepo, CategoryRepository $categoryRepository, ConditionRepository $conditionRepository)
	{
		$this->RegisterProductForm = $registerProductForm;
		$this->productRepo = $productRepo;
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
		$this->productRepo->save($product);
		if (!is_null($data['categories']))
			$product->categories()->sync($data['categories']);

	}

	public function getDatatable()
	{
		$collection = Datatable::collection($this->discountRepository->getAll())
			->showColumns('Photo','name','price', 'quantity', 'active', 'accept_barter', 'category', 'ratings')
			->searchColumns('Photo','name','price', 'quantity', 'active', 'accept_barter', 'category', 'ratings')
			->orderColumns('Photo','name','price', 'quantity', 'active', 'accept_barter', 'category', 'ratings');

		$collection->addColumn('Photo', function($model)
		{
			return $model->Photo;
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
			return $model->getActivoShow();
		});

		$collection->addColumn('category', function($model)
		{
			return $model->category;
		});

		$collection->addColumn('ratings', function($model)
		{
			return $model->ratings;
		});

		$collection->addColumn('Actions',function($model){
			$links = "<a href='" .route('discounts.show', $model->id). "'>View</a>
					<br />";
			$links .= "<a href='" .route('discounts.edit', $model->id). "'>Edit</a>
					<br />
					<a href='" .URL::to('delete', $model->id). "'>Delete</a>";

			return $links;
		});

		return $collection->make();
	}

}
