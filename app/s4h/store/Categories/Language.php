<?php namespace s4h\store\Categories;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Language extends Eloquent {

	use SoftDeletingTrait;
	protected $softDelete = true;
	protected $dates = ['deleted_at'];
	protected $table = 'categories_lang';

	public function category(){
		return $this->belongsTo('s4h\store\Categories\Category');
	}

	public function language(){
		return $this->belongsTo('s4h\store\Languages\Language');
	}
}