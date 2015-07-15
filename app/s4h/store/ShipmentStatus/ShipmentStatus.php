<?php namespace s4h\store\ShipmentStatus;
	
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\ShipmentStatusLang\ShipmentStatusLang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseModel;
/**
 * 
 */
 class ShipmentStatus extends BaseModel {
 	
 	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	
	protected $table = 'shipment_status';

	protected $fillable = ['color'];
 	
 	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','shipment_status_lang','shipment_status_id','language_id')->withPivot('name','description');
	}

	public function getInCurrentLangAttribute(){
		$language = $this->getCurrentLang();
		return ShipmentStatusLang::whereShipmentStatusId($this->id)->whereLanguageId($language->id)->first();
	}

	public function getAccessorInCurrentLang($languageId = ''){
		return ShipmentStatusLang::whereShipmentStatusId($this->id)->whereLanguageId($languageId)->first();
	}

	public function delete(){
		ShipmentStatusLang::where('shipment_status_id','=',$this->id)->delete();
		return parent::delete();
	}
 } 
