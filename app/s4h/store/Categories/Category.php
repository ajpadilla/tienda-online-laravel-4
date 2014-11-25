<?php namespace s4h\store\Categories;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends Eloquent{

	use SoftDeletingTrait;
	protected $softDelete = true;
	protected $dates = ['deleted_at'];

	//protected $fillable = ['category_id'];

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','categories_lang','category_id','language_id')->withPivot('name');
	}	
}
