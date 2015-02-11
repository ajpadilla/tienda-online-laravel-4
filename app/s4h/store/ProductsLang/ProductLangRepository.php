<?php namespace s4h\store\ProductsLang;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\ProductsLang\ProductLang;
use s4h\store\Products\Product;
use s4h\store\Base\BaseRepository;
  /**
  *
  */
  class ProductLangRepository extends BaseRepository{

  	public function getAllForLanguage($language_id)
  	{
  		return ProductLang::where('language_id','=',$language_id)->get();
  	}

    public function getModel()
    {
      return new ProductLang;
    }

    public $filters = ['filterWord'];

    public function getProductForLanguage($productId, $languageId)
    {
      return ProductLang::where('product_id','=',$productId)->where('language_id','=',$languageId)->first();
    }
    
  }
