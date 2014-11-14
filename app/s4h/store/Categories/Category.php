<?php namespace s4h\store\Categories;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends Eloquent{

	use SoftDeletingTrait;
	protected $softDelete = true;
	protected $dates = ['deleted_at'];

	protected $fillable = ['name', 'category_id'];

}
