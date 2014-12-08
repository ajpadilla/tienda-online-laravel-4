<?php namespace s4h\store\CategoriesLang;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
/**
* 
*/
class CategoryLang extends Eloquent {
	
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'categories_lang';

	public function category(){
		return $this->belongsTo('s4h\store\Categories\Category','categories_id');
	}

	public function language(){
		return $this->belongsTo('s4h\store\Languages\Language','language_id');
	}
}