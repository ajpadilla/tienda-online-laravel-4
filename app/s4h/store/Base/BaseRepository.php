<?php namespace s4h\store\Base;


use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;

/**
* 
*/
abstract class BaseRepository 
{

	public $filters = [];

	abstract public function getModel();

	public function search(array $data = array())
	{
		$data = array_only($data, $this->filters);

		$data = array_filter($data,'strlen');

		$query = $this->getModel()->select();

		foreach($data as $field => $value)
		{
			$filterMethod = 'filterBy'.studly_case($field);

			echo "field:".$field.'<br>';
			echo "field:".$value.'<br>';
			echo "Valor:".$filterMethod.'<br>';

			if(method_exists(get_called_class(), $filterMethod))
			{
				if ($filterMethod == 'filterByPrice') {
					$this->filterByPrice($query, $value, $data['operator']);
				} else {
					call_user_func_array(array($this, $filterMethod), array($query, $value));
				}
			}
			else
			{
				if ($filterMethod != 'filterByPrice')
					$query->where($field, $data[$field]);
			}
		}
		return $query->get();
	}

	public function getCurrentLang(){
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		return $language;
	}

	public function filterByfilterWord($query, $value){
		$language = $this->getCurrentLang();
		$query->where('name', 'LIKE', '%' . $value . '%')->where('language_id','=',$language->id)->orWhere('description', 'LIKE', '%' . $value . '%')->where('language_id','=',$language->id);
	}

}

