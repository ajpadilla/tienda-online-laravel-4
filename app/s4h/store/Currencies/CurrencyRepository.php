<?php namespace s4h\store\Currencies;

use Mcamara\LaravelLocalization\LaravelLocalization;

class CurrencyRepository {
	public static function getCurrent(){
		$isoCode = LaravelLocalization::setLocale();
		return CurrencyRepository::whereIsoCode($isoCode)->first();
	}
}