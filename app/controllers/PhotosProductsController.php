<?php

use s4h\store\Products\ProductRepository;
use s4h\store\Languages\LanguageRepository;
use s4h\store\Photos\ProductPhotos;

class PhotosProductsController extends \BaseController {
	private $languageRepository;
	private $productRepository;

	function __construct(ProductRepository $productRepository, LanguageRepository $languageRepository) {
		$this->productRepository = $productRepository;
		$this->languageRepository = $languageRepository;
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
	public function create($productoId, $languageId)
	{
		$product = $this->productRepository->getById($productoId);
		$productLanguage = $product->languages()->where('language_id','=', $languageId)->first();
		return View::make('photos_products.create',compact('productoId','productLanguage','product'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try {
			$file = Input::file('file');
			$product_id = Input::get('product_id');
			$photo = new ProductPhotos();
			$photo->register($file, $product_id, 1);
		} catch(Exception $exception){
			// Something went wrong. Log it.
			Log::error($exception);
			// Return error
			return Response::json($exception->getMessage(), 400);
		}
		// If it now has an id, it should have been successful.
		if ( $photo->id ) {
			return Response::json(array('status' => 'success', 'file' => $photo->toArray()), 200);
		} else {
			return Response::json('Error', 400);
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


}
