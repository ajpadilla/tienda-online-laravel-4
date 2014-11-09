<?php namespace s4h\store\Conditions;

use Eloquent;

class Condition extends Eloquent{

	protected $fillable = ['name'];
	protected $table = 'product_conditions';

	public function categories()
	{
		return $this->hasMany('s4h\store\Categories\Category');
	}

}
