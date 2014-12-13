<?php namespace s4h\store\AttributeTypes;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class AttributeType extends Eloquent
{
	
	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'attribute_types';

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','attribute_types_lang','attribute_type_id','language_id')->withPivot('name');
	}	

}