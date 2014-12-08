<?php namespace s4h\store\Categories;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends Eloquent{

	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'categories';

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','categories_lang','categories_id','language_id')->withPivot('name');
	}	

	public function categories()
	{
		return $this->hasMany('s4h\store\Categories\Category');
	}

	public function parent()
	{
		return $this->belongsTo('s4h\store\Categories\Category','category_id');
	}

	public function hasParent()
	{
		if (count($this->parent) > 0) {
			return true;
		}
		return false;
	}
	
}
