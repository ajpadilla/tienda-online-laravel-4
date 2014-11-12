<?php namespace s4h\store\Products;

use Eloquent;
use SoftDeletingTrait;

class Product extends Eloquent{

	protected $fillable = ['name','description','on_sale','quantity','price','width','height','depth','weight','active','available_for_barter', 'show_price', 'accept_barter', 'product_for_barter', 'condition_id','user_id'];
	protected $softDelete = true;

	protected $dates = ['deleted_at'];
	/*
	* Realaciones
	*/
	public function categories()
	{
		return $this->belongsToMany('s4h\store\Categories\Category', 'product_classification');
	}

	public function condition()
	{
		return $this->belongsto('s4h\store\Conditions\Condition');
	}

	public function photos()
	{
		return $this->hasMany('s4h\store\Photos\Photo');
	}

	public function ratings()
	{
		return $this->hasMany('s4h\store\Ratings\Rating');
	}

	/*
	*
	*/

	public function getActivoShow()
	{
		return ($this->active == 1) ? 'Yes' : 'No';
	}

	public function getAcceptBarterShow()
	{
		return ($this->accept_barter == 1) ? 'Yes' : 'No';
	}

	public function hasPhotos(){
		return $this->photos->count();
	}

	public function hasCategories(){
		return $this->categories->count();
	}

	public function hasRatings(){
		return $this->ratings->count();
	}

	/*
	* Obtener la priemra de
	*/
	public function getFirstPhoto(){
		if($this->hasPhotos())
			foreach ($this->photos as $photo)
				return $photo;
		return false;
	}

	public function getFirstCategory(){
		if($this->hasCategories())
			foreach ($this->categories as $category)
				return $category;
		return false;
	}

	/*
	* Obtener rating
	*/

	public function getRating()
	{
		if($this->hasRatings()){
			$count = 0;
			foreach ($this->ratings as $rating) {
				$count = $count + $rating->points;
			}
			return round(($count / $this->hasRatings()), 2);
		}
		return false;
	}


	/*
	*	Eliminar producto y relaciones
	*/
	public function delete()
	{
		$this->photos()->delete();
		$this->categories()->delete();
		return parent::delete();
	}
}
