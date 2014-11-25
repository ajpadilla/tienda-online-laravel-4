<?php namespace s4h\store\Measures;

// use Andrew13\Cabinet\CabinetUpload;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

// class Photo extends CabinetUpload {
class Measure extends Eloquent {

	use SoftDeletingTrait;
	protected $softDelete = true;
	protected $dates = ['deleted_at'];

	public function product(){
		return $this->belongsTo('s4h\store\Products\Product');
	}

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','measures_lang','measures_id','language_id')->withPivot('name','abbreviation');
	}	
}
