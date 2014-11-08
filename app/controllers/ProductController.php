<?php

use s4h\store\Products\Product;
use s4h\store\Products\ProductRepository;
use s4h\store\Products\RegisterProductCommand;
use s4h\store\Forms\RegisterProductForm;
use Laracasts\Validation\FormValidationException;

class ProductController extends \BaseController {

	protected $productRepo;
	protected $RegisterProductForm;

	public function __construct(RegisterProductForm $registerProductForm, ProductRepository $productRepo)
	{
		$this->RegisterProductForm = $registerProductForm;
		$this->productRepo = $productRepo;
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
		// dd($this->productRepo->getAll());
		return View::make('products.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//dd(Input::all());
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
		// $product->condition_id = $data['condition_id'];
		// $product->user_id = $data['user_id'];
		// dd($data['categories']);
		// if (!is_null($data['categories'])) {
		// 	$product->categories()->sync($data['categories']);
		// }else{
		// 	$product->categories()->detach();
		// }
		$this->productRepo->save($product);
	}

}
