<?php namespace s4h\store\States;


use s4h\store\States\State;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseRepository;

class StateRepository extends BaseRepository {

	function __construct() {
		$this->columns = [];
		$this->setModel(new State);
		$this->setListAllRoute('categories.api.list');
	}

	public function getListOfCities($stateId)
	{
		$state = $this->get($stateId);
		$cities = $state->cities()->where('states_id', '=', $stateId)->lists('name', 'id');
		return $cities;
	}
}