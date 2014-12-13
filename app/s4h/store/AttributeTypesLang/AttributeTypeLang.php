<?php namespace s4h\store\AttributeTypesLang;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
* 
*/
class AttributeTypeLang extends Eloquent
{
	
	use SoftDeletingTrait;

	protected $softDelete = true;

	protected $dates = ['deleted_at'];

	protected $table = 'attribute_types_lang';

	public function attributeType(){
		return $this->belongsTo('s4h\store\AttributeTypes\AttributeType','attribute_type_id');
	}

	public function language(){
		return $this->belongsTo('s4h\store\Languages\Language','language_id');
	}

}