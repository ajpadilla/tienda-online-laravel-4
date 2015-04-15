<?php namespace s4h\store\PaymentsTypesLang;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseModel;

/**
* 
*/
class PaymentsTypesLang extends BaseModel{
	use SoftDeletingTrait;
	
	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'payments_types_lang';

}

