<?php namespace s4h\store\Measures;


use s4h\store\Measures\Measure;

class MeasureRepository {

	public function save(Measure $measure){
		return $measure->save();
	}

	public function getAll(){
		return Measure::all();
	}

}
