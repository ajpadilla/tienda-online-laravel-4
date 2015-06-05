<?php namespace s4h\store\Measures;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Measures\Measure;

class MeasureRepository {

	public function save(Measure $measure){
		return $measure->save();
	}

	public function getAllForCurrentLang()
	{
		$iso_code = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$iso_code)->first();
		if (!empty($language)) {
			return $language->measure()->lists('abbreviation','measures_id');
		}else{
			return array();
		}
	}
		
}
