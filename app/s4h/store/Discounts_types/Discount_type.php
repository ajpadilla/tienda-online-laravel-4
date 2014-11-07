<?php namespace s4h\store\Discounts_types;

use Eloquent;

class Discount_type extends Eloquent {
	
	protected $table = 'discounts_types';

	protected $fillable = ['name'];
}