<?php namespace s4h\store\Products;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use s4h\store\ProductsLang\ProductLang;

class Product extends Eloquent{
	use SoftDeletingTrait;
	protected $softDelete = true;
	protected $dates = ['deleted_at'];

	protected $fillable = ['on_sale','quantity','price','width','height','depth','weight','active','available_for_barter', 'show_price', 'accept_barter', 'product_for_barter', 'condition_id','user_id', 'measure_id', 'weight_id'];

	/*
	* Realaciones
	*/
	public function categories()
	{
		return $this->belongsToMany('s4h\store\Categories\Category', 'product_classification');
	}

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','products_lang','product_id','language_id')->withPivot('name','description')->withTimestamps();
	}

	public function condition()
	{
		return $this->belongsto('s4h\store\Conditions\Condition');
	}

	public function photos()
	{
		return $this->hasMany('s4h\store\Photos\ProductPhotos');
	}

	public function ratings()
	{
		return $this->hasMany('s4h\store\Ratings\Rating');
	}

	public function wishlistUsers()
	{
		return $this->belongsToMany('s4h\store\Users\User', 'wishlist')->withTimestamps();
	}

	public function cartUsers()
	{
		return $this->belongsToMany('s4h\store\Users\User', 'cart', 'product_id', 'user_id')->withPivot('quantity')->withTimestamps();
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

	public function getCategories($language_id)
	{
		$categoriesNames = [];

		if($this->hasCategories())
			foreach ($this->categories as $category)
			{
				$categories_languages =  $category->languages()->where('language_id','=',$language_id)->get();
				foreach ($categories_languages as $language)
				{
					$categoriesNames[$language->pivot->name] = $language->pivot->name;
				}
			}
			return $categoriesNames;
	}

	public function getCategorieIds()
	{
		$categorieIds = [];

		if($this->hasCategories())
			foreach ($this->categories as $category)
			{
				$categorieIds[] = $category->id;
			}
			return $categorieIds;
	}

	public function checkCategory($category_id)
	{
		if($this->hasCategories())
			foreach ($this->categories as $category)
				if ($category->id == $category_id)
					return true;
			return false;
		return false;
	}



	/*
	*	Eliminar producto y relaciones
	*/
	public function delete()
	{
		if($this->hasPhotos())
			$this->photos()->delete();
		if($this->hasRatings())
			$this->ratings()->delete();
		ProductLang::where('product_id','=',$this->id)->delete();
		return parent::delete();
	}
}
