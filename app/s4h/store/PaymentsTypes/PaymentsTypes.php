<?php namespace s4h\store\PaymentsTypes;

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

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','payments_types_lang','payments_types_id','languages_id')->withPivot('name')->withTimestamps();
	}
}

