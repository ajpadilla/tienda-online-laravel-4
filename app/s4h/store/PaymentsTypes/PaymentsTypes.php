<?php namespace s4h\store\PaymentCredentialDetails;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseModel;

/**
* 
*/
class PaymentsTypes extends BaseModel{
	use SoftDeletingTrait;
	
	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'payments_types';
}

