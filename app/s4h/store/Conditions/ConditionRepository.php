<?php namespace s4h\store\Conditions;


use s4h\store\Conditions\Condition;

class ConditionRepository {

	public function save(Condition $condition){
		return $condition->save();
	}

	public function getAll(){
		return Condition::all();
	}

}
