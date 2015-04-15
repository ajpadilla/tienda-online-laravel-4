<?php namespace s4h\store\PaymentsTypes;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseModel;
use s4h\store\PaymentsTypesLang\PaymentsTypesLang;

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

	public function getInCurrentLangAttribute(){
		$language = $this->getCurrentLang();
		return PaymentsTypesLang::wherePaymentsTypesId($this->id)->wherelanguagesId($language->id)->first();
	}

}

