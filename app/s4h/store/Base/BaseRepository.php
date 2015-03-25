<?php namespace s4h\store\Base;


use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;

/**
* 
*/
abstract class BaseRepository 
{

	const PAGINATE = true;

	public $filters = [];

	abstract public function getModel();

	public function search(array $data = array(), $paginate = false, $numItems = 10)
	{
		$language = $this->getCurrentLang();
		
		$data = array_only($data, $this->filters);

		$data = array_filter($data);

		$query = $this->getModel()->select();

		foreach($data as $field => $value)
		{
			$filterMethod = 'filterBy'.studly_case($field);

			if(method_exists(get_called_class(), $filterMethod))
			{
				call_user_func_array(array($this, $filterMethod), array($query, $data));
			}
		}

		$this->sortResults($query, $data);

		return $paginate ? $query->paginate($numItems): $query->get();
	}

	public function getCurrentLang(){
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		return $language;
	}

	public function sortResults($query, array $data = array())
	{
		if (isset($data['orderBy'])) 
		{
			$value = explode('-',$data['orderBy']);

			$field = $value[0];

			$order = $value[1];

			$orderByMethod = 'orderBy'.studly_case($field);

			if(method_exists(get_called_class(), $orderByMethod))
			{
				call_user_func_array(array($this, $orderByMethod), array($query, $order));
			}
		}
	}

}

