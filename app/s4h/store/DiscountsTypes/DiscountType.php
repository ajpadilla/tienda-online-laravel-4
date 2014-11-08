<?php namespace s4h\store\DiscountsTypes;

use Eloquent;

class DiscountType extends Eloquent {
	
	protected $table = 'discounts_types';

	protected $fillable = ['name'];
}