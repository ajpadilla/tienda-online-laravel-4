<?php

use s4h\store\Classifieds\ClassifiedRepository;
use s4h\store\Languages\LanguageRepository;
use s4h\store\Photos\ClassifiedPhotos;
class PhotosClassifiedsController extends \BaseController {

	private $classifiedRepository;
	private $languageRepository;

	function __construct(ClassifiedRepository $classifiedRepository, LanguageRepository $languageRepository) {
		$this->classifiedRepository = $classifiedRepository;
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
	public function create($classifiedId)
	{
		$classified = $this->classifiedRepository->getById($classifiedId);
		$classifiedLanguage = $classified->getInCurrentLangAttribute();
		return View::make('photos_classifieds.create',compact('classifiedId','classifiedLanguage'));
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
			$classifiedId = Input::get('classifiedId');
			$photo = new ClassifiedPhotos();
			$photo->register($file, $classifiedId, 1);
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
