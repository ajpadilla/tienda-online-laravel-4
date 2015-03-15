<?php namespace s4h\store\Products;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\ProductsLang\ProductLang;
use s4h\store\Base\BaseModel;

class Product extends BaseModel{
	use SoftDeletingTrait;
	protected $softDelete = true;
	protected $dates = ['deleted_at'];

	protected $fillable = ['on_sale','quantity','price','width','height','depth','weight','active','available_for_barter', 'show_price', 'accept_barter', 'product_for_barter', 'condition_id','user_id', 'measure_id', 'weight_id'];

	/*
	* Relaciones
	*/
	public function categories()
	{
		return $this->belongsToMany('s4h\store\Categories\Category', 'product_classification')->withTimestamps();
	}

	public function languages(){
		return $this->belongsToMany('s4h\store\Languages\Language','products_lang','product_id','language_id')->withPivot('name','description')->withTimestamps();
	}

	public function getInCurrentLangAttribute(){
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		return ProductLang::whereProductId($this->id)->whereLanguageId($language->id)->first();
	}

	public function condition()
	{
		return $this->belongsTo('s4h\store\Conditions\Condition');
	}

	public function photos()
	{
		return $this->hasMany('s4h\store\Photos\ProductPhotos');
	}

	public function ratings()
	{
		return $this->hasMany('s4h\store\Ratings\Rating');
	}

	public function wishlist()
	{
		return $this->belongsToMany('s4h\store\Users\User', 'wishlist')->withTimestamps();
	}

	public function carts()
	{
		return $this->belongsToMany('s4h\store\Carts\Cart')->withPivot('quantity')->withTimestamps();
	}

	public function user(){
		return $this->belongsTo('s4h\store\Users\User','user_id');
	}

	/*
	*
	*/

	public function getActivoShowAttribute()
	{
		return ($this->active == 1) ? 'Yes' : 'No';
	}

	public function getAcceptBarterShowAttribute()
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

	public function hasLanguages(){
		return $this->languages->count();
	}

	public function hasWishlistUsers(){
		return $this->wishlistUsers->count();
	}

	public function hasCartUsers(){
		return $this->cartUsers->count();
	}


	/*
	* Obtener la priemra de las fotos del producto
	*/
	public function getFirstPhotoAttribute(){
		if($this->hasPhotos())
			foreach ($this->photos as $photo)
				return $photo;
		return false;
	}

	public function getFirstCategoryAttribute(){
		if($this->hasCategories())
			foreach ($this->categories as $category)
				return $category;
		return false;
	}

	/*
	* Obtener rating
	*/

	public function getRatingAttribute()
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

	public function getCategories()
	{
		$categoriesNames = [];

		$language = $this->getCurrentLang();

		if($this->hasCategories())
			foreach ($this->categories as $category)
			{
				$categoriesLanguages =  $category->languages()->where('language_id','=',$language->id)->get();
				foreach ($categoriesLanguages as $categoryLanguage)
				{
					$categoriesNames[] = $categoryLanguage->pivot->name;
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

	public function getPriceAttribute($value){
		return number_format($value, '2');
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

		/*if ($this->hasWishlistUsers())
			$this->wishlistUsers()->delete();

		if ($this->hasCartUsers())
			$this->cartUsers()->delete();*/

		ProductLang::where('product_id','=',$this->id)->delete();
		return parent::delete();
	}
}
