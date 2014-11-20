<?php namespace s4h\store\Classifieds;

use s4h\store\Classifieds\Classified;
use s4h\store\Languages\Language;
use s4h\store\Photos\ClassifiedPhotos;

/**
* 
*/
class ClassifiedRepository{

	public function createNewClassified($data = array())
	{
		$classified = new Classified;
		$classified->price = $data['price'];
		$classified->user_id = $data['price'];
		$classified->classified_type_id = $data['classified_type_id'];
		$classified->classified_condition_id = $data['classified_condition_id'];
		$classified->save();
		$classified->languages()->attach($data['language_id'], array('name'=> $data['name'],
			'description'=> $data['description'],
			'address' => $data['address']
		));
	}
	
}
