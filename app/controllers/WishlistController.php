<?php

//use \Entrust;
use s4h\store\Products\ProductRepository;

class WishlistController extends \BaseController {

	protected $productRepository;

	function __construct(ProductRepository $productRepository)
	{
		$this->productRepository = $productRepository;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('wishlist.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		if(Request::ajax() && Entrust::can('add-to-wishlist')) 
		{
			if ($this->productRepository->addToUserWishlist($id, Auth::user())) 
			{
				$product = $this->productRepository->getArrayForTopWishlist($id);
				$this->setSuccess(true);
				$this->addToResponseArray('product', $product);
				return $this->getResponseArrayJson();
			}
		}
		return $this->getResponseArrayJson();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function deleteAjax($id)
	{
		if(Request::ajax() && Entrust::can('remove-from-wishlist'))
			$this->setSuccess($this->productRepository->deleteFromUserWishlist($id, Auth::user()));
		return $this->getResponseArrayJson();
	}

}
