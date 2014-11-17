<?php

use s4h\store\InvoiceStatus\InvoiceStatusRepository;
use s4h\store\InvoiceStatusLang\InvoiceStatusLangRepository;
use s4h\store\Languages\LanguageRepository;
use s4h\store\Forms\RegisterInvoiceStatusForm;
use Laracasts\Validation\FormValidationException;

class InvoiceStatusController extends \BaseController {
	private $invoiceStatusRepository;
	private $invoiceStatusLangRepository;
	private $languageRepository;
	private $registerInvoiceStatusForm;

	function __construct(InvoiceStatusRepository $invoiceStatusRepository, InvoiceStatusLangRepository $invoiceStatusLangRepository, LanguageRepository $languageRepository, RegisterInvoiceStatusForm $registerInvoiceStatusForm) {
		$this->invoiceStatusRepository = $invoiceStatusRepository;
		$this->invoiceStatusLangRepository = $invoiceStatusLangRepository;
		$this->languageRepository = $languageRepository;
		$this->registerInvoiceStatusForm = $registerInvoiceStatusForm;
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
