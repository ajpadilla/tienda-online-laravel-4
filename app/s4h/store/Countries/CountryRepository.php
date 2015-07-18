<?php namespace s4h\store\Countries;


use s4h\store\Countries\Country;
use s4h\store\States\State;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseRepository;

class CountryRepository extends BaseRepository {

	function __construct() {
		$this->columns = [
			trans('categories.list.Name'),
			trans('categories.list.Parent_category'),
			trans('categories.list.Actions')
		];
		$this->setModel(new Country);
		$this->setListAllRoute('categories.api.list');
	}

	public function getListOfStates($countryId)
	{
		$country = $this->get($countryId);
	 	$states = $country->states()->where('country_id', '=', $countryId)->lists('name', 'id');
	 	return $states;
	}

	public function getListOfCities($stateId)
	{
		$state = State::findOrFail($stateId);
		$cities = $state->cities()->where('states_id', '=', $stateId)->lists('name', 'id');
		return $cities;
	}
}