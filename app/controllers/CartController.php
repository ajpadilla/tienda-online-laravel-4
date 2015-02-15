<?php

use \Entrust;
use s4h\store\Products\Product;
use s4h\store\Products\ProductRepository;
use s4h\store\Users\UserRepository;

class CartController extends \BaseController {

	protected $productRepository;

	function __construct(ProductRepository $productRepository, UserRepository $userRepository)
	{
		$this->productRepository = $productRepository;
		$this->userRepository = $userRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id, $quantity = 1)
	{
		$response = ['success' => FALSE];
		if(Request::ajax() && Entrust::can('add-to-cart')) {
			if (!$this->cartRepository->getActiveCartForUser(Auth::user()))
				$this->cartRepository->createNewCartForUser(Auth::user());

			if ($this->productRepository->addToUserCart($id, $quantity, Auth::user())) {
				$response['success'] = TRUE;
				$response['product'] = $this->productRepository->getArrayForTopCart(Auth::user(), $id);
			}
		}
		return Response::json($response);
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
	public function show($id, $user = Auth::user())
	{
		$user = (is_int($user) ? $this->userRepository->get($user) : $user);
		$cart = $this->cartRepository->getActiveCartForUser($user);
		View::make('carts.show', compact('cart'));
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
		$response = ['success' => FALSE];
		if(Request::ajax() && Entrust::can('remove-from-cart'))
			$response['success'] = $this->productRepository->deleteFromUserCart($id, Auth::user());
		return Response::json($response);
	}


}
