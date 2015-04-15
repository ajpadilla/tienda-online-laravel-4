<?php namespace s4h\store\PaymentCredentialDetails;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseModel;


/**
* 
*/
class PaymentCredentialDetails extends BaseModel{
	use SoftDeletingTrait;
	
	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'payment_credential_details';

	protected $fillable = ['email','credit_cart_number','credit_cart_security_numbe','credit_cart_expire_date','payments_types_id','users_id','card_brands_id'];
	
	public function paymentsTypes(){
		return $this->belongsTo('s4h\store\PaymentsTypes\PaymentsTypes','payments_types_id');
	}

	public function user(){
		return $this->belongsTo('s4h\store\Users\User','users_id');
	}

	public function cardBrand(){
		return $this->belongsTo('s4h\store\CardBrands\CardBrands','card_brands_id');
	}
}