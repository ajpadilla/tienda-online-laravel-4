<?php namespace s4h\store\ShipmentStatus;
	
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\ShipmentStatusLang\ShipmentStatusLang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
/**
 * 
 */
 class Shipment_Status extends Eloquent {
 	
 	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'shipment_status';

	protected $fillable = ['color'];
 	
 	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','shipment_status_lang','shipment_status_id','language_id')->withPivot('name','description');
	}

	public function getInCurrentLangAttribute(){
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		return ShipmentStatusLang::whereShipmentStatusId($this->id)->whereLanguageId($language->id)->first();
	}


	public function delete(){
		ShipmentStatusLang::where('shipment_status_id','=',$this->id)->delete();
		return parent::delete();
	}

 } 
