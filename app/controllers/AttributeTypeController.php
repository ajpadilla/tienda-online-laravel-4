<?php

use s4h\store\Languages\LanguageRepository;
use s4h\store\s4h\store\AttributeTypes\AttributeTypeRepository;
use s4h\store\AttributeTypesLang\AttributeTypeLangRepository;

class AttributeTypeController extends \BaseController {

	private $languageRepository;
	private $attributeTypeRepository;
	private $attributeTypeLangRepository;

	function __construct(LanguageRepository $languageRepository, AttributeTypeRepository $attributeTypeRepository, AttributeTypeLangRepository $attributeTypeLangRepository) {
		$this->languageRepository = $languageRepository;
		$this->attributeTypeRepository = $attributeTypeRepository;
		$this->attributeTypeLangRepository = $attributeTypeLangRepository;
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
	public function create()
	{
		//
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


}
